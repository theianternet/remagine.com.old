<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title><?= ($title) ? $title : "" ; ?></title>
		<link rel="stylesheet" href="inc/style.css?<?= rand(100000,999999) ?>" type="text/css" />
		<?= $addToHead ?>
	</head>
	<body onLoad="<?= $onLoad ?>">
		<div id="site">
			<div id="header">
				<h1>Chat</h1>
			</div>
<!--
			<div id="nav">
				<ul>
					<li><a href="index.php" id="navHome"<?= ($menu == "home") ? "class=\"selected\"" : "" ; ?>>Home</a></li>
				</ul>
			</div>
-->
<?

			if ($errors) {
				if (!is_array($errors)) {
					$errors[] = $errors;
				}
				foreach ($errors AS $e) {
					echo $e ."<br />";
				}
			}
			if ($messages) {
				if (!is_array($messages)) {
					$messages[] = $messages;
				}
				foreach ($messages AS $e) {
					echo $e ."<br />";
				}
			}

?>