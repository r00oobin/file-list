<!DOCTYPE html>
<html>
<head>
	<title>File List</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- my Stylesheet -->
	<link rel="stylesheet" type="text/css" href="./MyGit/assets/css/stylesheet.css">
	<link rel="stylesheet" href="./assets/css/filetree.css">
</head>
<body>
    <div class="row">
		<?php
		echo '<div class="files">';
		echo '<ul class="filetree" style="margin-top: 10px;">';
		$level = 1;
		$filescount = true;
		function getFiles($dir) {
			$level = $GLOBALS["level"];
			$folders = array();
			$filenumber = 1;
			$files = scandir($dir);
			if(count($files) < 3){
				$GLOBALS["filescount"] = false;
			}
			foreach ($files as &$file) {
				if($file != '.'){
					if($file != '..'){
						$path_file = pathinfo($file);
						if(is_file($dir . $file)){
							echo "<li onclick='location.href=". '"' . './' . $dir . $path_file['basename']  . '"' . "' class='file'>" . $file . '</li>';
						} else {
							array_push($folders, $dir . $file . "/");
						}
					}
				}
			}

			foreach ($folders as &$folder) {

				$foldername = pathinfo($folder);
				echo "<li>";
				echo '<input type="checkbox" id="level'.$level.'-'.$filenumber.'">';
				echo '<label class="folder" for="level'.$level.'-'.$filenumber.'">'.$foldername['filename'].'</label>';
									
				echo "<ul>";
				$filenumber += 1;
				$GLOBALS["level"]++;
				getFiles($folder);
				echo "</ul>";
				echo "</li>";
			}
		}
		$dir    = "./";
		getFiles($dir);
		if(!$GLOBALS['filescount']){
			echo "<div class='descriptionuser'>no file in folder</div>";
		}
		echo "</ul>";
		?>
	</div>
</body>
</html>