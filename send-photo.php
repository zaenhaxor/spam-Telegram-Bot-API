<?php
$merah = "\033[0;31m"; 
$cyan = "\033[0;36m";
$hijau = "\033[0;32m"; 
$reset = "\033[0m";

// ganti bot token
$bot_token = '<change bot token here>';

//ganti chat id
$chat_id = '<change chat id here>';

$banner = "
{$cyan}
____ ____ _  _ ___     ___  _  _ ____ ___ ____    ___  ____ ___    ___ ____ _    ____ ____ ____ ____ _  _ 
[__  |___ |\ | |  \    |__] |__| |  |  |  |  |    |__] |  |  |      |  |___ |    |___ | __ |__/ |__| |\/| 
___] |___ | \| |__/    |    |  | |__|  |  |__|    |__] |__|  |      |  |___ |___ |___ |__] |  \ |  | |  | 
                                                                    by Zaen haxor{$reset}
";
echo $banner;

if ($argc != 2) {
    echo "{$merah}Usage: php send-photo.php <jumlah request>{$reset}\n";
    exit(1);
}
$jumlah_requests = (int)$argv[1];

/* change lokasi file gambar, sebagai contoh:
linux: /home/zaenhxr/file/tes/jpg
windows: c:\users\zaenhxr\downloads\tes.jpg
android (termux): /sdcard/zaenhxr/file/tes.jpg */
$path_photo = '<change lokasi gambar disini>';

for ($i = 0; $i < $jumlah_requests; $i++) {
    sendPhoto($chat_id, $path_photo, $hijau, $merah, $reset);
}

function sendPhoto($chat_id, $path_photo, $hijau, $merah, $reset) {
    global $bot_token;
    $url = "https://api.telegram.org/bot$bot_token/sendPhoto";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'chat_id' => $chat_id,
        'photo' => new CURLFile($path_photo)
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response === false) {
        echo "[{$merah}-{$reset}] Error send photo !\n";
    } else {
        $result = json_decode($response, true);
        $respone = json_decode($response, true);
        if (isset($respone['ok']) && $respone['ok']) {
            echo "[{$hijau}+{$reset}] Success.\n";
        } else {
            echo "[{$merah}-{$reset}] Failed to send.\n";
        }
    }
    curl_close($ch);
}
?>
