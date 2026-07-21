<?php
function getDatabaseConnection(){
    $serverName='localhost';
    $userName='root';
    $password='';
    $dbname='storedb';
    $connection= new mysqli($serverName,$userName,$password,$dbname);
    if($connection->connect_error){
        die("ERROR Failed to connect to Mysql ".$connection->connect_error);
    }
    return $connection;
}
?>