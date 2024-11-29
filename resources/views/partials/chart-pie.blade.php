@php
    $data = $orders
        ->groupBy(function ($order) {
            return $order->order_time->format('Y-m-d');
        })
        ->map(function ($ordersPerDay) {
            return [
                'tanggal' => $ordersPerDay->first()->order_time->format('Y-m-d'),
                'total_penjualan' => $ordersPerDay->sum(function ($order) {
                    return $order->price * $order->quantity_kg; // Mengalikan harga dengan jumlah
                }),
            ];
        });
@endphp

<div id="chartpie" class=" rounded-md border border-blue-500" style="height: 300px;"></div>

<script>
    var options = {
        chart: {
            type: 'pie',
            height: 300
        },
        series: [44, 55, 13, 33],
        labels: ['Apple', 'Mango', 'Orange', 'Watermelon']
        
    };

    const chartContainer = document.querySelector("#chartpie");
    if (chartContainer) {
        var chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
</script>
