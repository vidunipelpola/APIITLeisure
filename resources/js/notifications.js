// Function to update notification count
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

// Update count every 30 seconds
setInterval(updateNotificationCount, 30000);

// Initial count update
document.addEventListener('DOMContentLoaded', () => {
    updateNotificationCount();
});
