<? include "config/core.php";

	$core->user_unset();
	$_SESSION['comp'] = '';
	$_SESSION['branch'] = '';
	header('location: /');