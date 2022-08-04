$(document).ready(function(){

	show();

	$("#submit").click(function(){
		insert();
	});
	

});


// insert request
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

	// show request
	function show(){
		var methodName = "show";
		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName	
			},
			success:function(result){
				$(".output").html(result);
			}
		});
	}

	// delete request
	function deletedata(id){

		var methodName = "delete";

		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName,
				id: id
			},
			success:function(result){
				show();
				$("#actionmsg").html(result);
				
				$(".modal").modal("hide");
				$("#actionmsg").fadeOut(1000);

			}
		});
	}

	// update request
	function update(id){
		var methodName = "update";

		var fName = $(".fName"+id).val();
		var uName = $(".uName"+id).val();
		var email = $(".email"+id).val();
		var status = $(".status"+id).val();
		console.log(email);
		console.log(status);

		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName,
				id:id,
				fName: fName,
				uName: uName,
				email: email,
				status: status
			},
			success:function(result){
				$("#actionmsg").html(result);

				$("#actionmsg").fadeOut(1000);
				
				$(".modal").modal("hide");

				show();
			}
		});

	}


	// changing status request
	function changeStatus(id){
		var methodName = "changeStatus";
		$.ajax({
			url:'process.php',
			method: 'POST',
			data:{
				methodName: methodName,
				id:id
			},
			success:function(result){
				$("#actionmsg").html(result);

				$(".alert").fadeOut(1000);
				
				$(".modal").modal("hide");

				show();
			}
		});
	}
