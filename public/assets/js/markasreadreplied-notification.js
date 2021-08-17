function markNotificationAsReadReplied(notificationCount) {
    if(notificationCount !=='0'){
        $.get('/markAsReadReplied');
    }
}
