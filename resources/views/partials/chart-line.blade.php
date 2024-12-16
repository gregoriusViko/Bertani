@php
    $data = $orders
        ->sortBy(function ($order) {
            return \Carbon\Carbon::parse($order->order_time);
        })
        ->map(function ($order) {
            return [
                'x' => $order->order_time,
                'y' => $order->quantity_kg * $order->historyPrice->price,
                'name' => $order->product->type->name,
            ];
        });

    $daftar = $data->groupBy('name');

    $minDate = $orders->min('order_time');
    $maxDate = $orders->max('order_time');
@endphp

<div id="chartline" class=" rounded-md border border-blue-500" style="height: 300px;"></div>
<script>
    function line(){
        var options = {
        series: [
            @foreach ($daftar->keys() as $nama)
                {
                    name: '{{ $nama }}',
                    data: [
                        @foreach ($daftar->get($nama) as $data)
                            [new Date('{{ $data['x'] }}').getTime(), {{ $data['y'] }}],
                        @endforeach
                    ]
                },
            @endforeach
        ],
        chart: {
            type: 'line',
            height: 350,
        },
        xaxis: {
            type: 'datetime',
            min: new Date('{{ $minDate }}').getTime(),
            max: new Date('{{ $maxDate }}').getTime(),
        },
        stroke: {
            curve: 'smooth',
        },
        markers: {
            size: 10,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chartline"), options);
    chart.render();
    }
</script>
