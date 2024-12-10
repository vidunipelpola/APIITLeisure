<x-app-layout>
    <x-slot name="title">
        Notifications - APIIT Leisure
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold" style="color: #F8F8F8;">Notifications</h2>
                        @if($notifications->where('is_read', false)->count() > 0)
                            <button 
                                onclick="markAllAsRead()"
                                class="text-white px-4 py-2 rounded-md hover:opacity-80 transition-opacity"
                                style="background-color: #8B0000;">
                                Mark All as Read
                            </button>
                        @endif
                    </div>

                    @if($notifications->isEmpty())
                        <p class="text-center py-8" style="color: #F8F8F8;">No notifications yet</p>
                    @else
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div 
                                    class="p-4 rounded-lg transition-all duration-300 relative"
                                    style="background-color: {{ $notification->is_read ? '#2d2d2d' : '#3d3d3d' }}; border: 1px solid #4d4d4d;"
                                    id="notification-{{ $notification->id }}"
                                >
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold mb-2" style="color: #F8F8F8;">
                                                {{ $notification->title }}
                                            </h3>
                                            <p style="color: #F8F8F8;">{{ $notification->message }}</p>
                                            <p class="text-sm mt-2" style="color: #a0a0a0;">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        @if(!$notification->is_read)
                                            <button 
                                                onclick="markAsRead({{ $notification->id }})"
                                                class="text-sm px-3 py-1 rounded hover:opacity-80 transition-opacity"
                                                style="background-color: #8B0000; color: white;">
                                                Mark as Read
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function markAsRead(id) {
            fetch(`/notifications/${id}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notification = document.getElementById(`notification-${id}`);
                    notification.style.backgroundColor = '#2d2d2d';
                    const markAsReadBtn = notification.querySelector('button');
                    if (markAsReadBtn) markAsReadBtn.remove();
                    updateNotificationCount();
                }
            });
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('[id^="notification-"]').forEach(notification => {
                        notification.style.backgroundColor = '#2d2d2d';
                        const markAsReadBtn = notification.querySelector('button');
                        if (markAsReadBtn) markAsReadBtn.remove();
                    });
                    document.querySelector('[onclick="markAllAsRead()"]').remove();
                    updateNotificationCount();
                }
            });
        }

        function updateNotificationCount() {
            fetch('/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    const countElement = document.getElementById('notification-count');
                    if (countElement) {
                        if (data.count > 0) {
                            countElement.textContent = data.count;
                            countElement.style.display = 'flex';
                        } else {
                            countElement.style.display = 'none';
                        }
                    }
                });
        }
    </script>
</x-app-layout>
