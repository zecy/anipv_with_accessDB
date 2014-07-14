<?php
/* creat ADO connent */

try {

    $database = "D:\dropbox\Personal Anime Database\padb_be.accdb";
    $db       = new PDO("Driver={Microsoft Access Driver (*.mdb, *.accdb)}; Dbq = $database; Uid=Admin");

    $sql = "SELECT 动画基本信息.原名 FROM 动画基本信息";

    foreach ($db -> query($sql) as $row);
    {
        print $row['原名'] . '<br />';
    }

    $db = null;

}

catch(PDOException $e)
    {
        echo $e->getMessage();
    }

?>