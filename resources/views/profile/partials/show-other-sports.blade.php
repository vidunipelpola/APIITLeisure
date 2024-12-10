<section>
    <header>
        <h2 class="text-lg font-medium" style="color:#F3F3F3;">
            {{ __('Other Sports') }}
        </h2>

        <p class="mt-1 text-sm dark:text-gray-400">
            {{ __("Sport groups you can join.") }}
        </p>
    </header>

    <div class="mt-6">
        <div class="space-y-2">
            @php
                $user = Auth::user();
                $selectedSports = $user->sport_interest ?? [];
                $allSports = ['Badminton', 'Basketball', 'Carrom', 'Checkers', 'Chess', 'Netball'];
                $otherSports = array_diff($allSports, $selectedSports);
            @endphp

            @forelse($otherSports as $sport)
                <div class="p-3 rounded flex items-center justify-between">
                    <span class="text-gray-200">{{ $sport }}</span>
                    <form method="POST" action="{{ route('join-sport') }}" class="inline">
                        @csrf
                        <input type="hidden" name="sport" value="{{ $sport }}">
                        <button type="submit" class="px-3 py-1 text-sm text-white rounded hover:opacity-75" style="background-color: #8B0000;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            {{ __('Join') }}
                        </button>
                    </form>
                </div>
            @empty
                <div class="p-3 rounded">
                    <span class="text-gray-200">No other sports available</span>
                </div>
            @endforelse
        </div>
    </div>
</section>
