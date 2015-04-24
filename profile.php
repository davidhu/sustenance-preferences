<?php
	include 'api/include.php';
	include 'api/logincheck.php';
	
	$uid = $_SESSION["uid"];
	
	$stmt = 'SELECT username, email, password, first, last, birthdate, gender FROM users WHERE uid = $1';
	$query = pg_prepare($dbconn, "get_user_info", $stmt);
	
	$result;
	
	if (isset($_GET["fid"])) {
		$result = pg_execute($dbconn, "get_user_info", array($_GET["fid"]));
	}
	else {
		$result = pg_execute($dbconn, "get_user_info", array($uid));
	}
	
	$user_details = pg_fetch_array($result, 0, PGSQL_ASSOC);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sustenance Preferences</title>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/profile.css">
	</head>

	<body>

		<div class="container">
			<?php include "navbar.php"; ?> 
			<div class="row">
			<div class="row col-sidebar">
			<div class="avatar-card">
			<div class="col-md-1"></div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src=""></script>

	<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class=" panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">
				<?php echo $user_details["first"]." ".$user_details["last"]; ?>
			  </h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <th>Username</th>
						<td><?php echo $user_details["username"]; ?></td>
                      </tr>

                      <tr>
                        <th>First Name</th>
						<td><?php echo $user_details["first"]; ?></td>
                      </tr>

                      <tr>
                        <th>Last Name</th>
						<td><?php echo $user_details["last"]; ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <th>Date of Birth</th>
						<td><?php echo $user_details["birthdate"]; ?></td>
						</tr>

                      <tr>
                        <tr>
                        <th>Gender</th>
						<td><?php echo strtoupper($user_details["gender"]); ?></td>
                      </tr>

                      <tr>
                        <th>Email</th>
						<td><?php echo $user_details["email"]; ?></td>
                      </tr>
                      <tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                 </div>
          </div>
        </div>
      </div>
    </div>
	</body>
</html>
