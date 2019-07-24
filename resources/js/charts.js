import Chart from 'chart.js';

// For a pie chart

const uptimeChart = document.getElementById('uptime');

const accessibilityChart = document.getElementById('accessibility');

if (uptimeChart) {
    new Chart(uptimeChart, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [2, 98],
                backgroundColor: [
                    'rgba(212,27,44,1)',
                    'rgba(186,219,0,1)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 85
        }
    });
}


if (accessibilityChart) {
    new Chart(accessibilityChart, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [80, 20],
                backgroundColor: [
                    'rgba(255,191,61,1)',
                    'rgba(0,0,0,1)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 85
        }
    });
}