<?php

require_once('../conf/init.php');

use backend\controllers\Accounts;

$accounts = new Accounts();

$user = $accounts->getUser(1);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
</head>
<body>
	<div>
		<span>Email:</span>
		<span><?=$user['email']?></span>
	</div>
</body>
</html>