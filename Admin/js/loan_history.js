function printTable() {
    // Open the browser's print dialog
    window.print();
}

// Function to open the details modal
// Function to open the details modal and load transaction details via AJAX
function openDetailsModal(loanId) {
    // Display the modal
    document.getElementById('detailsModal').style.display = 'block';

    // Create an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'transactions_details_db.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Handle AJAX response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse JSON response from the PHP script
                var response = JSON.parse(xhr.responseText);

                // Update modal content with transaction details
                var memberDetails = document.getElementById('memberDetails');
                memberDetails.innerHTML = `
                    <table>
                        <tr>
                            <th>Transaction ID:</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                        </tr>
                        <tr>
                            <td>${response.transaction_id}</td>
                            <td>${response.transaction_date}</td>
                            <td>${response.transaction_amount}</td>
                            <td>${response.transaction_method}</td>
                        </tr>
                    </table>
                `;
            } else {
                // Handle AJAX error
                alert('Failed to fetch transaction details.');
            }
        }
    };

    // Send AJAX request with loanId data
    xhr.send('loanId=' + loanId);
}







// Function to close the details modal
function closeDetailsModal() {
    document.getElementById('detailsModal').style.display = 'none';
}
