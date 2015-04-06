<?php
require_once('../../db_con/dbYhteys.php');
require_once('../../db_con/funktiot.php');
require_once('../../db_con/dbFunctions.php');
?>

<?php /* 
session_start();
require_once('funktiot/dbYhteys.php');
require_once('funktiot/funktiot.php');
require_once('funktiot/dbFunctions.php');
SSLon();
*/

//Login -> $_SESSION['kirjautunut']='loggedIn'	
if(!empty($_POST['username'])&&!empty($_POST['pwd'])){
	if(check_user($_POST['username'], $_POST['pwd'], $DBH)){
		 $_SESSION['kirjautunut'] = 'loggedIn';
	} else {
		echo '<script>alert("Login Failure");</script>';
	}
}

//Logout session_destroy();
if($_GET['action'] == 'logout'){
	unset($_SESSION['kirjautunut']);
	session_destroy();
}

//Tarkastetaan sisäänkirjatuminen, jos inessä näytetään "Logout"
if ($_SESSION['kirjautunut'] == 'loggedIn'):
?>
	<p>This Should Show Up Only When Logged In?</p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=logout">Logout</a>
	<p>Username: <?php echo $_POST['username'] ?> </p>
	<?php require_once('julkaisu.php');?>
	
<?php
//Else Login-palikka
else: 
?>
<a href="#" data-reveal-id="login">Login</a>

<?php
// lopeta if
endif;
		  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ownage</title>
	<link href="base.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Oswald:700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<meta charset="utf-8">
</head>
<body>
<div id="login" class="reveal-modal">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" name="username" placeholder="insert username" />
    <input type="password" name="pwd" placeholder="insert password" />
    <input type="submit" name="login" value="Login" class="button" />
  </form>
  <a class="close-reveal-modal"></a></div>
</body>
</html>