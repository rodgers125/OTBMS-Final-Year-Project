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

    if (this.value === 'till_number') {
        mpesa_till.style.display = 'block';
    }else if(this.value === 'send_money'){
        mpesa_number.style.display = 'block';

    }else {
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





