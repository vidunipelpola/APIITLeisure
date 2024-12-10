<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $userSports = $user->sport_interest ?? [];
            $bookings = $user->bookings()->orderBy('created_at', 'desc')->get();
            
            return view('booking.index', [
                'userSports' => $userSports,
                'userEmail' => $user->email,
                'bookings' => $bookings
            ]);
        } catch (\Exception $e) {
            Log::error('Error in booking index: ' . $e->getMessage());
            return view('booking.index', [
                'userSports' => [],
                'userEmail' => '',
                'bookings' => []
            ])->with('error', 'Error loading booking data');
        }
    }

    public function store(Request $request)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'mobileNumber' => 'required|string|size:10',
                'email' => 'required|email',
                'sport' => 'required|string',
                'venue' => 'required|string',
                'people' => 'required|integer|min:1|max:15',
                'date' => 'required|date|after:today',
                'checkInTime' => 'required|string',
                'checkOutTime' => 'required|string',
                'borrowEquipment' => 'boolean'
            ]);

            // Check for overlapping bookings
            $existingBooking = Booking::where('venue', $request->venue)
                ->where('date', $request->date)
                ->where(function($query) use ($request) {
                    $query->where(function($q) use ($request) {
                        $q->where('check_in_time', '<=', $request->checkInTime)
                          ->where('check_out_time', '>', $request->checkInTime);
                    })->orWhere(function($q) use ($request) {
                        $q->where('check_in_time', '<', $request->checkOutTime)
                          ->where('check_out_time', '>=', $request->checkOutTime);
                    });
                })->first();

            if ($existingBooking) {
                return response()->json([
                    'error' => 'This venue is already booked for the selected time slot'
                ], 422);
            }

            $booking = new Booking();
            $booking->user_id = $user->id;
            $booking->first_name = $request->firstName;
            $booking->last_name = $request->lastName;
            $booking->mobile_number = $request->mobileNumber;
            $booking->email = $request->email;
            $booking->sport = $request->sport;
            $booking->venue = $request->venue;
            $booking->people = $request->people;
            $booking->date = $request->date;
            $booking->check_in_time = $request->checkInTime;
            $booking->check_out_time = $request->checkOutTime;
            $booking->borrow_equipment = $request->borrowEquipment;
            $booking->equipment = $request->equipment;
            $booking->save();

            // Create notification for the user
            $bookingDate = \Carbon\Carbon::parse($request->date)->format('l, F j');
            $bookingTime = \Carbon\Carbon::parse($request->checkInTime)->format('h:i A');
            
            Notification::create([
                'user_id' => $user->id,
                'title' => '⏰ Sport Session Reminder',
                'message' => "Get ready! {$request->sport} session at {$request->venue}\nDate: {$bookingDate}\nTime: {$bookingTime}",
                'type' => 'booking'
            ]);

            return response()->json($booking);
        } catch (\Exception $e) {
            Log::error('Error creating booking: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating booking: ' . $e->getMessage()], 500);
        }
    }
}
