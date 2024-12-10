<x-app-layout :title="'Booking - APIIT Leisure'">
<div class="container mx-auto p-8" x-data="bookingApp()">

<h1 class="text-4xl font-semibold mb-8 text-center text-white-600" style="color:#F8F8F8;">Book a Session</h1>

<!-- Form Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Personal Details -->
    <div class="p-6 rounded-lg" style="background-color:#2D2D2D;">
        <h3 class="text-2xl mb-4" style="color:#F8F8F8;">Personal Details</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">First Name</label>
                <input type="text" x-model="form.firstName" class="w-full rounded px-4 py-2" style="background-color:EEEEEE;" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Last Name</label>
                <input type="text" x-model="form.lastName" class="w-full rounded px-4 py-2"  style="background-color:EEEEEE;" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Mobile Number</label>
                <input type="tel" 
                       x-model="form.mobileNumber" 
                       class="w-full rounded px-4 py-2" 
                       style="background-color:EEEEEE;" 
                       pattern="[0-9]{10}"
                       maxlength="10"
                       inputmode="numeric"
                       @input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '').slice(0, 10)"
                       required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Email Address</label>
                <input type="email" x-model="form.email" class="w-full rounded px-4 py-2"  style="background-color:EEEEEE;" required>
            </div>
        </div>
    </div>

    <!-- Session Details -->
    <div class="p-6 rounded-lg" style="background-color:#2D2D2D;">
        <h3 class="text-2xl mb-4" style="color:#F8F8F8;">Session Details</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Sport</label>
                <select x-model="form.sport" @change="updateVenue" class="w-full rounded px-4 py-2" style="background-color:EEEEEE;" required>
                    @foreach($userSports as $sport)
                        <option value="{{ $sport }}">{{ $sport }}</option>
                    @endforeach
                </select>
            </div>
            <div x-show="form.sport">
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Venue</label>
                <select x-model="form.venue" class="w-full rounded px-4 py-2" style="background-color:EEEEEE;" required>
                    <template x-for="venue in venues" :key="venue">
                        <option x-text="venue"></option>
                        
                    </template>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Number of People</label>
                <input type="number" 
                       x-model="form.people" 
                       min="1" 
                       max="15" 
                       class="w-full rounded px-4 py-2" 
                       style="background-color:EEEEEE;"
                       @input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '')"
                       oninput="validity.valid||(value='');"
                       required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Date</label>
                <input type="date" x-model="form.date" class="w-full rounded px-4 py-2" style="background-color:EEEEEE;" :min="new Date().toISOString().split('T')[0]" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Check-in Time</label>
                <input type="time" x-model="form.checkInTime" class="w-full rounded px-4 py-2" style="background-color:EEEEEE;" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" style="color:#F8F8F8;">Check-out Time</label>
                <input type="time" x-model="form.checkOutTime" class="w-full rounded px-4 py-2" style="background-color:EEEEEE;" required>
            </div>
            <div class="flex items-center">
                <input type="checkbox" x-model="form.borrowEquipment" class="rounded" style="background-color:EEEEEE;">
                <label class="ml-2 text-sm font-medium" style="color:#F8F8F8;">Borrow Equipment</label>
            </div>

            <div x-show="form.borrowEquipment" class="mt-4 space-y-2">
                <h4 class="text-sm font-medium" style="color:#F8F8F8;">Select Equipment:</h4>
                <template x-if="form.sport === 'Badminton'">
                    <div class="ml-4 space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.badminton.racket" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Badminton Racket</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.badminton.shuttlecock" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Shuttlecock</label>
                        </div>
                    </div>
                </template>
                <template x-if="form.sport === 'Basketball'">
                    <div class="ml-4 space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.basketball.basketball" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Basketball</label>
                        </div>
                    </div>
                </template>
                <template x-if="form.sport === 'Carrom'">
                    <div class="ml-4 space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.carrom.carrom_board" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Carrom Board</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.carrom.discs" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Carrom Discs</label>
                        </div>
                    </div>
                </template>
                <template x-if="form.sport === 'Chess'">
                    <div class="ml-4 space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.chess.chessboard" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Chessboard</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.chess.chess_pieces" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Chess Pieces</label>
                        </div>
                    </div>
                </template>
                <template x-if="form.sport === 'Checkers'">
                    <div class="ml-4 space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.checkers.chessboard" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Chessboard</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.checkers.checkers_pieces" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Checkers Pieces</label>
                        </div>
                    </div>
                </template>
                <template x-if="form.sport === 'Netball'">
                    <div class="ml-4 space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.netball.bibs" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Bibs</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.netball.ball" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Netball</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.netball.post_padding" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Post Padding</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" x-model="form.equipment.netball.kneepads" class="rounded" style="background-color:EEEEEE;">
                            <label class="ml-2 text-sm" style="color:#F8F8F8;">Kneepads</label>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Equipment Fee Message -->
            <div x-show="form.borrowEquipment" class="mt-2">
                <hr class="border-gray-600 my-2">
                <p class="text-sm italic" style="color: #FF0000;">* A fee of 50/= will be charged upon entrance</p>
            </div>
        </div>
    </div>
</div>

<!-- Debug Info -->
<div x-show="debug.error" class="mt-4 p-4 bg-red-100 text-red-700 rounded">
    <p x-text="debug.errorMessage"></p>
</div>

<!-- Submit Button -->
<div class="flex justify-center mb-8">
    <button @click="addBooking" class="text-white font-semibold py-2 px-6 shadow-lg rounded" style="background-color: #8B0000;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Book Now</button>
</div>

<!-- Booking History -->
<h3 class="text-2xl font-semibold mt-8 mb-4 text-center" style="color:#F8F8F8;">Booking History</h3>
<div class="overflow-x-auto">
    <table class="w-full border-collapse text-gray-100">
        <thead>
            <tr class="bg-gray-700 text-white" style="background-color:#1E1E1E;">
                <th class="px-4 py-2 border">Sport</th>
                <th class="px-4 py-2 border">Venue</th>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Participants</th>
                <th class="px-4 py-2 border">Check-in Time</th>
                <th class="px-4 py-2 border">Check-out Time</th>
                <th class="px-4 py-2 border">Equipment Borrowed</th>
            </tr>
        </thead>
        <tbody style="background-color:#000000;">
            <template x-for="booking in bookings" :key="booking.id">
                <tr class="border-t text-gray-100">
                    <td class="px-4 py-2 border" style="color: #F8F8F8;" x-text="booking.sport"></td>
                    <td class="px-4 py-2 border" style="color: #F8F8F8;" x-text="booking.venue"></td>
                    <td class="px-4 py-2 border" style="color: #F8F8F8;" x-text="booking.formatted_date"></td>
                    <td class="px-4 py-2 border" style="color: #F8F8F8;" x-text="booking.people"></td>
                    <td class="px-4 py-2 border" style="color: #F8F8F8;" x-text="booking.formatted_check_in"></td>
                    <td class="px-4 py-2 border" style="color: #F8F8F8;" x-text="booking.formatted_check_out"></td>
                    <td class="px-4 py-2 border" style="color: #F8F8F8;">
                        <template x-if="booking.borrow_equipment && booking.equipment">
                            <div class="space-y-1">
                                <template x-for="(items, sport) in booking.equipment" :key="sport">
                                    <template x-if="Object.values(items).some(value => value === true)">
                                        <div>
                                            <template x-for="(value, item) in items" :key="item">
                                                <template x-if="value">
                                                    <span x-text="item.replace(/_/g, ' ') + ' '"></span>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </template>
                        <template x-if="!booking.borrow_equipment || !booking.equipment">
                            <span>None</span>
                        </template>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>

<script>
function bookingApp() {
    return {
        form: {
            firstName: '',
            lastName: '',
            mobileNumber: '',
            email: @json($userEmail),
            sport: @json($userSports[0] ?? ''),
            venue: '',
            people: '',
            date: '',
            checkInTime: '',
            checkOutTime: '',
            borrowEquipment: false,
            equipment: {
                badminton: {
                    racket: false,
                    shuttlecock: false
                },
                basketball: {
                    basketball: false
                },
                carrom: {
                    carrom_board: false,
                    discs: false
                },
                chess: {
                    chessboard: false,
                    chess_pieces: false
                },
                checkers: {
                    chessboard: false,
                    checkers_pieces: false
                },
                netball: {
                    bibs: false,
                    ball: false,
                    post_padding: false,
                    kneepads: false
                }
            },
        },
        bookings: @json($bookings),
        venues: [],
        sportVenues: {
            'Badminton': ['Indoor Court 2', 'Indoor Stadium'],
            'Basketball': ['Indoor Court 1'],
            'Checkers': ['Discussion Room 1', 'Discussion Room 2'],
            'Chess': ['Discussion Room 1'],
            'Carrom': ['Discussion Room 2', 'Discussion Room 3'],
            'Netball': ['Indoor Court 1']
        },
        init() {
            // Populate venues on page load for the default sport
            this.updateVenue();
        },
        updateVenue() {
            this.venues = this.sportVenues[this.form.sport] || [];
            // Ensure the first venue is selected
            this.form.venue = this.venues.length > 0 ? this.venues[0] : '';
        },
        addBooking() {
            console.log('Starting booking process...');
            console.log('Form data:', this.form);

            if (!this.form.firstName || !this.form.lastName || !this.form.mobileNumber || 
                !this.form.email || !this.form.people || !this.form.date || 
                !this.form.checkInTime || !this.form.checkOutTime || !this.form.venue) {
                this.showError('Please fill in all fields!');
                return;
            }

            // Validate mobile number is exactly 10 digits
            if (!/^\d{10}$/.test(this.form.mobileNumber)) {
                this.showError('Mobile number must be 10 digits long!');
                return;
            }

            // Validate number of people is only digits and within range
            const numPeople = parseInt(this.form.people);
            if (!/^\d+$/.test(this.form.people) || isNaN(numPeople)) {
                this.showError('Please enter a valid number of participants!');
                return;
            }
            
            if (numPeople < 1) {
                this.showError('Number of people must be at least 1');
                return;
            }

            if (numPeople > 15) {
                this.showError('A maximum of 15 participants allowed!');
                return;
            }

            // Validate date is in the future
            const selectedDate = new Date(this.form.date);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate <= today) {
                this.showError('Please select a valid date!');
                return;
            }

            // Convert times to minutes and calculate difference
            const [inHours, inMinutes] = this.form.checkInTime.split(':');
            const [outHours, outMinutes] = this.form.checkOutTime.split(':');
            
            const totalInMinutes = (parseInt(inHours) * 60) + parseInt(inMinutes);
            const totalOutMinutes = (parseInt(outHours) * 60) + parseInt(outMinutes);
            
            const timeDifference = totalOutMinutes - totalInMinutes;
            
            if (timeDifference <= 0) {
                this.showError('Check-in time must be before check-out time!');
                return;
            }

            if (timeDifference > 240) {
                this.showError('Only upto 4 hours per booking allowed!');
                return;
            }

            // Show confirmation dialog after all validations pass
            if (!confirm('Confirm booking?')) {
                return;
            }

            console.log('All validations passed, sending to server...');

            // Send booking to server
            fetch('/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.form)
            })
            .then(response => {
                console.log('Server response:', response);
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.error || 'Network response was not ok');
                    });
                }
                return response.json();
            })
            .then(booking => {
                console.log('Booking saved:', booking);
                // Format the booking dates before adding to the list
                booking.formatted_date = new Date(booking.date).toLocaleDateString();
                booking.formatted_check_in = booking.check_in_time;
                booking.formatted_check_out = booking.check_out_time;
                
                this.bookings.unshift(booking);
                this.resetForm();
                this.updateVenue(); // Ensure venues are reset after form reset
                this.showError('Booking successful!', false);
            })
            .catch(error => {
                console.error('Error:', error);
                this.showError(error.message || 'Error saving booking');
            });
        },
        showError(message, isError = true) {
            alert(message);
        },
        resetForm() {
            this.form = {
                firstName: '',
                lastName: '',
                mobileNumber: '',
                email: @json($userEmail),
                sport: @json($userSports[0] ?? ''),
                venue: '',
                people: '',
                date: '',
                checkInTime: '',
                checkOutTime: '',
                borrowEquipment: false,
                equipment: {
                    badminton: {
                    racket: false,
                    shuttlecock: false
                    },
                    basketball: {
                        basketball: false
                    },
                    carrom: {
                        carrom_board: false,
                        discs: false
                    },
                    chess: {
                        chessboard: false,
                        chess_pieces: false
                    },
                    checkers: {
                        chessboard: false,
                        checkers_pieces: false
                    },
                    netball: {
                        bibs: false,
                        ball: false,
                        post_padding: false,
                        kneepads: false
                    }
                },
            };
        },
        debug: {
            error: false,
            errorMessage: ''
        }
    };
}
</script>
</x-app-layout>
