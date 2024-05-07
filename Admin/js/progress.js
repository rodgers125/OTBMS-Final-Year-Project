// Function to update the progress bar based on the contributed amount
function updateProgressBar(totalAmount) {
    // Assuming scheduled amount
    const scheduledAmount = 30000;

    // Calculate progress based on the contributed amount and scheduled amount
    const progress = Math.min((totalAmount / scheduledAmount) * 100, 100);
    
    // Update the progress bar element
    const progressBar = document.getElementById('progress-bar');
    progressBar.style.width = progress + '%';
    progressBar.textContent = progress.toFixed(2) + '%';
}
