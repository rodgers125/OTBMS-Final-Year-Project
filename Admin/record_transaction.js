function getCurrentDateTime() {
    const now = new Date();
    const localISOString = new Date(now - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    return localISOString;
}

// Set the default value to the current date and time
document.getElementById('date').defaultValue = getCurrentDateTime();