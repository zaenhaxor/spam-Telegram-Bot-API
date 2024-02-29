<?php
$merah = "\033[0;31m";
$kuning = "\033[1;33m";
$hijau = "\033[0;32m";
$reset = "\033[0m";

// ganti bot token
$bot_token = '<change bot token here>';

// ganti chat id
$chat_id = '<change chat id here>';

$banner = "
{$kuning}
____ ____ _  _ ___     ___ ____ _  _ ___    ___  ____ ___   ___ ____ _    ____ ____ ____ ____ _  _ 
[__  |___ |\ | |  \\     |  |___  \\/   |     |__] |  |  |      |  |___ |    |___ | __ |__/ |__| |\\/| 
___] |___ | \\| |__/     |  |___ _/\\_  |     |__] |__|  |      |  |___ |___ |___ |__] |  \\ |  | |  | 
                                                                by Zaen haxor                                  
{$reset}
";
echo $banner;

if ($argc != 3) {
    echo "{$merah}Usage: php send-text.php <pesan> <jumlah request>{$reset}\n";
    exit(1);
}
$pesan = $argv[1];
$jumlah_requests = (int)$argv[2];

$curl = curl_init();

// menggunakan $bot_token dan $chat_id
$url = "https://api.telegram.org/bot{$bot_token}/sendMessage?parse_mode=markdown&chat_id={$chat_id}&text=" . urlencode($pesan);

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));
for ($i = 0; $i < $jumlah_requests; $i++) {
    $response = curl_exec($curl);
    $respone = json_decode($response, true);
    if (isset($respone['ok']) && $respone['ok']) {
        echo "[{$hijau}+{$reset}] Success.\n";
    } else {
        echo "[{$merah}-{$reset}] Failed to send.\n";
    }
}
curl_close($curl);
?>
