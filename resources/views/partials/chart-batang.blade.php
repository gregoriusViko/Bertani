<div id="chartbatang" class="rounded-md border border-blue-500" style="height: 300px;"></div>

@php
    $data = $orders->groupBy('product_id')->map(function ($orders) {
        return [
            'nama' => $orders->first()->product->type->name,
            'total_berat' => $orders->sum('quantity_kg'),
        ];
    });
@endphp

<script>
    var options = {
        chart: {
            type: 'bar',
            height: 300
        },
        series: [{
            name: 'sales',
            data: @json($data->pluck('total_berat'))
        }],
        xaxis: {
            categories: @json($data->pluck('nama'))
        }
    };

    const chartContainer = document.querySelector("#chartbatang");
    if (chartContainer) {
        var chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
</script>
