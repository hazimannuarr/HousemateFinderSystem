$(document).ready(function () {

	$.ajax({
		url : "api/data.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var visit = {
				male : [],
				female : [],
				anon : []
			};
			var room =[];

			var len = data.length;

			for (var i = 0; i < len; i++) {
				room.push(data[i].fld_room_name);
				visit.male.push(data[i].visit_male);
				visit.female.push(data[i].visit_female);
				visit.anon.push(data[i].visit_anon);
			}
			//get canvas
			var ctx = $("#bar-chartcanvas");

			var data = {
				labels : room,
				datasets :[
			{
				label : "Male",
				data : visit.male,
				backgroundColor : [
					"rgba(10, 20, 30, 0.3)",
					"rgba(10, 20, 30, 0.3)",
					"rgba(10, 20, 30, 0.3)",
					"rgba(10, 20, 30, 0.3)",
					"rgba(10, 20, 30, 0.3)"
				],
				borderColor : [
					"rgba(10, 20, 30, 1)",
					"rgba(10, 20, 30, 1)",
					"rgba(10, 20, 30, 1)",
					"rgba(10, 20, 30, 1)",
					"rgba(10, 20, 30, 1)"
				],
				borderWidth : 1
			},
			{
				label : "Female",
				data : visit.female,
				backgroundColor : [
					"rgba(50, 150, 250, 0.3)",
					"rgba(50, 150, 250, 0.3)",
					"rgba(50, 150, 250, 0.3)",
					"rgba(50, 150, 250, 0.3)",
					"rgba(50, 150, 250, 0.3)"
				],
				borderColor : [
					"rgba(50, 150, 250, 1)",
					"rgba(50, 150, 250, 1)",
					"rgba(50, 150, 250, 1)",
					"rgba(50, 150, 250, 1)",
					"rgba(50, 150, 250, 1)"
				],
				borderWidth : 1,
			},
			{
				label : "Unspecified",
				data : visit.anon,
				backgroundColor : [
					"rgba(60, 15, 25, 0.7)",
					"rgba(60, 15, 25, 0.7)",
					"rgba(60, 15, 25, 0.7)",
					"rgba(60, 15, 25, 0.7)",
					"rgba(60, 15, 25, 0.7)"
				],
				borderColor : [
					"rgba(50, 15, 25, 1)",
					"rgba(50, 15, 25, 1)",
					"rgba(50, 15, 25, 1)",
					"rgba(50, 15, 25, 1)",
					"rgba(50, 15, 25, 1)"
				],
				borderWidth : 1
			}
		]
	};

	var options = {
		title : {
			display : true,
			position : "top",
			text : "Room Visit by Gender",
			fontSize : 12,
			fontColor : "#111"
		},
		width:800,
		height: 800,
		legend : {
			display : true,
		},
		scales : {
			yAxes : [{
				ticks : {
					min : 0
				}
			}],
		 xAxes: [{
        ticks: {
          maxRotation: 0,
          minRotation: 0
        }
      }],
		}
	};

			var chart = new Chart( ctx, {
				type : "bar",
				data : data,
				options : options
			} );

		},
		error : function(data) {
			console.log(data);
		}
	});

});