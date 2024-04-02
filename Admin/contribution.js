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


