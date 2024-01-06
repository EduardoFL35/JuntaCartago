google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(activosChart);
google.charts.setOnLoadCallback(limpiezaChart);
google.charts.setOnLoadCallback(garantiaChart);
function activosChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Work',     11],
    ['Eat',      2],
    ['Commute',  2],
    ['Watch TV', 2],
    ['Sleep',    7]
  ])
  var options = {
    title: 'Activos',
    is3D: true,
    width:400,
    height:300,
  }
  var chart = new google.visualization.PieChart(document.getElementById('activos_chart'));
  chart.draw(data, options);
}

function limpiezaChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Work',     11],
      ['Eat',      2],
      ['Commute',  2],
      ['Watch TV', 2],
      ['Sleep',    7]
    ])
    var options = {
      title: 'Artículos de Limpieza',
      is3D: true,
      width:400,
      height:300,
    }
    var chart = new google.visualization.PieChart(document.getElementById('limpieza_chart'));
    chart.draw(data, options);
}

function garantiaChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Work',     11],
    ['Eat',      2],
    ['Commute',  2],
    ['Watch TV', 2],
    ['Sleep',    7]
  ])
  var options = {
    title: 'Artículos de Limpieza',
    is3D: true,
    width:400,
    height:300,
    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
  }
  var chart = new google.visualization.PieChart(document.getElementById('garantia_chart'));
  chart.draw(data, options);
}