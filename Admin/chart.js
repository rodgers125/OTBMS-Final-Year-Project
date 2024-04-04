// Assuming canvas is the ID of your canvas element
const canvas = document.getElementById('pieChart');
const context = canvas.getContext('2d');

// Set canvas dimensions
canvas.width = 200;
canvas.height = 200;

// Fetch data from the database
fetch('loan_analytics_data.php')
    .then(response => response.json())
    .then(data => {
        const totalLoanAmount = data.personalLoanTotal + data.businessLoanTotal;
        
        // Calculate percentages and colors
        const colors = ['#FFD700', '#00FFFF']; // Yellow for personal loans, Aqua for business loans
        let startAngle = 0;

        // Personal loan slice
        const personalSliceAngle = (data.personalLoanTotal / totalLoanAmount) * 2 * Math.PI;
        context.beginPath();
        context.moveTo(canvas.width / 2, canvas.height / 2);
        context.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, startAngle, startAngle + personalSliceAngle);
        context.fillStyle = colors[0];
        context.fill();

        // Business loan slice
        const businessSliceAngle = (data.businessLoanTotal / totalLoanAmount) * 2 * Math.PI;
        startAngle += personalSliceAngle;
        context.beginPath();
        context.moveTo(canvas.width / 2, canvas.height / 2);
        context.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, startAngle, startAngle + businessSliceAngle);
        context.fillStyle = colors[1];
        context.fill();

        // Update legend
        document.querySelector('.legend-item:nth-child(1) b').textContent = 'KSH ' + data.personalLoanTotal.toFixed(2);
        document.querySelector('.legend-item:nth-child(2) b').textContent = 'KSH ' + data.businessLoanTotal.toFixed(2);
   
    })
    .catch(error => console.error('Error fetching loan data:', error));
