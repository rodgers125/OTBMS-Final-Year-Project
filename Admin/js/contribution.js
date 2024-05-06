document.getElementById('payment_options').addEventListener('change', function() {
    var mpesaOptions = document.getElementById('mpesa_options');
    var bankDepositOptions = document.getElementById('bank_deposit_options');

    if (this.value === 'mpesa') {
        mpesaOptions.style.display = 'block';
        bankDepositOptions.style.display = 'none';
    } else if (this.value === 'bank_deposit') {
        mpesaOptions.style.display = 'none';
        bankDepositOptions.style.display = 'block';
    } else {
        mpesaOptions.style.display = 'none';
        bankDepositOptions.style.display = 'none';
    }
});

document.getElementById('mpesa_sub_options').addEventListener('change', function() {
    var mpesaInput = document.getElementById('mpesa_input');

    if (this.value === 'till_number' || this.value === 'send_money') {
        mpesaInput.style.display = 'block';
    } else {
        mpesaInput.style.display = 'none';
    }
});


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
// Function to open the edit modal
function openEditModal(contributionId) {
    // Get the modal element
    var modal = document.getElementById('editModal');
    
    // Display the modal
    modal.style.display = 'block';
    
    
}

// Function to close the modal when the close button is clicked
document.getElementsByClassName('close')[0].onclick = function() {
    var modal = document.getElementById('editModal');
    modal.style.display = 'none';
};

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    var modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

//to mark complete

function markComplete(contribution_id) {
    if (confirm('Are you sure you want to mark this contribution as complete?')) {
        // Send AJAX request to mark_complete.php
        fetch('contribution_history_db.php?contribution_id=' + contribution_id)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Oops! Something went wrong while marking the contribution as complete.');
                }
                // Show a success message
                alert('Contribution marked as complete successfully!');
                // Reload the page after successful completion
                location.reload();
            })
            .catch(error => {
                // Show an error message
                alert(error.message);
            });
    } else {
        // Show a cancellation message
        alert('Marking as complete canceled.');
    }
}




