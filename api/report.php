<?php
$message = $_POST["message"];
$url = $_POST["url"];
$img_json = $_POST["img_json"];
$json_file = $img_json;
$json_data = file_get_contents($json_file);
        $data = json_decode($json_data, true);
        if(!is_null($data)){
            logClient('Some 1 reported the imagine: 
            IMAGINE NAME: '.$data['title'].'
            IMAGINE OWNER: '.$data['username'].'
            REASON: '. $message .'
            URL: ' . $url);
        }
        else
        {
            //return;
        }

?>
