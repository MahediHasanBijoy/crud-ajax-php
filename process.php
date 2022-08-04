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
		echo '
			<table class="table mt-3">
				<tr>
					<th>Full name</th>
					<th>User name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Action</th>
				</tr>';

		while($data = $result->fetch_assoc()){
			
			if($data['status']=='1'){
				$status = '<button class="btn btn-info btn-sm w-75" data-bs-toggle="modal" data-bs-target="#status'.$data["id"].'">Active</button>';
			}else{
				$status = '<button class="btn btn-secondary btn-sm w-75" data-bs-toggle="modal" data-bs-target="#status'.$data["id"].'">Inactive</button>';
			}

			echo '<tr>
					<td>'.$data["fName"].'</td>
					<td>'.$data["uName"].'</td>
					<td>'.$data["email"].'</td>
					<td>'.$status.'</td>
					<td><button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#update'.$data["id"].'">Edit</button>
						<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete'.$data["id"].'" >Delete</button>
					</td>
				</tr>';

			?>


			<!-- Modal Status -->
			<div class="modal fade" id="status<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Status Change Confirm</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        Are you sure to change status!
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-primary" value="<?php echo $data['id']; ?>" onclick="changeStatus(this.value)">Change Status</button>
			      </div>
			    </div>
			  </div>
			</div>

			<!-- Modal Delete-->
			<div class="modal fade" id="delete<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Confirmation Message</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        Are you sure to delete this user!
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-primary" value="<?php echo $data['id']; ?>" onclick="deletedata(this.value)">Delete</button>
			      </div>
			    </div>
			  </div>
			</div>

			<!-- Modal Update-->
			<div class="modal fade" id="update<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group mt-3">
						<label for="">Full name</label>
						<input type="text" class="form-control <?php echo 'fName'.$data['id']; ?>" placeholder="Enter your full name" value="<?php echo $data["fName"]; ?>">
					</div>
					<div class="form-group mt-3">
						<label for="">Username</label>
						<input type="text" class="form-control <?php echo 'uName'.$data['id']; ?>"  placeholder="Enter your username" value="<?php echo $data["uName"]; ?>">
					</div>
					<div class="form-group mt-3">
						<label for="">Email</label>
						<input type="text" class="form-control <?php echo 'email'.$data['id']; ?>"  placeholder="Enter your email" value="<?php echo $data["email"]; ?>">
					</div>
					<div class="form-group mt-3">
						<select id="" class="form-select <?php echo 'status'.$data['id']; ?>">
							<option value="0">--Select Status--</option>
							<option value="1" <?php if($data["status"]=='1') echo 'selected' ; ?> >Active</option>
							<option value="2" <?php if($data["status"]=='2') echo 'selected' ; ?> >Inactive</option>
						</select>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-primary" id="update<?php echo $data['id'];?>" value="<?php echo $data['id']; ?>" onclick="update(this.value)">Update</button>
			      </div>
			    </div>
			  </div>
			</div>

	<?php
		// end while
		}
		echo '</table>';
	}else{
		echo '<table class="table mt-3">
				<tr>
					<th>Full name</th>
					<th>User name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<tr><td colspan="5"><h2 class="text-center">No data found</h2></td></tr></table>';
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

function update(){
	global $con;

	$id = $_POST['id'];
	$fName = $_POST['fName'];
	$uName = $_POST['uName'];
	$email = $_POST['email'];
	$status = $_POST['status'];

	$result = $con->query("UPDATE tbl_users SET fName='$fName', uName='$uName', email='$email', status='$status' WHERE id='$id' ");

	if($result){
		echo '<div class="alert alert-success">Update Successful</div>';
	}else{
		echo '<div class="alert alert-danger">Update failed</div>';
	}


}



function changeStatus(){
	global $con;
	$id = $_POST['id'];

	$result = $con->query("SELECT * FROM tbl_users WHERE id='$id' ");

	$result = $result->fetch_assoc();

	if($result['status'] == '1'){
		$status = $con->query("UPDATE tbl_users SET status='2' WHERE id='$id' ");
		echo '<div class="alert alert-success">Status is changed.</div>';
	}else{
		$status = $con->query("UPDATE tbl_users SET status='1' WHERE id='$id' ");
		echo '<div class="alert alert-success">Status is changed.</div>';
	}
}


 ?>