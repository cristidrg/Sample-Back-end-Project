import Chart from 'chart.js';

// For a pie chart

const seoChart = document.getElementById('seo');
const uptimeChart = document.getElementById('uptime');
const performanceChart = document.getElementById('performance');
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

if (performanceChart) {
    new Chart(performanceChart, {
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

if (seoChart) {
    new Chart(seoChart, {
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