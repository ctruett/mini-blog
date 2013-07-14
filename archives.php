<?php require_once('include/header.php'); ?>
<?php
	 include('include/config.php');
	 include('include/php-typography/php-typography.php');
	 include('include/markdown.php');
	 include('include/class.post.php');
	 include('include/class.page.php');
	 $p = new Page;
?>

<h2>Archives</h2>
<?php $p->renderArchive(); ?>

<?php require_once('include/footer.php'); ?>
