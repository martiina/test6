<?php
	require_once 'core/init.php';

	if(Session::exists(Config::get('app.session-name'))) {
		Redirect::to('index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Test 6 veebileht - Login</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css' />
		<!-- Latest compiled and minified CSS [BOOTSTRAP]-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!-- jQuery UI library -->
		<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
		<!-- Validation skript on siin (ajax). Hoiame login.php vaate puhtana. -->
		<script src="assets/js/validation.js"></script>
	</head>
	<body>
		<?php include_once 'includes/menu.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form action="ajax.php" method="POST" id="login-form">
					  	<div class="form-group" id="username-group">
					    	<label class="control-label" for="username">Kasutajanimi</label>
					    	<input type="text" class="form-control" id="username" name="username" placeholder="Sisesta kasutajanimi" />
					    	<p class="help-block hidden" id="username-error"></p>
					  	</div>
					  	<div class="form-group" id="password-group">
					    	<label class="control-label" for="password">Parool</label>
					    	<input type="password" class="form-control" id="password" name="password" placeholder="Sisesta parool" />
					    	<p class="help-block hidden" id="password-error"></p>
					  	</div>
					  	<button type="submit" class="btn btn-primary">Login</button>
					  	<input type="hidden" value="<?php echo Token::generate(); ?>" name="<?php echo Config::get('app.token_name'); ?>" />
					  	<input type="hidden" name="action" value="login" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>