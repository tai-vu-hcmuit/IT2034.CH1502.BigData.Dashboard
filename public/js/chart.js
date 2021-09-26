/**
 * Line chart
 */

var barChartContainer = document.getElementById("barChart");
const labels = ['Positive', 'Negative', 'Neutral'];
const dataBarChart = {
    labels: labels,
    datasets: [{
        label: 'Twitter comments analysis',
        data: [65, 124, 80],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
        ],
        borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
        ],
        borderWidth: 1
    }]
};
const configBarChart = {
    type: 'bar',
    data: dataBarChart,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
};

var barChart = new Chart(barChartContainer, configBarChart)

/**
 * Pie chart
 */

const dataPieChart = {
    labels: [
        'Positive',
        'Negative',
        'Neutral'
    ],
    datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
    }]
};
const configPieChart = {
    type: 'doughnut',
    data: dataPieChart,
};
var pieChartContainer = document.getElementById("pieChart");

var pieChart = new Chart(pieChartContainer, configPieChart);