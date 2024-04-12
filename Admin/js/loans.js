function confirmMarkAsPaid(loanId) {
    if (confirm("Are you sure you want to mark this loan as paid?")) {
        markAsPaid(loanId);
    }


function markAsPaid(loanId) {    // Display a confirmation dialog
    
        // Create a hidden form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "loan_list_db.php");

        // Create a hidden input field to hold the loanId
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "loanId");
        input.setAttribute("value", loanId);

        // Append the input field to the form
        form.appendChild(input);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }
}
