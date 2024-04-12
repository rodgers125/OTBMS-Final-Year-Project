// Function to open the details modal
function openDetailsModal() {
    document.getElementById('detailsModal').style.display = 'block';
}

// Function to close the details modal
function closeDetailsModal() {
    document.getElementById('detailsModal').style.display = 'none';
}


function approveLoan(requestId) {
    var confirmation = confirm("Are you sure you want to Approve this loan request?");
    if (confirmation) {
    // Create a hidden form element
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "loanRequest_to_loan.php");

    // Create a hidden input field to hold the requestId
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "requestId");
    input.setAttribute("value", requestId);

    // Append the input field to the form
    form.appendChild(input);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
} else {
    // If user cancels, do nothing
    return;
}
}



// JavaScript function to reject a loan request
function rejectLoan(requestId) {
    // Display a confirmation prompt
    var confirmation = confirm("Are you sure you want to reject this loan request?");

    // If user confirms, proceed with rejection
    if (confirmation) {
        // Create a hidden form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "reject_loan_db.php");

        // Create a hidden input field to hold the requestId
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "requestId");
        input.setAttribute("value", requestId);

        // Append the input field to the form
        form.appendChild(input);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();

       
        
    } else {
        // If user cancels, do nothing
        return;
    }
}




