// Get the modal
const modal = document.getElementById('contPaymentModal');

// Get the button that opens the modal
const applyButton = document.querySelector('.btn-submit');

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