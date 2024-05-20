document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contPaymentModal');
    const closeButton = document.querySelector('.close');

    closeButton.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  });

  function btnRepay(loanId) {
    const modal = document.getElementById('contPaymentModal');
    const loanIdInput = document.getElementById('loanId');
    loanIdInput.value = loanId;
    modal.style.display = 'block';
  }

  function showPaymentDetails() {
    const paymentMethod = document.getElementById('payment_method').value;    
    document.getElementById('mpesa').style.display = 'none';
    document.getElementById('bank_transfer').style.display = 'none';
    document.getElementById('paymentCodeGroup').style.display = 'none';
    document.getElementById('paymentCodeLabel').style.display = 'none';
    document.getElementById('submitButton').style.display = 'none';

    if (paymentMethod === 'Mpesa') {      
      document.getElementById('mpesa').style.display = 'block';
      document.getElementById('paymentCodeGroup').style.display = 'block';
      document.getElementById('paymentCodeLabel').style.display = 'block';
      document.getElementById('submitButton').style.display = 'block';
    } else if (paymentMethod === 'Bank') {
      document.getElementById('bank_transfer').style.display = 'block';
      document.getElementById('paymentCodeGroup').style.display = 'block';
      document.getElementById('paymentCodeLabel').style.display = 'block';
      document.getElementById('submitButton').style.display = 'block';
    }
  }