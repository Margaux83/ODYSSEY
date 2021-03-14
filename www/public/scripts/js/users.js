var ctx = document.getElementById('line-chart').getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Nombre dutilisateur',
            data: [230, 250, 260, 270, 280, 290],
            borderColor: "#3e95cd",
            borderWidth: 5,
            fill: false

        }]
    },
    options: {
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Mois'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Valeur'
                }
            }]
        }
    },

});

var ctx = document.getElementById('bar-chart').getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Nombre dutilisateur',
            data: [230, 250, 260, 270, 280, 290],
            borderColor: "#3e95cd",
            borderWidth: 5,
            fill: false

        }]
    },

});