var barChartData = {
    labels: [
        "Absence of OB",
        "Closeness",
        "Credibility",
        "Heritage",
        "M Disclosure",
        "Provenance",
        "Reliability",
        "Transparency"
    ],
    datasets: [
        {
            label: "Blue",
            backgroundColor: '#155263',
            borderWidth: 1,
            data: [3, 5, 6, 7,3, 5, 6, 7]
        },
        {
            label: "Grey",
            backgroundColor: '#C4C4C4',
            borderWidth: 1,
            data: [4, 7, 3, 6, 10,7,4,6]
        }
    ]
};

var chartOptions = {
    responsive: true,
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}

window.onload = function() {
    var ctx = document.getElementById("viewPerChart").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData,
        options: chartOptions
    });
};