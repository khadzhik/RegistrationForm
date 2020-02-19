<?php

include('connection/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$data = $_POST;
	$user = R::findOne('users', 'login = ?', array($data['login']));
	$errors = array();

	if ($user) 
	{	
		if (password_verify($data['password'], $user->password))
		{
			echo "you are authorized! <a href='index.php'>main</a>";
			$_SESSION['logged_user'] = $user;
		} else 
		{
			$errors[] = "incorrect password";
		}

	} else 
	{
		$errors[] = "user with such login not found";
	}

	if ($errors) 
	{
		foreach ($errors as $error) {
			echo $error;
		}
	}

}

?>

<form action="login.php" method="POST">
	<div>
		<div>
			<div><strong>name</strong>:</div>
			<input type="text" name="login">
		</div>

		<div>
			<div><strong>password</strong>:</div>
			<input type="password" name="password">
		</div>

		<div>
			<button type="submit" name="btn">login</button>
		</div>
	</div>
</form>