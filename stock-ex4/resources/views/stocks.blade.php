<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <title>Suivi des Stocks en Temps Réel</title>
</head>
<body>
<h1>Suivi des Stocks en Temps Réel</h1>

    <h2>Ajouter un produit</h2>

    <form action="{{ url('/stocks') }}" method="POST">
    @csrf
    <label for="product_name">Nom du produit:</label>
    <input type="text" name="product_name" id="product_name" required><br><br>
    <label for="quantity">quantity :</label>
    <input type="number" name="quantity" id="quantity" required><br><br>

    <button type="submit">Ajouter le produit</button>
    </form>


    <h2>Quantité de Produits</h2>
    <div id="stockChart" style="width:100%; height:400px;"></div>

    <h2>Liste des produits</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nom du produit</th>
                <th>Quantité</th>
                <th>Actions</th>
</tr>
</thead>
<tbody>
    @foreach ($stocks as $stock)
     <tr>
<td>{{$stock->product_name}}</td>
<td>{{$stock->quantity}}</td>
<td>
<form action="{{ url('/stocks/'.$stock->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button type="submit">DELETE</button>
</form>
</td>

</tr>
@endforeach
        </tbody>
    </table>

<script>

var initialCategories = {!! json_encode($stocks->pluck('product_name')) !!};
var initialData = {!! json_encode($stocks->pluck('quantity')) !!};

var chart = Highcharts.chart('stockChart', {
            chart: { type: 'column' },
            title: { text: 'Quantité de Produits' },
            xAxis: { categories: initialCategories},
            yAxis: { title: { text: 'Quantité' } ,min: 0},
            series: [{
                name: 'Quantité',
                data: initialData
            }]
        });



  // Connexion à Pusher
  //Pusher.logToConsole = true;
  var pusher = new Pusher('your-app-key', {
            cluster: 'mt1'
        });

        var channel = pusher.subscribe('stocks');
        channel.bind('StockUpdated', function(data) {
            let stock = data.stock;


            let index = chart.xAxis[0].categories.indexOf(stock.product_name);
            if (index >= 0) {

                chart.series[0].data[index].update(stock.quantity);
            } else {

                chart.xAxis[0].categories.push(stock.product_name);
                chart.series[0].addPoint(stock.quantity);
            }
        });

</script>

</body>
</html>
