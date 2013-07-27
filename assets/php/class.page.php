<?php

	 class Journal
	 {
			public function unicode_escape_sequences($str)
			{
				 $working = json_encode($str);
				 $working = preg_replace('/\\\u([0-9a-z]{4})/', '&#x$1;', $working);
				 return json_decode($working);
			}

			public function getPosts($path)
			{
				 $files = glob($path);
				 rsort($files);
				 $posts = array();
				 foreach ($files as $file)
				 {
						$obj = new Post;
						if (strpos($file,'.jpg') !== false) {
							 $obj->type = 'image';
							 $obj->imgpath = str_replace('./','',$file);
							 $cleanfile = str_replace('./posts/','',$file);
							 $exif = exif_read_data($file);
							 $date = str_replace(':','.', str_replace(' ','.', $exif['DateTimeOriginal']));
							 list($y,$mo,$d,$h,$m,$s) = explode('.', $date);
							 $obj->pid = $y.$mo.$d.$h.$m;
							 $obj->content = "<img src='image.php?width=460&image=/$obj->imgpath' />";
						} else {
							 $obj->type = 'text';
							 $cleanfile = str_replace('.md','', str_replace('./posts/','',$file));
							 $obj->pid = $cleanfile;
							 $obj->content = Markdown($this->unicode_escape_sequences(file_get_contents($file)));
						}
						$posts[$obj->pid] = $obj;
				 }
				 rsort($posts);
				 return $posts;
			}

			public function renderPosts($posts, $count = 'all') {
				 if ($count === 'all')
				 {
						$count = count($posts);
				 }

				 for ($i = 0; $i < $count; $i++)
				 {
						$posts[$i]->render();
				 }
			}
	 }

?>
