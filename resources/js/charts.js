import Chart from 'chart.js';

// For a pie chart

const seoChart = document.getElementById('seo');
const uptimeChart = document.getElementById('uptime');
const performanceChart = document.getElementById('performance');
const accessibilityChart = document.getElementById('accessibility');

const createChart = (element) => {
    let score = element.getAttribute("data-score");
    let color = 'rgba(186,219,0,1)';
    let backupColor = 'rgba(212,27,44,1)';

    if (score < 0.9 && score > 0.49) {
        color = 'rgba(255,191,61,1)';
    } else if (score < 0.5) {
        color = 'rgba(212,27,44,1)';
        backupColor = 'rgba(0,0,0,1)';
    }

    new Chart(element, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [score * 100, 100 - score * 100],
                backgroundColor: [
                    color,
                    backupColor,
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
    createChart(accessibilityChart)
}

if (performanceChart) {
    createChart(performanceChart);
}

if (seoChart) {
    createChart(seoChart);
}

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