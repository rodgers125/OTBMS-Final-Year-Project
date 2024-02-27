
function removeEvent(events_id) {
    if (confirm('Are you sure you want to remove this Event?')) {
        var url = 'delete_event.php?id=' + events_id;

        fetch(url, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to remove Event');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to remove Event');
        });
    }
}

//editing event
function editEvent(event_id) {
 
    alert('Edit Event with ID: ' + event_id);
    window.location.href = 'edit_event.php?event_id=' + event_id;
  }