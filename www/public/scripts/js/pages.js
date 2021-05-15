var ctx = document.getElementById('dataChart').getContext('2d');
ctx.canvas.width = 300; ctx.canvas.height = 200;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['0', '1', '2', '3', '4', '5'],
        datasets: [
            {
                label: 'Vues fake',
                data: [50, 22, 36, 112, 152, 80],
                backgroundColor: [
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4',
                    '#C4C4C4'
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
            },
            {
                label: 'Vues réel',
                data: [579, 138, 380, 414, 602, 950],
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
            }
        ]
    }
});