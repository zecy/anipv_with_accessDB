<?php
/* creat ADO connent */

//phpinfo();

try {

$conn = odbc_connect('animedb','','');

//    $database = "D:\\dropbox\\Personal Anime Database\\padb_be.accdb";
//$db       = new PDO("Driver={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ = $database; Uid=Admin");

$sql = "SELECT ����������Ϣ.ԭ�� as name, ����������Ϣ.��� as shrotname, ����������Ϣ.anime_id as id, ����������Ϣ.���� as genre, ����������Ϣ.ʱ�� as oa FROM ����������Ϣ WHERE ((����������Ϣ.ʱ��) >= #2014/6/1# and (����������Ϣ.ʱ��) <= #2014/8/1#)";

$rs = odbc_exec($conn, $sql);

while (odbc_fetch_row($rs)) {
    $name       = odbc_result($rs, "name");
    $shortname  = odbc_result($rs, "shrotname");
    $id         = odbc_result($rs, "id");
    $genre      = odbc_result($rs, "genre");
    $oa         = odbc_result($rs, "oa");

    echo $oa . "��" . $name . "��" . $genre . "<br/>";
}
odbc_close($conn);

$db = null;

}

catch(PDOException $e)
{
    echo $e->getMessage();
}

?>