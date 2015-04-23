<nav role="navigation" class="navbar navbar-inverse">
        <!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="home.php" class="navbar-brand">Sustenance Preferences</a>
	</div>
        <!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="profile.php">Profile</a></li>
			<li><a href="friends.php">Friends</a></li>
			<li><a href="diary.php">Food Diary</a></li>
			<li><a href="restaurants.php">Restaurants</a></li>
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Suggestions<b class="caret"></b></a>
				<ul role="menu" class="dropdown-menu">
					<li><a href="rec_history.php">My Suggestions</a></li>
					<li><a href="suggestions.php">Others' Suggestions</a></li>
				</ul>
			</li>
			<li><a href="hungry.php">I'M HUNGRY</a></li>
		</ul>
		<form role="search" class="navbar-form navbar-left" method="get" action="search.php">
			<div class="form-group">
				<input type="text" placeholder="Search Users" name="user" class="form-control">
			</div>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
</nav>
