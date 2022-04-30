<?php 
require("connetdb.php");

class gallery
{
    private $GID;
    private $Gcode;
    private $SGN;
    private $image;
    private $description;

    public function __construct($_gcode,$_sgn,$_image,$_description)
    {
        $this->Gcode=$_gcode;
         $this->SGN=$_sgn;
         $this->image=$_image;
         $this->description=$_description;      
    }


    public function SetGcode($_gcode)
    {
        $this->Gcode=$_gcode;

    }

    public function Getcode()
    {
        return $this->Gcode;
    }



    public function SetGID($_gid)
    {
        $this->GID=$_gid;

    }

    public function GetGID()
    {
        return $this->GID;
    }



    public function SetSGN($_sgn)
    {
        $this->SGN=$_sgn;
    }

    public function GetSGN()
    {
        return $this->SGN;
    }


    public function SetImage($_image)
    {
        $this->image=$_image;
    }

    public function GetImgae()
    {
        return $this->image;
    }
    

    public function SetDescription($_description)
    {
        $this->description=$_description;
    }

    public function GetDescription()
    {
        return $this->description;
    }


    //DB Methods
    public function Add()
    {

        try {
            
            $conn= Connection::GetConnection();
            $query="INSERT INTO `gallery`(`Gcode`,`Gyear`, `GImage`, `Gdescripton`)
                     VALUES (:Gcode,:SGN,:yimage,:Descrip)";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(":Gcode",$this->Gcode,PDO::PARAM_INT);
            $stmt->bindParam(":SGN",$this->SGN,PDO::PARAM_INT);
            $stmt->bindParam(":yimage",$this->image,PDO::PARAM_STR);
            $stmt->bindParam(":Descrip",$this->description,PDO::PARAM_STR);
            $stmt->execute();


        } catch (PDOException $th) {
            throw $th;
        }


    }

    public static function GetGallery()
    {

        try {
            
            $conn=Connection::GetConnection();
            $query="SELECT `GID`,`Gcode`, `Gyear`, `Gimage`, `Gdescripton` FROM `gallery`";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result= $stmt->fetchAll();

            $Gallerys = array();
            foreach($result as $value)
            {
              $Gallery = new Gallery($value['Gcode'],$value['Gyear'],$value['Gimage'],$value['Gdescripton']) ;
              $Gallery->SetGID($value['GID']);
              array_push($Gallerys,$Gallery);
           
            }
            return $Gallerys;



        } catch (PDOException $th) {
            throw $th;
        }

    }

    public  function Update()
    {

        try {
            $conn =Connection::GetConnection();
            $query="UPDATE `gallery` SET `Gcode`=:Gcode, `Gyear`=:SGN,`GImage`=:yimage,`Gdescripton`=:Descrip
                     WHERE `GID`=:GID";


            $stmt=$conn->prepare($query);
            $stmt->bindParam(":GID",$this->GID,PDO::PARAM_INT);
            $stmt->bindParam(":Gcode",$this->Gcode,PDO::PARAM_INT);
            $stmt->bindParam(":SGN",$this->SGN,PDO::PARAM_INT);
            $stmt->bindParam(":yimage",$this->image,PDO::PARAM_STR);
            $stmt->bindParam(":Descrip",$this->description,PDO::PARAM_STR);
            $stmt->execute();
            


        } catch (PDOException $th) {
            throw $th;
        }

    }

    public static function Delete($gid)
    {

        try {
            $conn =Connection::GetConnection();
            $query="DELETE from `gallery` WHERE `GID`=:GID";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":GID",$gid,PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }




    public static function DeleteMessage($coid)
    {

        try {
            $conn =Connection::GetConnection();
            $query="DELETE from `contactinfo` WHERE `CoID`=:coID";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":coID",$coid,PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }



}







?>