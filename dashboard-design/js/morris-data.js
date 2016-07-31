$(function() {



Morris.Line({
  element: 'morris-area-chart',
  data: ar,
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Employee']
});  

Morris.Bar({
  element: 'morris-area-location-chart',
  data: arlocation ,
  stacked:true,
  xkey: 'y',
  ykeys: ['a', 'b','c'],
      labels: ['Bangalore', 'chennai','hyderabad'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
});
//morris-area-skill-chart

Morris.Bar({
  element: 'morris-area-skill-chart',
  data: arskill,
  stacked:true,
  xkey: 'y',
  ykeys: ['a', 'b','c','d'],
      labels: ['Testing', 'Java','.Net','PHP'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
});




   /* Morris.Area({
        element: 'cmorris-area-chart',
        data: [{
            period: '1',
            iphone: 50
            //ipad: null
            //itouch: 2647
        }, {
            period: '2',
            iphone: 100
            //ipad: 2294
            //itouch: 2441
        }, {
            period: '3',
            iphone: 125
            //ipad: 1969
            //itouch: 2501
        }, {
            period: '4',
            iphone: 175
            //ipad: 3597
            //itouch: 5689
        }, {
            period: '5',
            iphone: 250
            //ipad: 1914
            //itouch: 2293
        }, {
            period: '6',
            iphone: 400
            //ipad: 4293
            //itouch: 1881
        }, {
            period: '7',
            iphone: 500
            //ipad: 3795
            //itouch: 1588
        }, {
            period: '8',
            iphone: 700
            //ipad: 5967
            //itouch: 5175
        }, {
            period: '8',
            iphone: 800
            //ipad: 4460
            //itouch: 2028
        }, {
            period: '9',
            iphone: 700
            //ipad: 5713
            //itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone'],
        labels: ['iPhone'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
*/




   /* Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });*/

    Morris.Donut({
        element: 'morris-donut-chart',
        data: arexprience,
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
