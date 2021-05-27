<?php
class Model_File extends Model
{
    function download($id) {
        $mysqli = $this->sql_connect();
		if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

        $string_file = "SELECT * FROM `files_tickets` WHERE `id` LIKE '$id'";
        //echo $string_file;
        if ($result = $mysqli->query($string_file)) {
            //echo "квери";
            while ($fletcher = $result->fetch_assoc()) {
                $file[] = [
                    'id' => $fletcher['id'],
                    'id_ticket' => $fletcher['id_ticket'],
                    'name' => $fletcher['name']
                ];
            }
        }
        $filename = $file['name'];
        //var_dump($file);
        //echo (strstr($file[0]['link'], '.'));
        if (strstr($file[0]['name'], '.') == '.txt') {
            $type = 'text/plain';
        }

        if (strstr($file[0]['name'], '.') == '.jpg') {
            $type = 'image/jpeg';
        }

        if (strstr($file[0]['name'], '.') == '.png') {
            $type = 'image/png';
        }

        if (strstr($file[0]['name'], '.') == '.gif') {
            $type = 'image/gif';
        }

        if (strstr($file[0]['name'], '.') == '.rar') {
            $type = 'application/vnd.rar';
        }

        $path = "../localhost/files/tickets/" . $file[0]['name'];
        if (($f = @fopen($path, r)) == true) {
            fclose($f);
            header("Content-Type: $type");
            header("Content-Disposition: attachment; filename=$filename");
            readfile($path);
        }
        //echo $path;

    }
}
?>