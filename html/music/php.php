<?php
preg_match('/\{\'ARTISTPIC[\d\D]{0,}\'\}\]\}/', file_get_contents('https://search.kuwo.cn/r.s?SONGNAME=' . $_GET["name"] . '&ft=music&rformat=json&encoding=utf8&rn=' . $_GET["number"] . '&callback=song&vipver=MUSIC_8.0.3.1'), $match);
$arr = json_decode(str_replace("'", "\"", $match[0]), true);
echo "{\"result\":[";
for ($x = 0;$x < $_GET["number"];$x++) {
    file_get_contents("http://antiserver.kuwo.cn/anti.s?format=mp3&rid=" . $arr['abslist'][$x]['MUSICRID'] . "&type=convert_url&response=res");
    foreach ($http_response_header as $loop) {
        if (strpos($loop, "Location") !== false) {
            $result = trim(substr($loop, 10));
        }
    }
    echo json_encode(array('NAME' => $arr['abslist'][$x]['NAME'],'ARTIST' => $arr['abslist'][$x]['ARTIST'],'ALBUM' => $arr['abslist'][$x]['ALBUM'],'URL' => $result), 320);
    echo ",";
}
echo "{\"AUTHOR\":\"何俊衡\"}]}";
?>