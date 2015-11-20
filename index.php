<?php
	require_once 'core/init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Test 6 veebileht</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
	<body>
		<?php include_once 'includes/menu.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-header text-info">Test</h2>
					<p><?php echo utf8_encode(Hash::salt(32)); ?></p>
				</div>
			</div>
		</div>
	</body>
</html>