function handleRowClick(notification_id) {
    // Hide the notification list
    document.getElementById('notificationList').style.display = 'none';

    // Show the notification content div
    document.getElementById('notificationContent').style.display = 'block';

    // Fetch and display the notification content
    fetchNotification(notification_id);
}

function fetchNotification(notification_id) {
    console.log('Fetching notification for ID:', notification_id);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse the response JSON
                var response = JSON.parse(xhr.responseText);

                // Display the notification title and message
                document.getElementById('notificationTitle').textContent = response.title;
                document.getElementById('notificationMessage').textContent = response.message;
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.open('GET', 'get_notification.php?id=' + notification_id, true);
    xhr.send();
}








//deleting notification

function handleDeleteClick(notification_id) {
    if (confirm('Are you sure you want to delete this Notification ?')) {
        var url = 'delete_notification_db.php?id=' + notification_id;


        fetch(url, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Notification Deleted Successfully!');
                location.reload();
            } else {
                alert('Failed to delete the notification. Try again later');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete the notification. Try again later');
        });
    }
}
