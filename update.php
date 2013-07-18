<?php
	 error_reporting(E_ALL);
	 require_once 'assets/php/bootstrap.php' ;
	 require_once 'assets/php/config.php';
	 require_once 'assets/php/class.page.php';
?>

<?php
	 $j = new Journal;
	 $j->updatePosts($dropbox);
?>

<?php require_once 'assets/php/template/header.php'; ?>

<article class="update">
<img src="/assets/img/dropbox.png" alt="Psychobox from Dropbox.com/404" />
<strong>Getting all your stuff from Dropbox...</strong><br />
Okay, everything should be up to date now.
</article>

<aside></aside>

<script type="text/javascript">
	 setTimeout(function(){window.location = "http://journal.local"},2000);
</script>

<?php require_once 'assets/php/template/footer.php'; ?>
