<?php

/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/3/2016
 * Time: 12:19 AM
 */
class CommonModel extends CI_Model
{

    public function login(){

      
        $username = $_POST['username'];
        $password = $_POST['password'];


        if(isset($username) && isset($password)){
            // if the username and the password is set
            $sql = "SELECT username,password from customers where username='$username';";
            $result = $this->db->query($sql);



            foreach($result->result() as $row){
                if($username==$row->username && md5($password)==$row->password){
                    $shoppingbasket = $this->db->query("select basketId from shoppingbasket where username ='$username'");
                    $row = $shoppingbasket->result();
                    $basketId = $row[0]->basketId;
                    $_SESSION['basketId'] = $basketId;
                    $_SESSION['username'] = $username;
                    return true;
                }else{
                   return false;
                }
            }
        }

    }


    public function  get_cart_items(){
        $cartCount = 0;
        $basketId = $_SESSION['basketId'];
        $sql2 = "select SUM(number) as total from contains where basketId='$basketId'";
        $result2 = $this->db->query($sql2);
        $row = $result2->result();
        $cartCount = $row[0]->total;
        if($cartCount=='' || $cartCount==null){
            $cartCount=0;
        }
        return $cartCount;
    }

    public function processAddToCart(){

        //book name and ISBN
        $ISBN = $_POST['ISBN'];
        $quantity  = $_POST['Quantity'];
        $basketId = $_SESSION['basketId'];
        $sql = "insert into contains values ('$ISBN','$basketId',$quantity)";
        $this->db->query($sql);
        $sql2 = "select SUM(number) as total from contains where basketId='$basketId'";
        $result2 = $this->db->query($sql2);
        $row = $result2->result();
        return $row[0]->total;
    }


    public function getBooksByAuthor(){

        $buildTable = '';
        if(isset($_POST['author']) && $_POST['author']!=null){

            $author = filter_input(INPUT_POST,'author',FILTER_SANITIZE_SPECIAL_CHARS);

            if($_POST['author']!=null && $_POST['author']!='') {


                $buildTable = "<table class=\"table\">
                <tr><th>Book Name</th><th>ISBN</th><th># of Books</th><th>Qty</th><th>Cart</th></tr>";

                $sql = "select * from book where ISBN in (select ISBN from writtenby where SSN in
            (select SSN from author where name LIKE '%$author%'))";

                $result = $this->db->query($sql);

                foreach ($result->result() as $row) {

                    $name = $row->title;
                    $ISBN = $row->ISBN;

                    $noofbooks = $this->db->query("select number from stocks where ISBN ='$ISBN'");
                    $count = 0;
                    foreach($noofbooks->result() as $row) {
                        $count += $row->number;
                    }

                    if ($count > 1) {
                        $buildTable.= "<tr><td>$name</td><td>$ISBN</td><td>$count</td><td><input id='$ISBN' type='number' max='10' min='1'></td>
        <td><button id='cart' value='Add To Cart' class='btn btn-danger' onclick=\"addToCart('$name','$count','$ISBN')\">Add To Cart</button></td>
        </tr>";
                    }

                }
            }
            $buildTable .= "</table></div>";

        }

        return $buildTable;

    }

    public  function getBooksByTitle(){

        $buildTable = '';
        if(isset($_POST['title'])) {


            $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_SPECIAL_CHARS);


            if($_POST['title']!=null && $_POST['title']!='') {

                $buildTable = "<table class=\"table\">
                <tr><th>Book Name</th><th>ISBN</th><th># of Books</th><th>Qty</th><th>Cart</th></tr>";

                $sql = "select * from book where title LIKE '%$title%'";

                $result = $this->db->query($sql);



                foreach ($result->result() as $row) {

                    $name = $row->title;
                    $ISBN = $row->ISBN;

                    $noofbooks = $this->db->query("select number from stocks where ISBN ='$ISBN'");
                    $count = 0;
                    foreach ($noofbooks->result() as $row) {
                        $count += $row->number;
                    }

                    if ($count > 1) {
                        $buildTable.="<tr><td>$name</td><td>$ISBN</td><td>$count</td><td><input id='$ISBN' type='number' max='10' min='1'></td>
        <td><button id='cart' value='AddToCart' class='btn btn-danger' onclick=\"addToCart('$name', '$count', '$ISBN')\"'>Add To Cart</button></td>
        </tr>";
                    }
                }

                $buildTable.="</table></table></div>";
            }
        }

        return $buildTable;
    }



    public function buyBooks(){


        $basketId = $_SESSION['basketId'];

        $sqlouter = "select book.title as title, contains.ISBN as ISBN, SUM(contains.number) as total, SUM(contains.number) * book.price as price 
from contains LEFT JOIN book ON contains.ISBN = book.ISBN where contains.basketId = '$basketId' group by contains.ISBN;";

        $result = $this->db->query($sqlouter);

        foreach($result->result() as $row ){

            $isbn = $row->ISBN;
            $required = $row->total;
            $sql = "SELECT * FROM cheapbooks.stocks where ISBN='$isbn'";
            $result2 = $this->db->query($sql);
            foreach($result2->result() as $row2){
                $actual = $row2->number;
                $warehousecode = $row2->warehouseCode;
                $username = $_SESSION['username'];
                if( ($required-$actual)>0 && $actual!=0){

                    if($required>$actual){
                        $value = $actual;
                    }else{
                        $value = $required;
                    }

                    $sql3 = "insert into shippingorder VALUES ('$isbn','$warehousecode','$username','$value')";
                    $res = $this->db->query($sql3);
                    $sql4 = "update stocks set number=0 where isbn='$isbn' and warehouseCode=$warehousecode";
                    $this->db->query($sql4);
                    $required = $required-$actual;
                }else if($required!=0 && ($actual-$required)>=0){
                    $actual = $actual-$required;
                    $sql3 = "insert into shippingorder VALUES ('$isbn','$warehousecode','$username','$required')";
                    $res = $this->db->query($sql3);
                    $sql4 = "update stocks set number=$actual where isbn='$isbn' and warehouseCode=$warehousecode";
                    $this->db->query($sql4);
                    $required = 0;
                }
            }
        }
        $sqldelete = "delete  from contains where basketId='$basketId'";
        $this->db->query($sqldelete);

        return true;
    }



    public function register(){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $emailAddress = $_POST['emailAddress'];
        $phoneNumber = $_POST['phoneNumber'];
        $home_address = $_POST['address'];

        if(isset($username) && isset($password) && isset($repeatPassword) && isset($emailAddress) && isset($phoneNumber)){

            $password = md5($password);
            $sql = "insert into customers values ('$username','$password','$home_address','$phoneNumber','$emailAddress');";
            if($this->db->simple_query($sql)){

                $basketid = uniqid();
                $shoppingbasket = $this->db->simple_query("insert into shoppingbasket values ('$basketid', '$username')");
                return true;
            }else{
                return false;
            }

        }
    }


    public function fetchAddedItems(){

        $buildTable = '';
        $basketId = $_SESSION['basketId'];

        $sql = "select book.title, contains.ISBN, SUM(contains.number) as total, SUM(contains.number) * book.price as price 
from contains LEFT JOIN book ON contains.ISBN = book.ISBN where contains.basketId = '$basketId' group by contains.ISBN;";


        $result = $this->db->query($sql);
        $totalPrice = 0;
        $buildTable="<table class=\"table\">
                <tr><th>Title</th><th>ISBN</th><th># Total Books</th><th>Price</th></tr>";
        foreach($result->result() as $row){

            $buildTable.="<tr><td>".$row->title."</td><td>".$row->ISBN."</td><td>".$row->total."</td><td>".number_format($row->price,'2','.','')."</td>
        </tr>";
            $totalPrice+= $row->price;
        }
        $buildTable.="<tr><td>".'Total Price'."</td><td>".''."</td><td>".''."</td><td>".number_format($totalPrice,'2','.','')."</td>
        </tr>";
        echo "</table></div>";

        return $buildTable;

    }

    public function logout(){
        $this->session->sess_destroy();
        echo true;
    }
}