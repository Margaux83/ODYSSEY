var ctx = document.getElementById('dataChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Inscriptions', 'Voyages', 'Connexions', 'Réservations', 'Tickets vendus', 'Annulations'],
        datasets: [{
            label: '# of Votes',
            data: [579, 138, 380, 414, 602, 853],
            backgroundColor: [
                '#155263',
                '#155263',
                '#155263',
                '#155263',
                '#155263',
                '#155263'
            ],
            borderColor: [
                '#FFFFFF',
                '#FFFFFF',
                '#FFFFFF',
                '#FFFFFF',
                '#FFFFFF',
                '#FFFFFF'
            ],
            borderWidth: 1
        }]
    }
});