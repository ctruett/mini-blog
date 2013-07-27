<?php
	 class Post
	 {
			public $pid;
			public $type;
			public $imgpath;
			public $content;

			public function getFormattedDate($format)
			{
				 return date($format, strtotime($this->pid));
			}

			public function excerpt($content)
			{
				 if ($this->type === 'text')
				 {
						$domd = new DOMDocument();
						libxml_use_internal_errors(true);
						$domd->loadHTML($content);
						libxml_use_internal_errors(false);

						$domx = new DOMXPath($domd);
						$items = $domx->query("//p[position() = 1]");

						return substr($items->item(0)->textContent, 0, 140);
				 } else {
						return "<img src='/image.php?width=219&image=/".$this->imgpath."' />";
				 }
			}

			public function render()
			{
			?>
			<div class="post">
				 <h1 class="date">
						<span>
							 <?php echo $this->getFormattedDate('n.j.Y'); ?>
						</span>
						<?php echo $this->getFormattedDate('g:ia'); ?>
				 </h1>
				 <?php echo $this->content; ?>
			</div>
			<?php
			}
	 }
?>
