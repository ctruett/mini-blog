<?php

	 class Page
	 {
			function __construct() {
				 if (isset($_GET['p']))
				 {
						$this->current_page = $_GET['p'];
				 } else {
						$this->current_page = '';
				 }
			}

			public $path = 'c://Users//Chris//My Journal//*.md';

			public function unicode_escape_sequences($str)
			{
				 $working = json_encode($str);
				 $working = preg_replace('/\\\u([0-9a-z]{4})/', '&#x$1;', $working);
				 return json_decode($working);
			}

			public function getFiles($path)
			{
				 $files = glob($path);
				 rsort($files);
				 return $files;
			}

			public function getPosts() {
				 $files = $this->getFiles($this->path);
				 $posts = array();
				 foreach ($files as $file)
				 {
						$obj = new Post;
						$obj->pid = str_replace('.md','',str_replace('c://Users//Chris//My Journal//','',$file));
						$obj->date = array(date('Y', strtotime($obj->pid)), date('F', strtotime($obj->pid)), date('jS', strtotime($obj->pid)), date('h:i a', strtotime($obj->pid)));
						$obj->formatted_date = date('l, F j, Y', strtotime($obj->pid)) . " at " . date('h:i a', strtotime($obj->pid));
						$obj->year = $obj->date[0];
						$obj->month = $obj->date[1];
						$obj->day = $obj->date[2];
						$obj->time = $obj->date[3];
						$obj->content = Markdown($this->unicode_escape_sequences(file_get_contents($file)));
						array_push($posts, $obj);
				 }
				 return $posts;
			}

			public function buildArchive()
			{
				 $posts = $this->getPosts();

				 $r = array();
				 foreach ($posts as $post=>$o)
				 {
						$y = $o->year;
						$m = $o->month;
						$d = $o->day;
						$t = $o->time;
						$r[$y][$m][$d][] = $o;
				 }
				 return $r;
			}

			public function renderArchive()
			{
				 $posts = $this->buildArchive();

				 $curYear = date('y', strtotime($this->current_page));
				 $curMonth = date('F', strtotime($this->current_page));
				 $curDay = date('jS', strtotime($this->current_page));
				 $curTime = date('h:i a', strtotime($this->current_page));
			?>

			<div id="archives">
				 <?php foreach ($posts as $year=>$months): ?>
				 <ul>
						<p><?php echo $year; ?></p>
						<?php foreach ($months as $month=>$days): ?>
						<ul>
							 <p><?php echo $month; ?></p>
							 <?php foreach ($days as $day=>$posts): ?>
							 <ul>
									<p><?php echo $day; ?></p>
									<?php foreach ($posts as $post=>$p): ?>
									<ul>
										 <?php if ($p->pid === $this->current_page): ?>
										 <p>
										 <?php echo $p->time; ?><br />
										 <?php echo $p->getExcerpt($p->content); ?>&hellip;
										 </p>
										 <?php else : ?>
										 <p>
										 <a href='/<?php echo $p->pid; ?>'><?php echo $p->time; ?></a><br />
										 <?php echo $p->getExcerpt($p->content); ?>&hellip;<br />
										 </p>
										 <?php endif; ?>
									</ul>
									<?php endforeach; ?>
							 </ul>
							 <?php endforeach; ?>
						</ul>
						<?php endforeach; ?>
				 </ul>
				 <?php endforeach; ?>
			</div>

			<?php
			}

			public function buildPage() {
				 $files = $this->getFiles($this->path);

				 if (isset($this->current_page))
				 {
						$key = array_keys(preg_grep('/'.$this->current_page.'/', $files));
						$html = Markdown($this->unicode_escape_sequences(file_get_contents($files[$key[0]])));
						// $typo = new phpTypography();
						// $html = $typo->process($html);
						echo $html;
				 } else {
						$html = Markdown($this->unicode_escape_sequences(file_get_contents($files[0])));
						// $typo = new phpTypography();
						// $html = $typo->process($html);
						echo $html;
				 }
			}

	 }

?>
