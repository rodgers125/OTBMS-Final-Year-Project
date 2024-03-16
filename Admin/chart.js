const canvas = document.getElementById('pieChart');
        const context = canvas.getContext('2d');

        canvas.width = 200;
        canvas.height = 200;

        const data = [30, 70]; // Assuming percentages

        const colors = ['#FFD700', '#00FFFF']; // Yellow for 'personal loans', Aqua for 'business loans'

        let startAngle = 0;

        data.forEach((value, index) => {
            const sliceAngle = (value / 100) * 2 * Math.PI;

            context.beginPath();
            context.moveTo(canvas.width / 2, canvas.height / 2);
            context.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, startAngle, startAngle + sliceAngle);
            context.fillStyle = colors[index];
            context.fill();

            startAngle += sliceAngle;
        });