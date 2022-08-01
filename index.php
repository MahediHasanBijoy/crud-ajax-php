<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
	
	<div class="row ms-2">
		<div class="ms-2 col-md-4 border border-info mt-5 p-3">
			<div class="msg"></div>
			<div class="form-group mt-3">
				<label for="">Full name</label>
				<input type="text" class="form-control" id="fName" placeholder="Enter your full name">
			</div>
			<div class="form-group mt-3">
				<label for="">Username</label>
				<input type="text" class="form-control" id="uName" placeholder="Enter your username">
			</div>
			<div class="form-group mt-3">
				<label for="">Email</label>
				<input type="text" class="form-control" id="email" placeholder="Enter your email">
			</div>
			<div class="form-group mt-3">
				<select id="status" class="form-select">
					<option value="1">--Select Status--</option>
					<option value="1">Active</option>
					<option value="2">Inactive</option>
				</select>
			</div>
			<div class="form-group mt-3">
				<input type="button" id="submit" class="btn btn-info form-control" value="Save">
			</div>
		</div>
		<div class="col-md-7 ms-5 mt-5" id="data">

		</div>
	</div>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
	<script src="app.js"></script>
</body>
</html>