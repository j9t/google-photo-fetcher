<?php
	// User: expects the ID or name of the Google account (otherwise fails silently)
	$user = htmlEntities($_GET["user"], ENT_QUOTES);
	// Size (otherwise 64×64)
	$w = htmlEntities($_GET["w"], ENT_QUOTES);
	$h = htmlEntities($_GET["h"], ENT_QUOTES);
	// Debug: non-empty for debug message (otherwise redirect to image)
	$debug = htmlEntities($_GET["debug"], ENT_QUOTES);

	$data = json_decode(@file_get_contents("http://picasaweb.google.com/data/entry/api/user/" . $user . "?alt=json"));
	$avatar = $data->{"entry"}->{"gphoto\$thumbnail"}->{"\$t"};
	if ($w != "" && $h != "") {
		$avatar = str_replace("s64-c", "w" . $w . "-h" . $h . "-no", $avatar);
	}
	if (isset($_GET['debug'])) {
		echo "<!DOCTYPE html>";
		echo "<title>Debug</title>";
		echo "<p>Debug: " . $avatar;
	} else {
		header("Location: $avatar", TRUE, 302);
	}
?>