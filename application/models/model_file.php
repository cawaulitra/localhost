<?php
class Model_File extends Model
{
    function download($id) {
        $mysqli = $this->sql_connect();
		if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

        $string_file = "SELECT * FROM `files` WHERE `id` LIKE '$id'";
        //echo $string_file;
        if ($result = $mysqli->query($string_file)) {
            //echo "квери";
            while ($fletcher = $result->fetch_assoc()) {
                $file[] = [
                    'id' => $fletcher['id'],
                    'id_comment' => $fletcher['id_comment'],
                    'link' => $fletcher['link']
                ];
            }
        }
        $filename = $file['link'];
        //var_dump ($file);
        //echo (strstr($file[0]['link'], '.'));
        if (strstr($file[0]['link'], '.') == '.txt') {
            $type = 'text/plain';
        }

        if (strstr($file[0]['link'], '.') == '.jpg') {
            $type = 'image/jpeg';
        }

        if (strstr($file[0]['link'], '.') == '.png') {
            $type = 'image/png';
        }

        if (strstr($file[0]['link'], '.') == '.gif') {
            $type = 'image/gif';
        }

        if (strstr($file[0]['link'], '.') == '.rar') {
            $type = 'application/vnd.rar';
        }

        $path = "../localhost/files/" . $file[0]['link'];
        header("Content-Type: $type");
        header("Content-Disposition: attachment; filename=$filename");
        readfile($path);

        //echo $path;

    }
}
?>