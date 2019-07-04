$(document).ready(function () {
	yg_penting_chart();
	
});

/*
 * set chart
 * month = 8, 9, 10, 11, 12 (default bulan sekarang)
 * weeks = 0,1,2,3,4,5
 * channel = NATIONAL, BR1, BR2, BR3 ,BR4 ,BR5 ,BR6 ,BR7 ,BR8 , HO
 * 
 */ 


// cuma buat start doang
function yg_penting_chart(){
	    $('#chart-national').highcharts({
		chart: { 
					type: 'line',
					symbol:"circle",
					backgroundColor:'rgba(255, 255, 255, 0.9)'
                },
		legend: {
				borderColor:'#909090'
			},
        title: { 'text':null},
	    colors: ['#00C865', '#0060FE', '#BE29EC'],
        subtitle: { },
        xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
			min:0,
			tickInterval:10,
			opposite: true,
            title: {
                text: null
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Baseline',
            data: [2, 8, 7, 11, 17, 22, 24, 24, 20, 14, 46, 25],
            marker: { symbol: 'square' }
        }, {
            name: 'Last Week',
            data: [9, 6, 35, 84, 35, 70, 86, 19, 13, 90, 39, 10],
            marker: { symbol: 'square' }
        }, {
            name: 'Last Month',
            data: [39, 42, 57, 85, 19, 15, 17, 16, 12, 13, 66, 48],
            marker: { symbol: 'square' }
        } ]
    });

}
