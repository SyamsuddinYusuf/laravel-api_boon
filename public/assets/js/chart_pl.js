//   $(document).ready(function(){
//       //window.onload = function() {
//         var ctx = document.getElementById("chart").getContext("2d");
//         window.myBar = new Chart(ctx, {
//             type: 'bar',
//             data: barChartData,
//             options: {
//                 elements: {
//                     rectangle: {
//                         borderWidth: 2,
//                         borderColor: 'rgb(0, 255, 0)',
//                         borderSkipped: 'bottom'
//                     }
//                 },
//                 responsive: true,
//                 title: {
//                     display: true,
//                     text: 'Yearly Website Visitor'
//                 }
//             }
//         });
//     });

//     var BULAN = ['1','2','3', '4','5','6','7','8','9','10'];
//     var pl = ['1','2','3', '4','5','6','7','8','9','10'];

//     var barChartData = {
//         labels: BULAN,
//         datasets: [{
//             label: 'PL',
//             backgroundColor: "rgba(151,187,205,0.5)",
//             data: pl
//         }]
//     };
//      // };



// var getUrlParameter = function getUrlParameter(pl) {
//     var sPageURL = window.location.search.substring(1),
//         sURLVariables = sPageURL.split('&'),
//         sParameterName,
//         i;

//     for (i = 0; i < sURLVariables.length; i++) {
//         sParameterName = sURLVariables[i].split('=');

//         if (sParameterName[0] === pl) {
//             return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
//         }
//     }
// };

// var url = getUrlParameter("http://localhost:8000/pl");




  var BULAN = ['1','2','3', '4','5','6','7','8','9','10'];
  var pl = ['5','2','4', '4','10','6','3','1','7','8'];


var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: BULAN, 
    datasets: [
      { 
        data: pl
      }
    ]
  }
});




$(function() {
  // Create a function that will handle AJAX requests
  function requestData(chart){
    $.ajax({
      type: "GET",
      url: "{{url('app/Http/Controllers/DatatablesController/getApi')}}", // This is the URL to the API
      data: {  }
    })
    .done(function( data ) {
      // When the response to the AJAX request comes back render the chart with new data
      chart.setData(JSON.parse(data));
    })
    .fail(function() {
      // If there is no communication between the server, show an error
      alert( "error occured" );
    });
  }

  var chart = Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'pl_chart',
    // Set initial data (ideally you would provide an array of default data)
    data: data,
    xkey: 'BULAN',
    ykeys: ['JumlahPL'],
    labels: ['Users']
  });

  // // Request initial data for the past 7 days:
  // requestData(7, chart);
  // $('ul.ranges a').click(function(e){
  //   e.preventDefault();
  //   // Get the number of days from the data attribute
  //   var el = $(this);
  //   days = el.attr('data-range');
  //   // Request the data and render the chart using our handy function
  //   requestData(days, chart);
  //   // Make things pretty to show which button/tab the user clicked
  //   el.parent().addClass('active');
  //   el.parent().siblings().removeClass('active');
  // })
});
