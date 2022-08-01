<?php 

$con = new mysqli('localhost', 'root', '', 'crud_ajax');


$method = $_POST['methodName'];

// calling function according to the methodName coming from app.js request
$method();



function insert(){
	global $con;

	$fName = $_POST['fName'];
	$uName = $_POST['uName'];
	$email = $_POST['email'];
	$status = $_POST['status'];

	$result = $con->query("INSERT INTO tbl_users (fName, uName, email, status) VALUES ('$fName', '$uName', '$email', '$status') ");

	if($result){
		echo '<div class="alert alert-success">Submitted Successful</div>';
	}


}



function show(){
	global $con;

	$result = $con->query("SELECT * FROM tbl_users");

	if($result->num_rows > 0){
		echo '<h2 class="text-center">Users List</h2><table class="table mt-3">
				<tr>
					<th>Full name</th>
					<th>User name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Action</th>
				</tr>';
		while($data = $result->fetch_assoc()){
			echo '
				<tr>
					<td>'.$data["fName"].'</td>
					<td>'.$data["uName"].'</td>
					<td>'.$data["email"].'</td>
					<td>'.$data["status"].'</td>
					<td><button class="btn btn-info btn-sm">Edit</button>
						<button class="btn btn-danger btn-sm" id="delete" value="'.$data["id"].'" onclick="deletedata(this.value)">Delete</button>
					</td>
				</tr>
			';
		}
		echo '</table>';
	}else{
		echo '<h2 class="text-center">No data found</h2>';
	}
}



function delete(){
	global $con;
	$id = $_POST['id'];

	$result = $con->query("DELETE FROM tbl_users WHERE id='$id'");
	if($result){
		echo '<div class="alert alert-success">Delete Successful</div>';
	}else{
		echo '<div class="alert alert-danger">Couldn\'t delete!</div>';
	}
}




 ?>