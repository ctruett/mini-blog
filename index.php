<?php
	 require_once('include/header.php');

	 include('include/config.php');
	 include('include/php-typography/php-typography.php');
	 include('include/markdown.php');
	 include('include/class.post.php');
	 include('include/class.page.php');

	 if (isset($_GET['p'])) {
			$pid = $_GET['p'];
	 } else {
			$pid = '';
	 }

	 $p = new Page;
	 $p->buildPage();

	 require_once('include/footer.php');
?>
