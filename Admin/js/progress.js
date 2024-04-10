const scheduledAmount = 30000; // Assuming scheduled amount

// Function to update the progress bar based on the contributed amount
function updateProgressBar(contributedAmount) {
    const progress = Math.min((contributedAmount / scheduledAmount) * 100, 100);
    const progressBar = document.getElementById('progress-bar');
    progressBar.style.width = progress + '%';
    progressBar.textContent = progress.toFixed(2) + '%';
}
// Example: Update the progress bar with contributed amount (e.g., 15000)
//