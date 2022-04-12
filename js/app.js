$(document).ready(function(){
  $.ajax({
    url: "http://lrgs.ftsm.ukm.my/users/a167582/HousemateFinder4/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var mon = [];
      var count = [];

      for(var i in data) {
          mon.push(data[i].month);
          count.push(data[i].count);

          if(mon[i] == '1'){
            mon[i] = "January";
          }else if (mon[i] == '2') {
            mon[i] = "February";
          }else if (mon[i] == '3') {
            mon[i] = "March";
          }else if (mon[i] == '4') {
            mon[i] = "April";
          }else if (mon[i] == '5') {
            mon[i] = "May";
          }else if (mon[i] == '6') {
            mon[i] = "June";
          }else if (mon[i] == '7') {
            mon[i] = "July";
          }else if (mon[i] == '8') {
            mon[i] = "August";
          }else if (mon[i] == '9') {
            mon[i] = "September";
          }else if (mon[i] == '10') {
            mon[i] = "October";
          }else if (mon[i] == '11') {
            mon[i] = "November";
          }else if (mon[i] == '12') {
            mon[i] = "December";
          }
        }

      var chartdata = {
        labels:mon,
        datasets : [
          {
            label: 'Count',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: count
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata,
        label: 'Rented Room by Month',
        options: {
                title: {
                    display: true,
                    text: 'Rented Room by Month',
                    
                }
              }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});