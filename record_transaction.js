document.getElementById('date').addEventListener('input', function() {
    // Update the value with the current date and time in the local time zone
    const now = new Date();
    const localISOString = new Date(now - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    this.value = localISOString;
});