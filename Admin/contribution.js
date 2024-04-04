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
function openEditModal(contribution_id) {
    // Get the contribution data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'contribution_schedule_table_db.php?contribution_id=' + contribution_id, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            populateEditForm(data);
        } else {
            alert('Error fetching contribution data');
        }
    };
    xhr.send();
}

function populateEditForm(data) {
    // Populate the form fields with the contribution data
    document.getElementById('memberId').value = data.member_id;
    document.getElementById('contributionAmount').value = data.cont_amount;
    document.getElementById('contribution_date').value = data.cont_dateline;

    // Show the modal
    document.getElementById('editModal').style.display = 'block';
}