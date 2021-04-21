var ctx = document.getElementById('myChart').getContext('2d');
var chart = document.querySelector('#myChart');
var total_spend = chart.dataset.spend;
var total_recipe = chart.dataset.recipe;
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
            'Total des dépenses',
            'Total des recettes',
          ],
          datasets: [{
            label: 'Dashboard Chart',
            data: [total_spend, total_recipe],
            backgroundColor: [
              'rgb(198,229,217)',
              'rgb(214,129,137)',
            ],
            hoverOffset: 4,
          }]
    }});