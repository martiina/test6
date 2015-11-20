<?php

require_once 'core/init.php';

// Et failile ei saadaks otse ligi, kontrollime kas mingi GET v POST meetod eksisteerib.
if(Input::exists() === FALSE) {
	die("No direct access!");
}

$movie = new Movie();
$log = new Log();

/*
 * All the details variable
*/
$detail = array();

/*
 * Status variable
*/
$detail['status'] = 'error';

/*
 * Error message variable.
*/
$detail['err_msg'] = '';

/*
 * Token variable.
*/
$detail['token'] = Input::get(Config::get('app.token_name'));

/*
 * Search data for films
*/
$detail['search_data'] = '';

/*
 * LOGIN FORMI KOOD
*/
if(Input::get('action') === 'login') {

	/*
	 * Variable for token input that comes from POST / GET form.
	*/
	$token = Input::get(Config::get('app.token_name'));

	/* First of all check the token */
	if(Token::check($token) === TRUE) {
		// If token exists, we're good to go.

		/*
		 * Validate username
		*/

		$username = escape(Input::get('username'));
		$password = Input::get('password');

		if(strlen($username) < Config::get('app.username-min-length'))
		{
			$detail['err_msg']['username'] = 'Kasutajanimi peab olema vähemalt '. Config::get('app.username-min-length') .' tähemärki.';
		}
		elseif(strlen($username) > Config::get('app.username-max-length'))
		{
			$detail['err_msg']['username'] = 'Kasutajanimi peab olema väiksem, kui '. Config::get('app.username-max-length') .' tähemärki.';
		}

		/*
		 * Validate password
		*/
		elseif(strlen($password) < Config::get('app.password-min-length'))
		{
			$detail['err_msg']['password'] = 'Parool peab olema vähemalt '. Config::get('app.password-min-length') .' tähemärki.';
		}
		elseif(strlen($password) > Config::get('app.password-max-length'))
		{
			$detail['err_msg']['password'] = 'Parool peab olema väiksem, kui '. Config::get('app.password-max-length') .' tähemärki.';
		}

		/*
		 * If something happens with validation, we need to create new token FROM here, cuz with ajax the browser is not refreshing.
		*/

		$detail['token'] = Token::generate();

		if(empty($detail['err_msg'])) {
			
			$login = $user->login($username, $password);

			if($login === TRUE) {
				$detail['status'] = 'success';

				$log->create("LOG[Sisselogimine] Kasutaja: {$username} | Aeg: ". date('d.m.Y H:i:s', time()) ."\n");
			} else {
				$detail['err_msg']['username'] = 'Vale kasutajanimi ja/või parool.';
			}
		}
	} else {
		$detail['err_msg']['username'] = 'Token on vale!';
	}
}

/*
 * REGISTER FORMI KOOD
*/
if(Input::get('action') === 'register') {

	/*
	 * Variable for token input that comes from POST / GET form.
	*/
	$token = Input::get(Config::get('app.token_name'));

	/* First of all check the token */
	if(Token::check($token) === TRUE) {
		// If token exists, we're good to go.

		/*
		 * Validate username
		*/

		$username = escape(Input::get('username'));
		$password = Input::get('password');
		$confirm_password = Input::get('check-password');

		if(strlen($username) < Config::get('app.username-min-length'))
		{
			$detail['err_msg']['username'] = 'Kasutajanimi peab olema vähemalt '. Config::get('app.username-min-length') .' tähemärki.';
		}
		elseif(strlen($username) > Config::get('app.username-max-length'))
		{
			$detail['err_msg']['username'] = 'Kasutajanimi peab olema väiksem, kui '. Config::get('app.username-max-length') .' tähemärki.';
		} elseif($user->find($username) === TRUE) // Check, if given username already exists.
		{
			$detail['err_msg']['username'] = 'Antud kasutajanimi ('. $username .') on juba kasutusel.';
		}

		/*
		 * Validate password
		*/
		elseif(strlen($password) < Config::get('app.password-min-length'))
		{
			$detail['err_msg']['password'] = 'Parool peab olema vähemalt '. Config::get('app.password-min-length') .' tähemärki.';
		}
		elseif(strlen($password) > Config::get('app.password-max-length'))
		{
			$detail['err_msg']['password'] = 'Parool peab olema väiksem, kui '. Config::get('app.password-max-length') .' tähemärki.';
		}
		elseif($confirm_password !== $password)
		{	
			$detail['err_msg']['password'] = 'Paroolid ei kattu!';
		}

		/*
		 * If something happens with validation, we need to create new token FROM here, cuz with ajax the browser is not refreshing.
		*/

		$detail['token'] = Token::generate();

		if(empty($detail['err_msg'])) {
			
			$register = $user->register($username, $password);

			if($register === TRUE) {
				$detail['status'] = 'success';

				Session::flash('register-success', 'Registreerimine õnnestus!');
			} else {
				$detail['err_msg']['username'] = 'Registreerimine ebaõnnestus!';
			}
		}
	} else {
		$detail['err_msg']['username'] = 'Token on vale!';
	}
}

/*
 * ADD MOVIE FORMI KOOD
*/
if(Input::get('action') === 'add_movie') {

	/*
	 * Variable for token input that comes from POST / GET form.
	*/
	$token = Input::get(Config::get('app.token_name'));

	/* First of all check the token */
	if(Token::check($token) === TRUE) {
		// If token exists, we're good to go.

		$title = escape(Input::get('title'));
		$rating = Input::get('rating');
		$release = escape(Input::get('release'));

		if(empty($title))
		{
			$detail['err_msg']['title'] = 'Filmi nimi on kohustuslik.';
		} 
		elseif($movie->exists($title) === TRUE)
		{
			$detail['err_msg']['title'] = 'Sa oled juba sellise nimega filmi endale lisanud.';
		}
		elseif(empty($rating))
		{
			$detail['err_msg']['rating'] = 'Filmi hinnang on kohustuslik.';
		}
		elseif(!intval($rating))
		{
			$detail['err_msg']['rating'] = 'Filmi hinnang peab olema numbriline.';
		}
		elseif($rating > Config::get('app.movie-rating-max') || $rating < Config::get('app.movie-rating-min'))
		{
			$detail['err_msg']['release'] = 'Filmi hinnang ei tohi olla suurem, kui '. Config::get('app.movie-rating-max') .' ja väiksem kui '. Config::get('app.movie-rating-min') .'.';
		}
		elseif(empty($release))
		{
			$detail['err_msg']['release'] = 'Filmi väljalaske aasta ei tohi olla tühi.';
		}
		elseif(DateTime::createFromFormat(Config::get('app.movie-date-format'), $release) === FALSE)
		{
			$detail['err_msg']['release'] = 'Filmi väljalaske aasta peab olema kujul: '. date(Config::get('app.movie-date-format'), time()) .'.';
		}

		/*
		 * If something happens with validation, we need to create new token FROM here, cuz with ajax the browser is not refreshing.
		*/

		$detail['token'] = Token::generate();

		if(empty($detail['err_msg'])) {
			$fields = array('title' => $title, 'rating' => $rating, 'user_id' => Session::get(Config::get('app.session-name')), 'release_date' => date('Y-m-d', strtotime($release)));
			
			$create = $movie->create($fields);

			if($create === TRUE) {
				$detail['status'] = 'success';

				Session::flash('movie-success', 'Film edukalt lisatud!');
			}
		}
	} else {
		$detail['err_msg']['title'] = 'Token on vale!';
	}
}

/*
 * SEARCH FOR MOVIE
*/
if(Input::get('action') === 'search_movie') {

	$keyword = escape(Input::get('search'));

	if(!empty($keyword))
	{
		$filming = $movie->search($keyword);

		if($filming) {
			foreach($filming as $film) {
				$detail['search_data'] .= '
					<div class="col-md-4">
						<div class="panel panel-default">
						  	<div class="panel-heading">
						    	<h3 class="panel-title">'. $film->title .'</h3>
						  	</div>
						  	<div class="panel-body">
						  		<p class="alert alert-info">Hinnang:'. $film->rating .'</p>
						  		<p class="alert alert-success">Väljalaske-aasta:<br />
						  		'. date('d.m.Y', strtotime($film->release_date)) .'</p>
						    	<div class="progress">
								  	<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '. percentage($film->rating, Config::get('app.movie-rating-max')) .'%;">
								    	'. percentage($film->rating, Config::get('app.movie-rating-max')) .'%
								  	</div>
								</div>
						  	</div>
						</div>
					</div>
				';
			}
		} else {
			$detail['search_data'] = '<div class="alert alert-danger">Sellist filmi me ei leidnud sinu lemmikute seast.</div>';
		}
	} else {

		$movies = $movie->find(Session::get(Config::get('app.session-name')));

		foreach($movie->results() as $film) {
			$detail['search_data'] .= '
				<div class="col-md-4">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">'. $film->title .'</h3>
					  	</div>
					  	<div class="panel-body">
					  		<p class="alert alert-info">Hinnang:'. $film->rating .'</p>
					  		<p class="alert alert-success">Väljalaske-aasta:<br />
					  		'. date('d.m.Y', strtotime($film->release_date)) .'</p>
					    	<div class="progress">
							  	<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '. percentage($film->rating, Config::get('app.movie-rating-max')) .'%;">
							    	'. percentage($film->rating, Config::get('app.movie-rating-max')) .'%
							  	</div>
							</div>
					  	</div>
					</div>
				</div>
			';
		}
	}

}

echo json_encode($detail);