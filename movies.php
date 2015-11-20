<?php
require_once 'core/init.php';
if($user->isLoggedIn() === FALSE) {
	return Redirect::to('login.php');
}

$movie = new Movie();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Test 6 veebileht</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!-- jQuery UI library -->
		<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
		<!-- Validation skript on siin (ajax). Hoiame movies.php vaate puhtana. -->
		<script src="assets/js/validation.js"></script>
	</head>
	<body>
		<?php include_once 'includes/menu.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-8 text-right">
					<form class="form-inline" id="search-form" method="POST" action="ajax.php">
					  	<div class="form-group" id="search-group">
					    	<label for="search">Otsing</label>
					    	<input type="text" class="form-control" id="search" name="search" id="search" placeholder="Sisesta filmi nimi" />
					  	</div>
					  	<button type="submit" value="submit" class="btn btn-warning">Otsing</button>
					  	<input type="hidden" name="action" value="search_movie" />
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<h2 class="page-header text-info">Sinu lemmikfilmid</h2>
					<?php if(Session::exists('movie-success')): ?>
							<p class="alert alert-success"><?php echo Session::flash('movie-success'); ?></p>
					<?php endif; ?>
					<div>
						<?php if($movie->find(Session::get(Config::get('app.session-name'))) !== FALSE): ?>
							<div class="row" id="refresh">
								<?php foreach($movie->results() as $film): ?>
									<div class="col-md-4">
										<div class="panel panel-default">
										  	<div class="panel-heading">
										    	<h3 class="panel-title"><?php echo $film->title; ?></h3>
										  	</div>
										  	<div class="panel-body">
										  		<p class="alert alert-info">Hinnang: <?php echo $film->rating; ?></p>
										  		<p class="alert alert-success">Väljalaske-aasta:<br />
										  		<?php echo date('d.m.Y', strtotime($film->release_date)); ?></p>
										    	<div class="progress">
												  	<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo percentage($film->rating, Config::get('app.movie-rating-max')); ?>%;">
												    	<?php echo percentage($film->rating, Config::get('app.movie-rating-max')); ?>%
												  	</div>
												</div>
										  	</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php else: ?>
							<p class="text-danger">Sul pole ühtegi filmi lisatud. Saad seda teha kõrval olevas formis.</p>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4">
					<h2 class="page-header text-success">Lisa filme siit</h2>
					<form action="ajax.php" method="POST" id="movie-form">
						<div class="form-group" id="title-group">
					    	<label class="control-label" for="title">Filmi nimi</label>
					    	<input type="text" class="form-control" id="title" name="title" placeholder="Sisesta filmi nimi" />
					    	<p class="help-block hidden" id="title-error"></p>
					  	</div>
					  	<div class="form-group" id="rating-group">
					    	<label class="control-label" for="rating">Sinu hinnang</label>
					    	<input type="text" class="form-control" id="rating" name="rating" placeholder="Sisesta enda hinnang antud filmile" />
					    	<p class="help-block hidden" id="rating-error"></p>
					  	</div>
					  	<div class="form-group" id="release-group">
					    	<label class="control-label" for="release">Filmi väljalaske aasta</label>
					    	<input type="text" class="form-control" id="release" name="release" placeholder="Sisesta väljalaske aasta" />
					    	<p class="help-block hidden" id="release-error"></p>
					  	</div>
					  	<button type="submit" class="btn btn-info">Lisa film</button>
					  	<input type="hidden" value="<?php echo Token::generate(); ?>" name="<?php echo Config::get('app.token_name'); ?>" />
					  	<input type="hidden" name="action" value="add_movie" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>