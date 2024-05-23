// Get the modal
const modal = document.getElementById('loanApplicationModal');

// Get the button that opens the modal
const applyButton = document.querySelector('.btn-apply');

// Get the <span> element that closes the modal
const closeButton = document.querySelector('.close');

// When the user clicks the button, open the modal
applyButton.addEventListener('click', () => {
  modal.style.display = 'block';
});

// When the user clicks on <span> (x), close the modal
closeButton.addEventListener('click', () => {
  modal.style.display = 'none';
});

// When the user clicks anywhere outside of the modal, close it
window.addEventListener('click', (event) => {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

// Populate the repayment period options based on the selected loan type
document.getElementById('loanType').addEventListener('change', () => {
  const loanType = document.getElementById('loanType').value;
  const repaymentPeriodSelect = document.getElementById('repaymentPeriod');
  repaymentPeriodSelect.innerHTML = ''; // Clear existing options
  
  if (loanType === 'personal') {
    ['1 month', '2 months', '3 months'].forEach((period) => {
      const option = document.createElement('option');
      option.value = period;
      option.text = period;
      repaymentPeriodSelect.appendChild(option);
    });
  } else if (loanType === 'business') {
    ['3 months', '6 months', '12 months'].forEach((period) => {
      const option = document.createElement('option');
      option.value = period;
      option.text = period;
      repaymentPeriodSelect.appendChild(option);
    });
  }
});

document.getElementById('loanApplicationForm').addEventListener('submit', function(event) {
  var loanAmount = document.getElementById('loanAmount').value;

  // Client-side validation
  if (loanAmount > loanLimit) {
      event.preventDefault(); // Prevent form submission
      alert('The amount exceeds your loan limit of KSH ' + loanLimit);
  }
});