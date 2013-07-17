<?php
   error_reporting(E_ALL);
   require_once 'assets/php/bootstrap.php' ;
   require_once 'assets/php/config.php';
   require_once 'assets/php/class.post.php';
   require_once 'assets/php/class.page.php';
   require_once 'assets/php/markdown.php';
?>

<?php
   $j = new Journal;
   $posts = $j->getPosts($postpath);
   $j->updatePosts($dropbox);
?>

<?php require_once 'assets/php/template/header.php'; ?>

<section>
<?php $j->renderPosts($posts, $postcount); ?>
</section>

<aside>
<div>
   <span>
      Featherweight
      <br />
      By Christopher Truett
   </span>
</div>
</aside>

<?php require_once 'assets/php/template/footer.php'; ?>
