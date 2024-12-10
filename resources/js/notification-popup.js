export function notificationPopup() {
    return {
        showPopup: false,
        currentNotification: null,
        notifications: [],

        async checkNotifications() {
            try {
                const response = await fetch('/notifications/unread');
                const data = await response.json();
                
                if (data.notifications && data.notifications.length > 0) {
                    this.notifications = data.notifications;
                    this.showNextNotification();
                }
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        },

        showNextNotification() {
            if (this.notifications.length > 0) {
                this.currentNotification = this.notifications[0];
                this.showPopup = true;
            } else {
                this.showPopup = false;
                this.currentNotification = null;
            }
        },

        async dismissNotification() {
            if (this.currentNotification) {
                try {
                    await fetch(`/notifications/${this.currentNotification.id}/mark-as-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    
                    this.notifications.shift();
                    this.showNextNotification();
                } catch (error) {
                    console.error('Error marking notification as read:', error);
                }
            }
        }
    };
}
