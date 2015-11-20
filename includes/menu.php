<nav class="navbar navbar-default">
  	<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
    	<div class="navbar-header">
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	      	</button>
      		<a class="navbar-brand" href="#">Test 6</a>
    	</div>

    	<!-- Collect the nav links, forms, and other content for toggling -->
    	<div class="collapse navbar-collapse" id="navbar-main">
          <?php if($user->isLoggedIn() === TRUE): ?>
          <ul class="nav navbar-nav">
            <li><p class="navbar-text">Tere tulemast, <?php echo $user->data()->username; ?>!</p></li>
          </ul>
        <?php endif; ?>
      		<ul class="nav navbar-nav navbar-right">
        		<li><a href="index.php">Avaleht</a></li>
            <?php if($user->isLoggedIn() === FALSE): ?>
            <li><a href="login.php">Login</a></li>
        		<li><a href="register.php">Register</a></li>
          <?php else: ?>
            <li><a href="movies.php">Sinu filmid</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php endif; ?>
      		</ul>
    	</div><!-- /.navbar-collapse -->
  	</div><!-- /.container-fluid -->
</nav>