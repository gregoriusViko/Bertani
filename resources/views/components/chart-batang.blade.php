<div id="chartbatang" class="rounded-md border border-blue-500" style="height: 300px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        };

        const chartContainer = document.querySelector("#chartbatang");
        if (chartContainer) {
            var chart = new ApexCharts(chartContainer, options);
            chart.render();
        }
    });
</script>
