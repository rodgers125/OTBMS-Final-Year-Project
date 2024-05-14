function printTable() {
    // Open the browser's print dialog
    window.print();
}

// Function to open the details modal
function openDetailsModal(loanId) {
    document.getElementById('detailsModal').style.display = 'block';


    var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "transactions_details_db.php");

        // Create a hidden input field to hold loanId
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






// Function to close the details modal
function closeDetailsModal() {
    document.getElementById('detailsModal').style.display = 'none';
}
