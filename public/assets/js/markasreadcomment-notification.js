function markNotificationAsReadComment(notificationCount) {
    if(notificationCount !=='0'){
        $.get('/markAsReadComment');
    }
}
