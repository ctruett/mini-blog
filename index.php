<?php
	 error_reporting(E_ALL);
	 require_once 'assets/php/config.php';
	 require_once 'assets/php/class.post.php';
	 require_once 'assets/php/class.page.php';
	 require_once 'assets/php/markdown.php';
?>

<?php
	 $j = new Journal;
	 $posts = $j->getPosts($postpath);
?>

<?php require_once 'assets/php/template/header.php'; ?>

<header>
<div>
	 <img src="/assets/img/portrait.jpg" alt="" />
	 <h2>
			Featherweight <span>by Christopher Truett</span>
	 </h2>
</div>
</header>
<section>

<article>
<?php $j->renderPosts($posts, $postcount); ?>
</article>

</section>

<?php require_once 'assets/php/template/footer.php'; ?>
