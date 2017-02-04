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
    <?php include 'navbar.php';
        echo $navbarCode;
    ?>

    <style>
        .resize {
            width: 60%;
        }
        .resize-body {
            width: 80%;
        }
    </style>
    <script type="text/javascript">

        $(document).ready(function () {

            $.get('<?php echo $project_url;?>index.php/CommonCtrl/fetchAddedItems',function (data) {
                //console.log(data);
                document.getElementById('cart_table').innerHTML  = data;
            });



            $('#buy').on('click',function () {

                $.post('<?php echo $project_url;?>index.php/CommonCtrl/buyBooks',function (data) {
                    console.log(data);
                    if(data){
                        window.location.href = "<?php echo $project_url;?>index.php/CommonCtrl/buyCompleted";
                    }
                });

            })

        });


    </script>


</head>
<body>
<div class="container block">
    <div class="panel panel-default resize center-block">
        <div class="panel-heading text-center"><h1>Buy<h1></div>
    </div>
</div>
<div class="container">
<div class="row">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Books</div>
        <div class="panel-body">
        </div>
        <div id="cart_table"></div>
    </div>

    <button id="buy" class="btn btn-primary">Buy</button>
</div>
</div>
</body>
</html>