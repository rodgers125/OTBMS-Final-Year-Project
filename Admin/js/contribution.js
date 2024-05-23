//delete contribution schedule fro db


function deleteContribution(contribution_id) {
    if (confirm('Are you sure you want to delete this contribution?')) {
        // Send an AJAX request to delete the contribution
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'contribution_schedule_table_db.php?delete_contribution_id=' + contribution_id, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // If the deletion was successful, reload the page
                location.reload();
            } else {
                alert('Error deleting contribution');
            }
        };
        xhr.send();
    }
}
//edit contribution
function editContribution(contribution_id) {
 
    alert('Edit Contribution with ID: ' + contribution_id);
    window.location.href = 'edit_contribution.php?contribution_id=' + contribution_id;
  }



//to mark complete

function markComplete(contribution_id) {
    if (confirm('Are you sure you want to mark this contribution as complete?')) {
        // Create a hidden form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "mark_complete_db.php");

        // Create a hidden input field to hold the contribution_id
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "contribution_id");
        input.setAttribute("value", contribution_id);

        // Append the input field to the form
        form.appendChild(input);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    } else {
        // Show a cancellation message
        alert('Marking as complete canceled.');
    }
}





