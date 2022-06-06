<?php
function sendNotification ($to,$notification,$app){
    if($app=="chat"){
        $apiKey="AAAAl0w-UO8:APA91bGgbQRoOQ9akPA9giiTS1JP83_5mx90WBva3nahovMmIORF_moet4A0TpBZIPmcOxMtGNkTQeJXhlwUkxUvE2MdRFMceugFCANAWgI0bK9s6lNSbTWPCpfpyONGRpdiWfURMLVY";
    }

    if($app=="app"){
        $apiKey="AAAAIjxdKWU:APA91bGPKIKVmQ_kxpQU2ObE_fu1IlJJzbli16RqTYbtJB5swaRLysuNHl8NEPXiEXkszbAkA50Vd9i0Bo8-yytT9AagZeFVW9g4vD6FugprHgEPOCR63PRG6c3kKBLgm7xIHE4Puche";
    }

    $ch = curl_init();

    $url="https://fcm.googleapis.com/fcm/send";
    $fields=json_encode(array('to'=>$to,"notification"=>$notification,"collapse_key"=>"new_messages",'priority'=>'high'));

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $headers = array();
    $headers[] = 'Authorization: key ='.$apiKey;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}



?>