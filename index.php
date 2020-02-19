<?php 

include('connection/db.php');

if (isset($_SESSION['logged_user']))
{
	echo "you are authorized " . "<strong>" . $_SESSION['logged_user']->login . "</strong>";
	echo "<br><br><a href='logout.php'>exit</a>";
} else { ?>

<a href="login.php">LOG IN</a>
<br><br>
<a href="signup.php">SIGIN</a>

<?php } ?>

