<?php
require_once ('telegram.php');
require_once ('config.php');

$telegram = new Telegram(TOKEN,DB_NAME, DB_USERNAME, DB_PASSWORD);
$data = $telegram->getUpdate();

$userid = $data->message->from->id;
$text = $data->message->text;
$name = $data->message->from->first_name." ".$data->message->from->last_name;
$username = $data->message->from->username;
$time = time();
#$timereal = date("Y/m/d \nH:i:s", $time);

var_dump($data);

if (!file_exists("state/$userid")){
    file_put_contents("state/$userid",'');
}
$state = file_get_contents("state/$userid");


# channel
$fileid = $data->channel_post->audio->file_id;
$duration = $data->channel_post->audio->duration;
$performer = $data->channel_post->audio->performer;
$filesize = $data->channel_post->audio->file_size;
$title = $data->channel_post->audio->title;
$caption = $data->channel_post->caption;


$keyboard_find = [
    ['🔍 جستجوی آهنگ','📕 راهنما']
];

$keyboard_back = [
    ['◀️ بازگشت']
];

if ($fileid){
    $rowCount = $telegram->db->query("SELECT * FROM music WHERE fileid='$fileid'")->rowCount();
    if ($rowCount == 0){
        $telegram->db->query("INSERT INTO music VALUES (NULL,'$fileid','$title',$filesize,$duration,'$performer','$caption',$time)");
    }
}


if (preg_match('/start/',$text) or $text == '◀️ بازگشت')
{
    file_put_contents("state/$userid",'');
    $telegram->sendAction($userid,'typeing...');
    $telegram->sendMessage($userid,"سلام به بات میلی موزیک خوش آمدید 🌹",$keyboard_find);
    exit();
}


if (preg_match('/download/',$text)){
    $id = str_ireplace("/download_" , '', $text);
    $music = $telegram->db->query("SELECT * FROM music WHERE id=$id")->fetch();
    if (!empty($music)){
        $fileid = $music['fileid'];
        $caption = $music['caption'];
        $telegram->sendAudio($userid,$fileid,$caption);
    }
    exit();
}


if ($text == "📕 راهنما"){
    $telegram->sendAction($userid,"Typing...");
    $telegram->sendMessage($userid,"🎧 این یک ربات جستجو و یافت آهنگ های مورد علاقه شما است.");
}


if ($text == "🔍 جستجوی آهنگ"){
    file_put_contents("state/$userid",'search');
    $telegram->sendAction($userid,'Typeing...');
    $telegram->sendMessage($userid,"🗣 نام خواننده یا آهنگ مورد علاقه خود را وارد کنید :",$keyboard_back);
}


if ($state == "search"){
    $result = $telegram->db->query("SELECT * FROM music WHERE title LIKE '%$text%' or caption like '%$text%' or performer like '%$text%'")->fetchAll();
    if (empty($result)){
        $telegram->sendMessage($userid,"❌ متاسفانه آهنگ یا خواننده مورد نظر یافت نشد.");
    }
    $msg = "";
    foreach ($result as $music){
        $id = $music['id'];
        $title = $music['title'];
        $caption = $music['caption'];
        $duration = gmdate("i:s",$music['duration']);
        $filesize = $telegram->formatBytes($music['filesize']);
        $msg .="
▶️ $title
⏱  $duration
💾 $filesize
📥 /download_$id"."\n";
    }
    $telegram->sendMessage($userid,$msg);
}


?>