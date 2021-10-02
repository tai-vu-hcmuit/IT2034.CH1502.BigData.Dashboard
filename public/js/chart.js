
var SparkCountPositive = parseInt(document.getElementById('SparkCountPositive').innerHTML);
var SparkCountNegative = parseInt(document.getElementById('SparkCountNegative').innerHTML);
var SparkCountNeutral = parseInt(document.getElementById('SparkCountNeutral').innerHTML);

var TextblobCountPositive = parseInt(document.getElementById('TextblobCountPositive').innerHTML);
var TextblobCountNegative = parseInt(document.getElementById('TextblobCountNegative').innerHTML);
var TextblobCountNeutral = parseInt(document.getElementById('TextblobCountNeutral').innerHTML);

/**
 * Line chart
 */

var barChartContainer = document.getElementById("barChart");
const labels = ['Positive', 'Negative', 'Neutral'];
const dataBarChart = {
    labels: labels,
    datasets: [{
        label: 'Spark',
        data: [SparkCountPositive, SparkCountNegative, SparkCountNeutral],
        backgroundColor: [
            'rgba(255, 45, 132, 0.2)',
            'rgba(255, 80, 64, 0.2)',
            'rgba(255, 100, 86, 0.2)',
        ],
        borderColor: 'rgb(255, 205, 86)',
        borderWidth: 1
    }, {
        label: 'TextBlob',
        data: [TextblobCountPositive, TextblobCountNegative, TextblobCountNeutral],
        backgroundColor: [
            'rgba(200, 45, 132, 0.2)',
            'rgba(200, 80, 64, 0.2)',
            'rgba(200, 100, 86, 0.2)',
        ],
        borderColor: [
            'rgb(200, 15, 132)',
            'rgb(200, 15, 64)',
            'rgb(200, 15, 86)',
        ],
        borderWidth: 1
    }]
};
const configBarChart = {
    type: 'bar',
    data: dataBarChart,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Twitter comments analysis'
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
        data: [SparkCountPositive, SparkCountNegative, SparkCountNeutral],
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
var pieChartContainer1 = document.getElementById("pieChart1");
var pieChart1 = new Chart(pieChartContainer1, configPieChart);

/**
 * Pie chart 2
 */

const dataPieChart2 = {
    labels: [
        'Positive',
        'Negative',
        'Neutral'
    ],
    datasets: [{
        label: 'My First Dataset',
        data: [TextblobCountPositive, TextblobCountNegative, TextblobCountNeutral],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
    }]
};
const configPieChart2 = {
    type: 'doughnut',
    data: dataPieChart2,
};
var pieChartContainer2 = document.getElementById("pieChart2");
var pieChart2 = new Chart(pieChartContainer2, configPieChart2);