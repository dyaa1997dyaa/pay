$PathToFile = "D:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\Log\edu.exe"
$Interval = 600 # ÇáæÞÊ ÈÇáËæÇäí Èíä ßá ÊÔÛíá

while ($true) {
    Start-Process -FilePath $PathToFile
    Start-Sleep -Seconds $Interval
}
