<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
		<h4>Tutor Registration Form</h4>
			<form action="/panditslist.php" method="POST" enctype="multipart/form-data">

				<div class="form-group">
					<label for="fullname">Full Name:</label>
					<input type="text" class="form-control" name="fullname" id="fullname" required>
				</div>

				<div class="form-group">
					<label for="phone">Phone number:</label>
					<input type="text" class="form-control" name="phone" id="phone" required>
				</div>

				<div class="form-group">
					<label for="city">City:</label>
					<input type="text" class="form-control" name="city" id="city" required>
				</div>

				<div class="form-group">
					<label for="experience">Teching Experience:</label>
					<input type="number" min="0" max="99" class="form-control" name="experience" id="experience" required>
				</div>

				<div class="form-group">
					<label for="language"> Subjects:</label>
					<input type="text" class="form-control" name="language" id="language" required>
				</div>

				<div class="form-group">
					<label for="photourl">Photourl:</label>
					<input type="file" class="form-control" name="photourl" id="photourl">
				</div>

				<div class="form-group">
					<label for="remarks">Remarks:</label>
					<input type="text" class="form-control" name="remarks" id="remarks">
				</div>

				<div class="form-group">
					<label for="location">Location:</label>
					<input type="text" class="form-control" name="location" id="location">
				</div>

				<div class="form-group">
					<label for="lat">Lat:</label>
					<input type="number" step="any"  class="form-control" name="lat" id="lat">
				</div>

				<div class="form-group">
					<label for="long">Long:</label>
					<input type="number" step="any"  class="form-control" name="long" id="long">
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" id="pwd" placeholder="password" name="pwd">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>
