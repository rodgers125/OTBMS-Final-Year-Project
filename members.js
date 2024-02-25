document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('form');
    const tableRows = document.querySelectorAll('tbody tr');
    const noResultsMessage = document.createElement('p');
    noResultsMessage.style.display = 'none';

    searchForm.insertAdjacentElement('afterend', noResultsMessage);

    searchForm.addEventListener('input', function (event) {
      const searchTerm = event.target.value.trim().toLowerCase();

      let resultsFound = false;

      tableRows.forEach(function (row) {
        const rowData = Array.from(row.children).map(cell => cell.textContent.toLowerCase());
        const matchesSearch = rowData.some(data => data.includes(searchTerm));

        row.style.display = matchesSearch ? '' : 'none';

        if (matchesSearch) {
          resultsFound = true;
        }
      });

      noResultsMessage.style.display = resultsFound ? 'none' : '';
      noResultsMessage.textContent = resultsFound ? '' : 'No data containing \'' + searchTerm + '\'';
    });
  });







  //view details card
  
// Function to fetch and display member details
function viewDetails(memberId) {
    // Fetch data from the server using AJAX or another suitable method
    // Replace the sample data below with your actual fetching logic

    // Sample data
    const memberDetails = {
        dateJoined: '3/3/2014',
        totalContributions: 'KSH 10000',
        lastContribution: 'KSH 3000',
        totalLoansBorrowed: 'KSH 40000',
        totalLoansRepaid: 'KSH 30000',
        loanLimit: 'KSH 50000',
        loanBalance: 'KSH 6000'
    };

    // Update HTML elements with fetched data
    document.getElementById('dateJoined').innerText = memberDetails.dateJoined;
    document.getElementById('totalContributions').innerText = memberDetails.totalContributions;
    document.getElementById('lastContribution').innerText = memberDetails.lastContribution;
    document.getElementById('totalLoansBorrowed').innerText = memberDetails.totalLoansBorrowed;
    document.getElementById('totalLoansRepaid').innerText = memberDetails.totalLoansRepaid;
    document.getElementById('loanLimit').innerText = memberDetails.loanLimit;
    document.getElementById('loanBalance').innerText = memberDetails.loanBalance;

    // Show the More Details section
    document.querySelector('.all-details').style.display = 'block';
}


//edit member details button

function editMember(memberId) {
  // Redirect to an edit page or show a modal for editing
  // Example: You can use window.location.href to redirect to an edit page.

  // Replace the following line with the appropriate code for your application
  alert('Edit member with ID: ' + memberId);
  window.location.href = 'edit_member.php?memberId=' + memberId;
}



//deactivating a user


function deactivateMember(memberId) {
  if (confirm("Are you sure you want to deactivate this account?")) {
      // Send AJAX request
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
              // Handle the response, e.g., display a success message
              alert(xhr.responseText);
          }
      };
      xhr.open("POST", "deactivate_user.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("memberId=" + memberId);
  }
}


//Activating a User

function toggleStatus(memberId, action) {
  if (confirm("Are you sure you want to " + action + " this account?")) {
      // Send AJAX 
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
              // Handle the response, e.g., display a success message
              alert(xhr.responseText);
              // Reload the page to reflect the updated status
              location.reload();
          }
      };
      xhr.open("POST", "activate_user.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("memberId=" + memberId + "&action=" + action);
  }
}
