var ctx = document.getElementById('pieChart');

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Calls', 'Messages'],

        datasets: [{
            data: [27, 14],
            backgroundColor: [
                'rgba(255, 158, 71, 1)',
                'rgba(25, 172, 226, 1)'
            ],
            borderColor: [
                'rgba(255, 158, 71, 1)',
                'rgba(25, 172, 226, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
