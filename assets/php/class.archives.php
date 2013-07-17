			public function renderArchive($posts, $count)
			{

				 $archive = array();
				 for ($i = 0; $i < $count; $i++)
				 // foreach ($posts as $post=>$o)
				 {
						$y = $posts[$i]->year;
						$m = $posts[$i]->month;
						$d = $posts[$i]->day;
						$t = $posts[$i]->time;
						$archive[$y][$m][$d][] = $posts[$i];
				 }
			?>

			<div id="archives">
				 <?php foreach ($archive as $year=>$months): ?>
				 <?php foreach ($months as $month=>$days): ?>
				 <?php foreach ($days as $day=>$posts): ?>
				 <h3>
						<?php echo "$month $day, $year"; ?>
				 </h3>
				 <dl>
						<?php foreach ($posts as $post=>$p): ?>
						<dt>
						<a href='#<?php echo $p->pid; ?>'><?php echo $p->time; ?></a>
						<?php if ($p->type === 'text') : ?>
						[Text]
						<?php else : ?>
						[Photo]
						<?php endif; ?>
						</dt>
						<?php endforeach; ?>
				 </dl>
				 <?php endforeach; ?>
				 <?php endforeach; ?>
				 <?php endforeach; ?>
			</div>

			<?php
			}
