<?php
//to-target
//notif-array of notifications
function sendNotif ($to, $notif){

    $feilds = array('to'=>$to, 'notification'=>$notif);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($feilds));
    
    $headers = array();
    $myKey = 'AAAAqtAy7_I:APA91bEXYbW-xivnG5Vw1HDpgu03jomSNYjM61WfqB1Fc3ywyzDDZ9u2tYQGcsI8nj-nr1B3wrS-ya113Wh-op4i1iR6Z-NRmb1Ch040QLM8i_i7Wa90n130ToSUZnSNHGOXW0Vz6lzH';
    $headers[] = 'Authorization: Key='.$myKey;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        $response=array(
            'status' => 0,
            'message' =>'Gagal Push'
         );
    }else{
        $response=array(
            'status' => 1,
            'message' =>'Berhasil Push'
        );
    }
    curl_close($ch);
    header('Content-Type: application/json');
    echo json_encode($response);
}

$title = $_POST['title'];
$body = $_POST['body'];
$token = $_POST['token'];
$to = $token;
// $to = 'dbdSPAxrSq2aUGx854HJ4z:APA91bGKh1lreTgoNgFCtDuzZ1QeT5cSG6IVg_qefRXzfIbeYB9RTEOl2ZpkK2odEw4d7AsC2gldj3vtxRc4vLLBcXTP8foqRglNslIAlEAeGtDEexnKTYGDbXMNTBE6ySjCHvRP5ui-';
$notification = array(
    'title' => $title,
    'body' => $body
);
sendNotif($to, $notification);
?>