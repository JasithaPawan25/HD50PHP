<?php 

class Connection
{
    public static function GetConnection()
    {


        try {
            
            $server="localhost";
            $db="phpproject";
            $user="root";
            $pw="";
            $conn = new PDO("mysql:host=$server;dbname=$db",$user,$pw);
           // $conn =new PDO($server,$user,$pw,$db);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
            var_dump($conn);

        } catch (PDOException $ex) {
            throw $ex;
        }

    }



}





?>