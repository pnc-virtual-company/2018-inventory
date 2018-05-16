<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>form login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="/action_page.php">
				<h4 class="text-success" style="font-size: 25px;">Borrowing</h4>
					<div class="form-group">
						<label for="" class="text-success">UserName</label>
						<input type="text" class="form-control" id="User">
					</div>
					<div class="form-group">
						<label for="" class="text-success">Amount</label>
						<input type="text" class="form-control" id="Amount">
					</div>
					<div class="form-group">
						<label for="" class="text-success">Location</label>
						<select name="" id="" class="form-control">
							<option value="B32">B32</option>
							<option value="B31">B31</option>
							<option value="B12">B12</option>
							<option value="B13">B13</option>
							<option value="ERO">ERO</option>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="text-success">StartDate</label>
						<input type="date" class="form-control" id="Sdate">
					</div>
					<div class="form-group">
						<label for="" class="text-success">ReturnDate</label>
						<input type="date" class="form-control" id="Rdate">
					</div>
					<button type="submit" class="btn btn-default">OK</button>
					<button type="submit" class="btn btn-default">Concel</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div><br><br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>