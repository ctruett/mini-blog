<?php
	 class Post
	 {
			public $pid;
			public $date;
			public $formatted_date;
			public $year;
			public $month;
			public $day;
			public $time;
			public $content;
			public function getExcerpt($content)
			{
				 $domd = new DOMDocument();
				 libxml_use_internal_errors(true);
				 $domd->loadHTML($content);
				 libxml_use_internal_errors(false);

				 $domx = new DOMXPath($domd);
				 $items = $domx->query("//p[position() = 1]");

				 return substr($items->item(0)->textContent, 0, 100);
			}
	 }
?>
