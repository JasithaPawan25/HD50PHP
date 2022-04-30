<?php 
require_once("connetdb.php");

class Book
{
    private $BID;
    private $ISBN;
    private $title;
    private $year;
    private $price;
    private $cover;
    private $description;

    //PHP construtor
    public function __construct($_isbn,$_title,$_year,$_price,$_cover,$_description)
    {
        $this->ISBN=$_isbn;
        $this->title=$_title;
        $this->year=$_year;
        $this->price=$_price;
        $this->cover=$_cover;
        $this->description=$_description;
    }


    public function SetBID($_bid)
    {
        $this->BID=$_bid;

    }

    public function GetBID()
    {
        return $this->BID;
    }



    public function SetISBN($_isbn)
    {
        $this->ISBN = $_isbn;
    }

    public function SetTitle($_title)
    {
        $this->title = $_title;
    }

    public function SetYear($_year)
    {
        $this->year = $_year;
    }

    public function SetPrice($_price)
    {
        $this->price = $_price;
    }

    public function SetCover($_cover)
    {
        $this->cover = $_cover;
    }

    public function SetDescription($_description)
    {
        $this->description = $_description;
    }

    public function GetISBN()
    {
        return $this->ISBN;
    }

    public function GetTitle()
    {
        return $this->title;
    }

    public function GetPrice()
    {
        return $this->price;
    }

    public function GetYear()
    {
        return $this->year;
    }

    public function GetCover()
    {
        return $this->cover;
    }

    public function GetDescription()
    {
        return $this->description;
    }



    //DB Methods
    public function Add()
    {
        try {
            $conn =Connection::GetConnection();
            $query="INSERT INTO `book_manger`( `ISBN`, `Title`, `Year`, 
                    `Price`, `Image`, `Description`) 
                    VALUES (:ISBN,:Title,:Byear,:price,:cover,:descrip)";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":ISBN",$this->ISBN,PDO::PARAM_STR);
            $stmt->bindParam(":Title",$this->title,PDO::PARAM_STR);
            $stmt->bindParam(":Byear",$this->year,PDO::PARAM_INT);
            $stmt->bindParam(":price",$this->price,PDO::PARAM_INT);
            $stmt->bindParam(":cover",$this->cover,PDO::PARAM_STR);
            $stmt->bindParam(":descrip",$this->description,PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }


    public static function GetBooks()
    {
        try {
            
            $conn =Connection::GetConnection();
            $query="SELECT  `BID`, `ISBN`, `Title`, `Year`, `Price`, 
            `Image`, `Description` FROM `book_manger`";
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


    public function Update()
    {
        try {
            $conn =Connection::GetConnection();
            $query="UPDATE `book_manger` SET `ISBN`=:ISBN,`Title`=:Title,
                                     `Year`=:Byear,`Price`=:price,`Image`=:iimage,
                                     `Description`=:descrip
                                      WHERE `BID`=:BID";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":BID",$this->BID,PDO::PARAM_INT);
            $stmt->bindParam(":ISBN",$this->ISBN,PDO::PARAM_STR);
            $stmt->bindParam(":Title",$this->title,PDO::PARAM_STR);
            $stmt->bindParam(":Byear",$this->year,PDO::PARAM_INT);
            $stmt->bindParam(":price",$this->price,PDO::PARAM_INT);
            $stmt->bindParam(":iimage",$this->cover,PDO::PARAM_STR);
            $stmt->bindParam(":descrip",$this->description,PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }



    public static function Delete($bid)
    {
        try {
            $conn =Connection::GetConnection();
            $query="DELETE from `book_manger` WHERE `BID`=:BID";

            $stmt=$conn->prepare($query);
            $stmt->bindParam(":BID",$bid,PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $th) {
            throw $th;
        }

    }


    public static function GetHomeBook()
    {

        try {
            $conn =Connection::GetConnection();
            $query="SELECT `BID`, `ISBN`, `Title`, `Year`,
                    `Price`, `Image`, `Description` FROM `book_manger` ORDER BY BID DESC LIMIT 2" ; /* Where Title like 'harry'" ;    DESC LIMIT 2";*/
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


}



?>