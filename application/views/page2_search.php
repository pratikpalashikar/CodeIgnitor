<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Assignment 5</title>
    <?php include 'script_link.php';
    echo "<link rel='stylesheet' href='".$project_url."assets/bootstrap-3.3.7-dist/css/bootstrap.css'>";

    if(!isset($_SESSION['username'])){
        header('Location:'.$project_url);
    }

    ?>
    <style>
        .searchBackground {
            padding: 10px 13px;
            margin-bottom: 14px;
            background-color: #e8e8ee;
            border: 1px solid #c4c4d2;
            border-radius: 6px;
        }
    </style>


    <script type="text/javascript">

            $(document).ready(function() {

                $.get('<?php echo $project_url;?>index.php/CommonCtrl/fetch_cart_items',function (data) {
                   console.log(data);
                    document.getElementById('result').innerHTML  = "Cart Items :"+ data;
               });


                //Search the text books
                $('#searchByAuthor').on('click',function() {
                        var authorName = $('#title').val();
                    $.post('<?php echo $project_url;?>index.php/CommonCtrl/getBooksByAuthor',{author:authorName},function (data) {
                        //console.log(data);
                        document.getElementById('books-table').innerHTML  = data;
                    });
                    });

                $('#searchByTitle').on('click',function () {
                    var titleName = $('#title').val();
                    $.post('<?php echo $project_url;?>index.php/CommonCtrl/getBooksByTitle',{title:titleName},function (data) {
                        console.log(data);
                        document.getElementById('books-table').innerHTML  = data;
                    });
                });

                $('#filterButton').on('click',function () {
                    window.location.href = "<?php echo $project_url;?>index.php/CommonCtrl/page3";
                });

            });

            /**
             * Created by Pratik on 11/25/2016.
             */
            var addToCart = function(name,count,isbn) {
                //get the quantity
                var qty = document.getElementById(isbn).value;
                if (parseInt(count) >= parseInt(qty) && parseInt(qty) > 0) {
                    $.post('<?php echo $project_url;?>index.php/CommonCtrl/processAddToCart', {
                        bookname: name,
                        ISBN: isbn,
                        Quantity: qty
                    }, function (data) {
                        console.log("fetched cart data"+data);
                        document.getElementById('result').innerHTML = "Cart Items :" + data;
                    });
                }
            }
    </script>

</head>
<body>
<?php include 'navbar.php';
    echo $navbarCode;
?>
<div class="container">
    <div class="row">
        <div class="searchBackground">
            <input type="text" id="title" class="form-control"/>
            <br>

            <div class='btn btn-info' id='result'>Cart Items : </div><br>

            <br>
            <button id="searchByAuthor" class="btn btn-primary">Search By Author</button>
            <button id="searchByTitle" class="btn btn-primary">Search By Title</button>
            <button id="filterButton" class="btn btn-primary">ShoppingBasket</button>
            <!--fetch the data form the database and display the result here-->
        </div>
    </div>
    <br>
    <h1>Book Result</h1>

    <hr>
    <!--show the result here-->
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Books</div>
        <div class="panel-body">
        </div>
        <div id="books-table"></div>
     </div>

</body>
</html>