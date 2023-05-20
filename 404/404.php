<?php
header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>404 Error Page</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="404/css/style.css">
	<link type="text/css" rel="stylesheet" href="../404/css/style.css">
	<link rel="icon" href="../logo/logo.png">
</head>

<body>
	<div class="vertical-center">
		<div class="container">
			<div id="notfound" class="text-center ">
				<h1>😮</h1>
				<h2>Oops! Page Not Be Found</h2>
				<p>Sorry but the page you are looking for does not exist.</p>
				<a href="javascript:window.history.go(-1);">Back</a>
			</div>
		</div>
	</div>
</body>

</html>