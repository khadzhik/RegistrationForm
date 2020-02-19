<?php 

include('connection/db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

	$data = $_POST;

	if ($errors_form = validate_form($data))
	{
		foreach ($errors_form as $error) {
			echo $error . "<br>";
		}
	} else 
	{
		$user = R::dispense('users');

		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);

		R::store($user); 

		echo "вы в бд епт";
	}
}


function validate_form($data) 
{
	$errors = array();

	if (strlen($data['login']) <= 4) {
		$errors[] = "login at least 4 characters !";
	}

	if (strlen($data['email']) <= 14) {
		$errors[] = "enter email at least 4 characters !";
	}

	if (strlen($data['password']) <= 6) {
		$errors[] = "enter a password of at least 4 characters !";
	}

	if ($data['password'] != $data['password2']) {
		$errors[] = "re-password is not correct !";
	}

	if (R::count('users', 'login = ?', array($data['login'])) > 0) {
		$errors[] = "a user with that name exists !";
	}

	if (R::count('users', 'email = ?', array($data['email'])) > 0) {
		$errors[] = "a user with that email exists !";
	}

	return $errors;
}

?>

<form action="signup.php" method="POST">
	<div>
		<div>
			<div><strong>name</strong>:</div>
			<input type="text" name="login">
		</div>

		<div>
			<div><strong>email</strong>:</div>
			<input type="email" name="email">
		</div>

		<div>
			<div><strong>password</strong>:</div>
			<input type="password" name="password">
		</div>

		<div>
			<div><strong>password again</strong>:</div>
			<input type="password" name="password2">
		</div>

		<div>
			<button type="submit" value="btn">sigup</button>
		</div>
	</div>
</form>



