$(document).ready(function(){

	show();

	$("#submit").click(function(){
		insert();
	});



	// $("#delete").click(function(){
	// 	console.log('clicked');
	// 	deletedata();
	// });

	// called delete from html cause this method above does'nt working some unknown reason

	

});


function insert(){
		var methodName = "insert";
		var fName = $("#fName").val();
		var uName = $("#uName").val();
		var email = $("#email").val();
		var status = $("#status").val();

		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName,
				fName: fName,
				uName: uName,
				email: email,
				status: status
			},
			success:function(result){
				$(".msg").html(result);

				$(".msg").fadeOut(1000);
				$("#fName").val("");
				$("#uName").val("");
				$("#email").val("");
				$("#status").html('<option value="1">--Select Status--</option><option value="1">Active</option><option value="2">Inactive</option>');

				show();
			}
		});
	}


	function show(){
		var methodName = "show";
		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName	
			},
			success:function(result){
				$("#data").html(result);
			}
		});
	}


	function deletedata(){
		var methodName = "delete";
		var id = $("#delete").val();
		console.log(id);
		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName,
				id: id
			},
			success:function(result){
				$(".msg").html(result);
				show();
				$(".msg").fadeOut(1000);
			}
		});
	}


