//confirm password
function validateForm() {
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var errorElement = document.getElementById("passwordError");

  if (password !== confirmPassword) {
      errorElement.textContent = "Passwords do not match!";
      return false;
  } else {
      errorElement.textContent = "";
      return true;
  }
}








const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");


menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})


//logout session

document.getElementById("logoutLink").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the link (e.g., navigating to "logout.php")

    // Redirect to the logout script (logout.php)
    window.location.href = "logout.php";
});


//update user profile details in the database
// Function to open the edit modal
function openEditModal() {
    var modal = document.getElementById("editModal");
    modal.style.display = "block";
  }
  
  // Function to close the edit modal
  function closeEditModal() {
    var modal = document.getElementById("editModal");
    modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    var modal = document.getElementById("editModal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };


