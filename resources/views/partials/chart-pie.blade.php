@php
    $data = $orders->groupBy('product_id')->map(function ($orders) {
        return [
            'nama' => $orders->first()->product->type->name,
            'total_pemasukan' => $orders->sum(function($order){
                return $order->historyPrice->price * $order->quantity_kg;
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
        series: @json($data->pluck('total_pemasukan')),
        labels: @json($data->pluck('nama'))
    };

    const chartContainer = document.querySelector("#chartpie");
    if (chartContainer) {
        var chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
</script>
