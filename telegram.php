<?php
class Telegram{
    public $token;
    public $db;

    public function __construct($token,$dbname,$dbuser,$dbpass)
    {
        $this->token = $token;
        $this->db = new PDO("mysql:host=localhost;dbname=$dbname", $dbuser, $dbpass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    public function getUpdate()
    {
        return json_decode(file_get_contents("php://input"));
    }

    # Send Text to User
    public function sendMessage($userid, $text , $keynoard = null)
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/sendMessage';
        $fields = [
            'chat_id' => $userid,
            'text' => $text,
            //'parse_mode' => 'html',
        ];

        if ($keynoard != null){
            $fields['reply_markup'] = $this->makeMenu($keynoard);
        }
        return $this->exeCurl($url,$fields);
    }

    public function sendAction($userid,$action){
        $url = "https://api.telegram.org/bot".$this->token."/sendAction";

        $fields = [
            'chat_id' => $userid,
            'action' => $action,
        ];
        return $this->exeCurl($url,$fields);
    }



    # Method Send Sound to User
    public function sendAudio($userid, $audio , $caption = '')
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/sendAudio';
        $fields = [
            'chat_id' => $userid,
            'audio' => $audio,
            'caption' => $caption,
        ];
        return $this->exeCurl($url,$fields);
    }




    #Method Show Size
    public function formatBytes($size){
        $base = log($size) / log(1024);
        $suffix = array("", "KB", "MB", "GB", "TB");
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
    }



    public function makeMenu($keynoard)
    {
        $kekyboard = [
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
            'selective' => true,
            'keyboard' =>$keynoard,
        ];
        return json_encode($kekyboard);
    }


    public function exeCurl($url,$fields = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        $content = curl_exec($ch);
        curl_close($ch);
        return json_decode($content);
    }

    public function executeCurl($method,$fields = []){
        $url = "https://api.telegram.org/bot".$this->token."/$method";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        curl_close($ch);
        return json_decode($content);
    }
}