
<?php 
require("connetdb.php");

class News
{
    private $NID;
    private $NCode;
    private $Ntitle;
    private $Ndate;
    private $Ncover;
    private $Ndescription;

    //PHP construtor
    public function __construct($_ncode,$_ntitle,$_ndate,$_ncover,$_ndescription)
    {
        $this->NCode=$_ncode;
        $this->Ntitle=$_ntitle;
        $this->Ndate=$_ndate;
        $this->Ncover=$_ncover;
        $this->Ndescription=$_ndescription;
    }


    public function SetNID($_nid)
    {
        $this->NID=$_nid;

    }

    public function GetNID()
    {
        return $this->NID;
    }



    public function SetNCode($_ncode)
    {
        $this->NCode = $_ncode;
    }

    public function SetNTitle($_ntitle)
    {
        $this->Ntitle = $_ntitle;
    }

    public function SetYear($_ndate)
    {
        $this->Ndate = $_ndate;
    }


    public function SetCover($_ncover)
    {
        $this->Ncover = $_ncover;
    }

    public function SetDescription($_ndescription)
    {
        $this->Ndescription = $_ndescription;
    }

    public function GetNcode()
    {
        return $this->NCode;
    }

    public function GetNTitle()
    {
        return $this->Ntitle;
    }

    

    public function GetNdate()
    {
        return $this->Ndate;
    }

    public function GetNCover()
    {
        return $this->Ncover;
    }

    public function GetNDescription()
    {
        return $this->Ndescription;
    }



    //DB Methods
    public function Add()
    {
        try {
            $conn =Connection::GetConnection();
            $query="INSERT INTO `news_manager`(`Ncode`, `Ntitle`, `Ndate`,
             `Ncover`, `Ndescription`)
                VALUES (:Ncode,:Ntitle,:Ndate,:Ncover,:Ndescription)";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":Ncode",$this->NCode,PDO::PARAM_STR);
            $stmt->bindParam(":Ntitle",$this->Ntitle,PDO::PARAM_STR);
            $stmt->bindParam(":Ndate",$this->Ndate,PDO::PARAM_STR);
            $stmt->bindParam(":Ncover",$this->Ncover,PDO::PARAM_STR);
            $stmt->bindParam(":Ndescription",$this->Ndescription,PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }


    public static function GetNews()
    {
        try {
            
            $conn =Connection::GetConnection();
            $query="SELECT  `NID`, `Ncode`, `Ntitle`, `Ndate`, `Ncover`, 
             `Ndescription` FROM `news_manager`";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result = $stmt-> fetchAll();

            $Newss = array();
            foreach($result as $value){

                $News = new News($value['Ncode'],$value['Ntitle'],$value['Ndate'],$value['Ncover'],
                                $value['Ndescription']);

                $News->SetNID($value['NID']);
                array_push($Newss,$News);
                //($_isbn,$_title,$_year,$_price,$_cover,$_description)

            }   
            return $Newss;    




        } catch (PDOException $th) {
            throw $th;
        }


    }


    public function Update()
    {
        try {
            $conn =Connection::GetConnection();
            $query="UPDATE `news_manager` SET `Ncode`=:Ncode,`Ntitle`=:Ntitle,
                                     `Ndate`=:Ndate,`Ncover`=:Ncover,
                                     `Ndescription`=:Ndescription
                                      WHERE `NID`=:NID";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":NID",$this->NID,PDO::PARAM_INT);
            $stmt->bindParam(":Ncode",$this->NCode,PDO::PARAM_STR);
            $stmt->bindParam(":Ntitle",$this->Ntitle,PDO::PARAM_STR);
            $stmt->bindParam(":Ndate",$this->Ndate,PDO::PARAM_STR);
            $stmt->bindParam(":Ncover",$this->Ncover,PDO::PARAM_STR);
            $stmt->bindParam(":Ndescription",$this->Ndescription,PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }



    public static function Delete($nid)
    {
        try {
            $conn =Connection::GetConnection();
            $query="DELETE from `news_manager` WHERE `NID`=:NID";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":NID",$nid,PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }


    public static function GetHomeNews()
    {

        try {
            $conn =Connection::GetConnection();
            $query="SELECT `NID`,`Ncode`,`Ntitle`, `Ndate`, `Ncover`, `Ndescription` FROM `news_manager` ORDER BY Ndescription DESC LIMIT 10  "; // substring(`Ndescription`,1,2) AS ExtractString" ; /*DESC LIMIT 2";ORDER BY NID DESC LIMIT 2--  Where Title like 'harry' */
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result = $stmt-> fetchAll();
            $newss = array();
            foreach($result as $value){

            $news = new News($value['Ncode'],$value['Ntitle'],$value['Ndate'],
                        $value['Ncover'], $value['Ndescription']);

            $news->SetNID($value['NID']);
            array_push($newss,$news);
                //($_isbn,$_title,$_year,$_price,$_cover,$_description)

            }   
            return $newss;    


        } catch (PDOException $th) {
            throw $th;
        }



    }





    public static function GetBookDes($BID)
    {

        try {
            $conn =Connection::GetConnection();
            $query="SELECT `BID`, `ISBN`, `Title`, `Year`,
                    `Price`, `Image`, `Description` FROM `book_manger` WHERE BID =$BID";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result = $stmt-> fetchAll();
            $Books = array();
            foreach($result as $value){

                $Book = new Book($value['ISBN'],$value['Title'],$value['Year'],$value['Price'],
                                $value['Image'],$value['Description']);

                $Book->SetBID($value['BID']);
                array_push($Books,$Book);
                //($_isbn,$_title,$_year,$_price,$_cover,$_description)

            }   
            return $Books;    


        } catch (PDOException $th) {
            throw $th;
        }



    }



    public static function GetNewsDes($POID)
    {
        try {
            
            $conn =Connection::GetConnection();
            $query="SELECT  `NID`, `Ncode`, `Ntitle`, `Ndate`, `Ncover`, 
             `Ndescription` FROM `news_manager` Where NID = $POID ";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result = $stmt-> fetchAll();

            $Newss = array();
            foreach($result as $value){

                $News = new News($value['Ncode'],$value['Ntitle'],$value['Ndate'],$value['Ncover'],
                                $value['Ndescription']);

                $News->SetNID($value['NID']);
                array_push($Newss,$News);
                //($_isbn,$_title,$_year,$_price,$_cover,$_description)

            }   
            return $Newss;    




        } catch (PDOException $th) {
            throw $th;
        }


    }


}



?>