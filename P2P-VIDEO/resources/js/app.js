import './echo';
import axios from 'axios';

window.axios = axios;

console.log("👀 Echo listener script loaded");
const userId = document.head.querySelector('meta[name="user-id"]').content;

window.Echo.private(`user.${userId}`)
    .listen('.friend.request.sent', (e) => {
        console.log("Friend request received!", e.friendRequest);
        if (Notification.permission === "granted") {
            new Notification("New Friend Request!", {
                body: `From User ID: ${e.friendRequest.user_id}`,
                icon: '/path/to/icon.png' // Optional: Add your logo or favicon
            });
        }
    });
