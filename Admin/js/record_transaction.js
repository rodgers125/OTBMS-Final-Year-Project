function getCurrentDateTime() {
    const now = new Date();
    const localISOString = new Date(now - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    return localISOString;
}

// Set the default value to the current date and time
document.getElementById('date').defaultValue = getCurrentDateTime();

function toggleMemberIdInput() {
    var purposeSelect = document.getElementById("purpose");
    var memberIdField = document.getElementById("memberIdField");
    var memberIdInput = document.getElementById("member_id_for_contribution");
    var loanIdField = document.getElementById("loanIdField");
    var loanIdInput = document.getElementById("loan_id_for_payment");

    if (purposeSelect.value === "contribution") {
        memberIdField.style.display = "block";
        memberIdInput.required = true;
        loanIdField.style.display = "none";
        loanIdInput.required = false;
    } else if (purposeSelect.value === "loanRepayment") {
        memberIdField.style.display = "none";
        memberIdInput.required = false;
        loanIdField.style.display = "block";
        loanIdInput.required = true;
    } else {
        memberIdField.style.display = "none";
        memberIdInput.required = false;
        loanIdField.style.display = "none";
        loanIdInput.required = false;
    }
}

