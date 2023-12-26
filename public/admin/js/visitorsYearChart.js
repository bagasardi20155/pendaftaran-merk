function visitorYearChart(data) {
    var options = {
        series: [
            {
                name: "Jumlah Pengunjung",
                data: data,
            },
        ],
		colors: ["#62C3D0"],
        chart: {
            type: "bar",
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        xaxis: {
            categories: [
				"2022",
				"2023",
			],
        },
        yaxis: {
            title: {
                text: "$ (thousands)",
            },
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands";
                },
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#visitorsYearChart"), options);
    chart.render();
}
