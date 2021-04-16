<?php
$myServer = "40.114.0.213";
$myUser = "unidomPhpUser";
$myPass = "Oymas@2020";
$myDB = "unidomDEV";

$myServer_local = "DESKTOP-F05OIMM\SQLEXPRESS";
$myUser_local = "unidomuser";
$myPass_local = "unidomuser";
$myDB_local = "unidom";

try {
    $PDO_conn = new PDO("sqlsrv:Server=$myServer;Database=$myDB","$myUser","$myPass");
    //$PDO_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     //$PDO_conn_local = new PDO("sqlsrv:Server=$myServer_local;Database=$myDB_local","$myUser_local","$myPass_local");
    //$PDO_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {
    die("Could not connect to the database $myDB :" . $e->getMessage());
    //die("Could not connect to the database $myDB_local :" . $e->getMessage());
}
?>