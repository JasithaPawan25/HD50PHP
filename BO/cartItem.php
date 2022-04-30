<?php
class CartItem
{
    public $BookName;
    public $Qty;
    public $BID;
    public $Price;

    /*

    public static function IAdd()
    {
        try {
            $conn =Connection::GetConnection();
            $query= "INSERT INTO `user_orders`(`OID`, `Item_name`, `Price`, `Quntity`)
            VALUES (:o_id,:i_name,:price,:qty)";
           // $query="INSERT INTO `book`( `ISBN`, `Title`, `Year`, 
             //       `Price`, `Cover`, `Description`) 
               //     VALUES (:ISBN,:Title,:Byear,:price,:cover,:descrip)";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":o_id",$OID,PDO::PARAM_INT);
            $stmt->bindParam(":i_name",$Item_name,PDO::PARAM_STR);
            $stmt->bindParam(":price",$Price,PDO::PARAM_INT);
            $stmt->bindParam(":qty",$Quntity,PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }*/


}


?>