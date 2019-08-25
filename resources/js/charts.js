import Chart from 'chart.js';

// For a pie chart

const seoChart = document.getElementById('seo');
const uptimeChart = document.getElementById('uptime');
const performanceChart = document.getElementById('performance');
const accessibilityChart = document.getElementById('accessibility');

const createChart = (element, flipColors = false) => {
    let score = element.getAttribute("data-score");
    let flip = element.getAttribute("data-flip");
    console.log(flip);

    let color = 'rgba(186,219,0,1)';
    let backupColor = 'rgba(212,27,44,1)';

    if (flip) {
        var auxvar = color;
        color = backupColor;
        backupColor = auxvar;
    }


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
    createChart(uptimeChart, true);
}