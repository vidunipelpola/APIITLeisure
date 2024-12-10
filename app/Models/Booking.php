<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Booking extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'email',
        'sport',
        'venue',
        'people',
        'date',
        'check_in_time',
        'check_out_time',
        'borrow_equipment',
        'equipment'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'borrow_equipment' => 'boolean',
        'equipment' => 'json'
    ];

    protected $appends = ['formatted_date', 'formatted_check_in', 'formatted_check_out'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('Y-m-d');
    }

    public function getFormattedCheckInAttribute()
    {
        return Carbon::parse($this->check_in_time)->format('H:i');
    }

    public function getFormattedCheckOutAttribute()
    {
        return Carbon::parse($this->check_out_time)->format('H:i');
    }
}
