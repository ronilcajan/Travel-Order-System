$(function() {

    "use strict";

    // ============================================================== 
    // Sales chart
    // ==============================================================
    $.ajax({
        type: "POST",
        url: SITE_URL+"dashboard/getWeeklyRevenue",
        dataType: "json",
        success: function(response) {
                console.log(response);

                var brgy = [];
                var mon=0, tue=0, wed=0, thu=0, fri=0;
                $.each(response.bar, function( index, value ) {
                    mon += parseInt(value.mon);
                    tue += parseInt(value.tue);
                    wed += parseInt(value.wed);
                    thu += parseInt(value.thu);
                    fri += parseInt(value.fri);
                });
                brgy.push(mon,tue,wed,thu,fri);

                var indi = [];
                var mon=0, tue=0, wed=0, thu=0, fri=0;
                $.each(response.ind, function( index, value ) {
                    mon += parseInt(value.mon);
                    tue += parseInt(value.tue);
                    wed += parseInt(value.wed);
                    thu += parseInt(value.thu);
                    fri += parseInt(value.fri);
                });

                indi.push(mon,tue,wed,thu,fri);

                var resi = [];
                var mon=0, tue=0, wed=0, thu=0, fri=0;
                $.each(response.res, function( index, value ) {
                    mon += parseInt(value.mon);
                    tue += parseInt(value.tue);
                    wed += parseInt(value.wed);
                    thu += parseInt(value.thu);
                    fri += parseInt(value.fri);
                });

                resi.push(mon,tue,wed,thu,fri);

                var busi = [];
                var mon=0, tue=0, wed=0, thu=0, fri=0;
                $.each(response.bus, function( index, value ) {
                    mon += parseInt(value.mon);
                    tue += parseInt(value.tue);
                    wed += parseInt(value.wed);
                    thu += parseInt(value.thu);
                    fri += parseInt(value.fri);
                });

                busi.push(mon,tue,wed,thu,fri);

                var othe = [];
                var mon=0, tue=0, wed=0, thu=0, fri=0;
                $.each(response.oth, function( index, value ) {
                    mon += parseInt(value.mon);
                    tue += parseInt(value.tue);
                    wed += parseInt(value.wed);
                    thu += parseInt(value.thu);
                    fri += parseInt(value.fri);
                });

                othe.push(mon,tue,wed,thu,fri);
                

                new Chartist.Bar('.chartist-sales-chart', {
                    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    series: [
                        brgy,indi,resi,busi,othe
                    ]
                }, {
                    high: 1000,
                    low: 0,
                    height: '300px',
                    fullWidth: true,
                    chartPadding: 10,
                    axisX: {
                        showLabel: true,
                        showGrid: false,
                        position: 'start'
                    },
                    axisY: {
                        showLabel: true,
                        showGrid: false,
                        position: 'end'
                    },
                    plugins: [
                        Chartist.plugins.tooltip()
                    ]
                });
               
        }
    });
    

    
    // Morris donut chart
    $.ajax({
        type: "POST",
        url: SITE_URL+"dashboard/getPopulation",
        dataType: "json",
        success: function(response) {
            console.log(response);
            Morris.Donut({
                element: 'morris-donut-chart',
                data: [{
                    label: "Total Residents",
                    value: response.total,
        
                }, {
                    label: "Total Male",
                    value: response.male
                }, {
                    label: "Total Female",
                    value: response.female
                }],
                resize: true,
                colors: ['#0e83cc', '#6861ce', '#FFB136']
            });
        }
    });
    

    // Covid Chart
    $.ajax({
        type: "POST",
        url: SITE_URL+"dashboard/getCovid",
        dataType: "json",
        success: function(response) {
            console.log(response);

            var nega=0, posi=0, fully=0, dose1=0, fullyP=0, dose1P=0;

            $.each( response.status, function( key, value ) {
                nega += parseInt(value.nega);
                posi += parseInt(value.posi);
                fully += parseInt(value.fully);
                dose1 += parseInt(value.dose1);
                fullyP += parseInt(value.fullyP);
                dose1P += parseInt(value.dose1P);
            });
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [
                    { 
                        y: 'Unvaccinated',
                        a: nega, 
                        b: posi, 
                    }, 
                    { 
                        y: 'Fully Vaccinated',
                        a: fully, 
                        b: fullyP,
                    }, 
                    { 
                        y: '1st Vaccine',
                        a: dose1, 
                        b: dose1P,
                    },
                ],
                ymax: 100,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Negative', 'Positive'],
                barColors: ['#2ecc71', '#e74a25'],
                hideHover: 'auto',
                gridLineColor: '#e0e0e0',
                resize: true,
            });
        }
    });
});


function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}