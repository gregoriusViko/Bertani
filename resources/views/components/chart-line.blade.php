<div id="chartline" class="border border-blue-100" style="height: 300px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'line',
                height: 300
            },
            series: [{
                name: 'sales',
                data: [20, 30, 25, 40, 35, 50, 65, 75, 100]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        };

        const chartContainer = document.querySelector("#chartline");
        if (chartContainer) {
            var chart = new ApexCharts(chartContainer, options);
            chart.render();
        }
    });
</script>
