@php
    $data = $orders
        ->groupBy(function($order) {
            return $order->order_time->format('Y-m-d');
        })
        ->map(function($ordersPerDay) {
            return [
                'tanggal' => $ordersPerDay->first()->order_time->format('Y-m-d'),
                'total_penjualan' => $ordersPerDay->sum(function ($order) {
                return $order->price * $order->quantity_kg; // Mengalikan harga dengan jumlah
            })
            ];
        })
@endphp

<div id="chartline" class="border border-blue-100" style="height: 300px;"></div>

<script>
        var options = {
            chart: {
                type: 'line',
                height: 300
            },
            series: [{
                name: 'Penjualan',
                data: @json($data->pluck('total_penjualan'))
            }],
            xaxis: {
                categories: @json($data->pluck('tanggal'))
            }
        };

        const chartContainer = document.querySelector("#chartline");
        if (chartContainer) {
            var chart = new ApexCharts(chartContainer, options);
            chart.render();
        }
</script>
