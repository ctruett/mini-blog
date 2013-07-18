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
							 $date = str_replace(':','.', str_replace(' ','.', exif_read_data($file)['DateTimeOriginal']));
							 list($y,$mo,$d,$h,$m,$s) = explode('.', $date);
							 $obj->pid = $y.$mo.$d.$h.$m;
							 $obj->content = "<img src='image.php?width=438&image=/$obj->imgpath' />";
						} else {
							 $obj->type = 'text';
							 $cleanfile = str_replace('.md','', str_replace('./posts/','',$file));
							 $obj->pid = $cleanfile;
							 $obj->content = Markdown($this->unicode_escape_sequences(file_get_contents($file)));
						}
						$obj->date = array(date('Y', strtotime($obj->pid)), date('F', strtotime($obj->pid)), date('jS', strtotime($obj->pid)), date('h:i a', strtotime($obj->pid)));
						$obj->year = $obj->date[0];
						$obj->month = $obj->date[1];
						$obj->day = $obj->date[2];
						$obj->time = $obj->date[3];
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

			public function updatePosts($dropbox) {

				 // Set the remote file path
				 $path = 'Public';

				 // Note: Use a hash to test the NotModifiedException
				 $hash = null;

				 // Limit the entries returned
				 $limit = 100;

				 // Get meta information and create an array with our file objects
				 $metaData = $dropbox->metaData($path, null, $limit, $hash);
				 $remoteFiles = $metaData['body']->contents;

				 // For each remote file
				 foreach ($remoteFiles as $remoteFile)
				 {
						// Get info for both local and remote files
						$rpath = $remoteFile->path;
						$rfile = basename($remoteFile->path, '/Public/');
						$rmtime = strtotime($remoteFile->modified);

						$lfile = glob('posts/'.$rfile)[0];
						$lmtime = filemtime($lfile);

						// Only download if remote file is newer
						if ($rfile > $lfile)
						{
							 echo realpath("posts/$lfile");
							 $dropbox->getFile($rpath, "posts/$rfile");
						}
				 }
			}

	 }

?>
