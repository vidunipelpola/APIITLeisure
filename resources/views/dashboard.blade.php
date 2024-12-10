<x-app-layout :title="'Dashboard - APIIT Leisure'">
    <div class="relative w-screen overflow-hidden" style="margin-top: -3rem;">
        <img src="/images/ChessHome.jpg" alt="Chess Background" class="w-screen h-screen object-cover">
        <div class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="absolute inset-0">
            <div class="flex flex-col items-center text-center px-4" style="margin-top: 8rem;">
                <h1 class="text-4xl" style="color: #F8F8F8; font-size:70px; margin-bottom:50px;">Welcome to APIIT Leisure</h1>
                <p class="text-xl mb-8" style="color: #F8F8F8; font-size:30px;">-Connecting Sports Enthusiasts-</p>
            </div>
            <div class="flex justify-center items-center space-x-4" style="margin-top: 22rem;">
                <a href="#sports" onclick="smoothScroll('sports', event)" class="px-6 py-3 rounded-lg text-lg transition-all duration-300" style="color: #F8F8F8;" onmouseover="this.style.textDecoration='underline'; this.style.color='#FF0000'" onmouseout="this.style.textDecoration='none'; this.style.color='#F8F8F8'">View Your Sports</a>
                <span style="color: #F8F8F8;">|</span>
                <a href="#videos" onclick="smoothScroll('videos', event)" class="px-6 py-3 rounded-lg text-lg transition-all duration-300" style="color: #F8F8F8;" onmouseover="this.style.textDecoration='underline'; this.style.color='#FF0000'" onmouseout="this.style.textDecoration='none'; this.style.color='#F8F8F8'">Videos</a>
                <span style="color: #F8F8F8;">|</span>
                <a href="#coaches" onclick="smoothScroll('coaches', event)" class="px-6 py-3 rounded-lg text-lg transition-all duration-300" style="color: #F8F8F8;" onmouseover="this.style.textDecoration='underline'; this.style.color='#FF0000'" onmouseout="this.style.textDecoration='none'; this.style.color='#F8F8F8'">Personal Coaches</a>
            </div>
        </div>
    </div>

    <div class="py-12 text-white" style="font-family:Georgia">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6" id="sports"><!--The Chosen Sport Groups-->
                    <h2 class="text-3xl mb-8 animated-underline" style="color: #F8F8F8;">Sport Communities</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        @php
                            $user = Auth::user();
                            $selectedSports = $user->sport_interest ?? [];
                        @endphp

                        @if(in_array('Badminton', $selectedSports))
                            <a href="{{ route('chat.show', 'Badminton') }}" class="block">
                                <div class="text-center" style="background-color: #1E1E1E; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding-bottom:10px; transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="/images/badminton2.jpg" alt="Badminton" class="mx-auto mb-2 w-full h-auto">
                                    <span class="text-white hover:text-gray-300">Badminton</span>
                                </div>
                            </a>
                        @endif

                        @if(in_array('Basketball', $selectedSports))
                            <a href="{{ route('chat.show', 'Basketball') }}" class="block">
                                <div class="text-center" style="background-color: #1E1E1E; padding-bottom:10px; transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="/images/basketball2.jpg" alt="Basketball" class="mx-auto mb-2 w-full h-auto">
                                    <span class="text-white hover:text-gray-300">Basketball</span>
                                </div>
                            </a>
                        @endif

                        @if(in_array('Carrom', $selectedSports))
                            <a href="{{ route('chat.show', 'Carrom') }}" class="block">
                                <div class="text-center" style="background-color: #1E1E1E; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding-bottom:10px; transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="/images/carrom2.jpg" alt="Carrom" class="mx-auto mb-2 w-full h-auto">
                                    <span class="text-white hover:text-gray-300">Carrom</span>
                                </div>
                            </a>
                        @endif

                        @if(in_array('Checkers', $selectedSports))
                            <a href="{{ route('chat.show', 'Checkers') }}" class="block">
                                <div class="text-center" style="background-color: #1E1E1E; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding-bottom:10px; transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="/images/checkers2.png.WEBP" alt="Checkers" class="mx-auto mb-2 w-full h-auto">
                                    <span class="text-white hover:text-gray-300">Checkers</span>
                                </div>
                            </a>
                        @endif

                        @if(in_array('Chess', $selectedSports))
                            <a href="{{ route('chat.show', 'Chess') }}" class="block">
                                <div class="text-center" style="background-color: #1E1E1E; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding-bottom:10px; transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="/images/chess2.jpg" alt="Chess" class="mx-auto mb-2 w-full h-auto">
                                    <span class="text-white hover:text-gray-300">Chess</span>
                                </div>
                            </a>
                        @endif

                        @if(in_array('Netball', $selectedSports))
                            <a href="{{ route('chat.show', 'Netball') }}" class="block">
                                <div class="text-center" style="background-color: #1E1E1E; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding-bottom:10px; transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="/images/netball2.jpg" alt="Netball" class="mx-auto mb-2 w-full h-auto">
                                    <span class="text-white hover:text-gray-300">Netball</span>
                                </div>
                            </a>
                        @endif
                    </div>
            </div>
            <div class="p-6 mt-8" id="videos"><!--Videos-->
                    <h2 class="text-3xl mb-8 animated-underline" style="color: #F8F8F8;">Training Videos</h2>
                    <div class="space-y-4 w-full md:w-5/6">
                        @if(in_array('Badminton', $selectedSports))
                        <!-- Badminton Training Video -->
                        <div class="text-left rounded-lg w-full" style="background-color: #2D2D2D; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.querySelector('p').style.color='#B60000';" onmouseout="this.querySelector('p').style.color='#F8F8F8';">
                            <a href="https://youtu.be/9WJqVM0FEKQ?si=3wa6xbA3ghIH2Wac" target="_blank" class="block p-4">
                                <div class="flex items-center space-x-8">
                                    <img src="https://img.youtube.com/vi/9WJqVM0FEKQ/mqdefault.jpg" alt="Badminton Training" class="w-48 h-27 rounded-lg object-cover">
                                    <p class="text-l" style="color: #F8F8F8;">Master Your Badminton Skills <span class="text-gray-400 mx-2">•</span> <span class="text-gray-400">10:23</span></p>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if(in_array('Basketball', $selectedSports))
                        <!-- Basketball Training Video -->
                        <div class="text-left rounded-lg w-full" style="background-color: #2D2D2D; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.querySelector('p').style.color='#B60000';" onmouseout="this.querySelector('p').style.color='#F8F8F8';">
                            <a href="https://youtu.be/UZnu1L-4Hrk" target="_blank" class="block p-4">
                                <div class="flex items-center space-x-8">
                                    <img src="https://img.youtube.com/vi/UZnu1L-4Hrk/mqdefault.jpg" alt="Basketball Training" class="w-48 h-27 rounded-lg object-cover">
                                    <p class="text-l" style="color: #F8F8F8;">Basketball Training Essentials <span class="text-gray-400 mx-2">•</span> <span class="text-gray-400">15:42</span></p>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if(in_array('Carrom', $selectedSports))
                        <!-- Carrom Training Video -->
                        <div class="text-left rounded-lg w-full" style="background-color: #2D2D2D; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.querySelector('p').style.color='#B60000';" onmouseout="this.querySelector('p').style.color='#F8F8F8';">
                            <a href="https://youtu.be/4ZQnyXnb9g0?si=F1KJY7nYud9OvCpf" target="_blank" class="block p-4">
                                <div class="flex items-center space-x-8">
                                    <img src="https://img.youtube.com/vi/4ZQnyXnb9g0/mqdefault.jpg" alt="Carrom Training" class="w-48 h-27 rounded-lg object-cover">
                                    <p class="text-l" style="color: #F8F8F8;">Carrom Strategies: Shots & Techniques <span class="text-gray-400 mx-2">•</span> <span class="text-gray-400">8:15</span></p>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if(in_array('Chess', $selectedSports))
                        <!-- Chess Training Video -->
                        <div class="text-left rounded-lg w-full" style="background-color: #2D2D2D; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.querySelector('p').style.color='#B60000';" onmouseout="this.querySelector('p').style.color='#F8F8F8';">
                            <a href="https://youtu.be/OCSbzArwB10?si=2xXHa5YPnrOYGIFw" target="_blank" class="block p-4">
                                <div class="flex items-center space-x-8">
                                    <img src="https://img.youtube.com/vi/OCSbzArwB10/mqdefault.jpg" alt="Chess Training" class="w-48 h-27 rounded-lg object-cover">
                                    <p class="text-l" style="color: #F8F8F8;">Chess Fundamentals <span class="text-gray-400 mx-2">•</span> <span class="text-gray-400">12:30</span></p>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if(in_array('Checkers', $selectedSports))
                        <!-- Checkers Training Video -->
                        <div class="text-left rounded-lg w-full" style="background-color: #2D2D2D; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.querySelector('p').style.color='#B60000';" onmouseout="this.querySelector('p').style.color='#F8F8F8';">
                            <a href="https://youtu.be/yFrAN-LFZRU" target="_blank" class="block p-4">
                                <div class="flex items-center space-x-8">
                                    <img src="https://img.youtube.com/vi/yFrAN-LFZRU/mqdefault.jpg" alt="Checkers Training" class="w-48 h-27 rounded-lg object-cover">
                                    <p class="text-l" style="color: #F8F8F8;">Checkers Strategy Guide <span class="text-gray-400 mx-2">•</span> <span class="text-gray-400">2:20</span></p>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if(in_array('Netball', $selectedSports))
                        <!-- Netball Training Video -->
                        <div class="text-left rounded-lg w-full" style="background-color: #2D2D2D; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.querySelector('p').style.color='#B60000';" onmouseout="this.querySelector('p').style.color='#F8F8F8';">
                            <a href="https://youtu.be/8WxpyyUwQIQ?si=qQSBgJ7pFbvYEAVg" target="_blank" class="block p-4">
                                <div class="flex items-center space-x-8">
                                    <img src="https://img.youtube.com/vi/8WxpyyUwQIQ/mqdefault.jpg" alt="Netball Training" class="w-48 h-27 rounded-lg object-cover">
                                    <p class="text-l" style="color: #F8F8F8;">Netball Skills and Drills <span class="text-gray-400 mx-2">•</span> <span class="text-gray-400">11:18</span></p>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
            </div>


            <div class="p-8 mt-8" id="coaches"><!--Personal Coaches-->
                <h2 class="text-3xl mb-8 animated-underline" style="color: #F8F8F8;">Personal Coaches</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="bg-gray-700 p-4 rounded-lg" style="background-color: #8B0000; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <h3 class="text-2xl mb-2" style="color:#F8F8F8;">John Doe</h3>
                        <p style="color:#F8F8F8;">Expert in Basketball and Netball. Available for individual and group coaching sessions.</p>
                        <p class="mt-2" style="color:#F8F8F8"><span><a href="tel:+94772468101" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">+94 77 2468 101</a> </span><span style="color: #F8F8F8"> | </span><span style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"><a href="mailto:johndoe@gmail.com">johndoe@gmail.com</a></span></p>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg" style="background-color: #8B0000; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;" onmouseover="if(window.innerWidth > 768) this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <h3 class="text-2xl mb-2" style="color:#F8F8F8;">Jane Smith</h3>
                        <p style="color:#F8F8F8;">Specialized in Chess and Badminton. Offering personal training sessions for all levels.</p>
                        <p class="mt-2" style="color:#F8F8F8"><span><a href="tel:+94771234567" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">+94 77 1234 567</a> </span><span style="color: #F8F8F8"> | </span><span style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"><a href="mailto:jane97@gmail.com">jane97@gmail.com</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animated-underline {
            position: relative;
            display: inline-block;
        }
        
        .animated-underline::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #F8F8F8;
            transform-origin: left;
            animation: underlineAnimation 2s ease-in-out infinite;
        }
        
        @keyframes underlineAnimation {
            0% {
                transform: scaleX(0);
            }
            50% {
                transform: scaleX(1);
            }
            100% {
                transform: scaleX(0);
                transform-origin: right;
            }
        }
    </style>

    <script>
        function smoothScroll(targetId, event) {
            event.preventDefault();
            const target = document.getElementById(targetId);
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            const duration = 1500; // Increased duration for slower scroll
            let start = null;

            function animation(currentTime) {
                if (start === null) start = currentTime;
                const timeElapsed = currentTime - start;
                const run = ease(timeElapsed, startPosition, distance, duration);
                window.scrollTo(0, run);
                if (timeElapsed < duration) requestAnimationFrame(animation);
            }

            // Easing function for smoother animation
            function ease(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(animation);
        }
    </script>
</x-app-layout>
