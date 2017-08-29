# DataHandler
PHP DataHandler Class

Drop-in Class that wraps PHP PDO functionality.

> Usage
```
$oDH = new DataHandler(DB_DSN, DB_USER, DB_PASSWORD);
$oDH->RunCommand($sSQL, array('Param1' => $foo));
while($row = $oDH->fetch()){
    $aOutput[] = $row;
}
```
