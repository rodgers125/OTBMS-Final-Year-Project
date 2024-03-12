
//default date and time
function getCurrentDateTime() {
    const now = new Date();
    const localISOString = new Date(now - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    return localISOString;
}

// Set the default value to the current date and time
document.getElementById('event_date').defaultValue = getCurrentDateTime();



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