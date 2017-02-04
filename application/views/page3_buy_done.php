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
        .resize {
            width: 60%;
        }
        .resize-body {
            width: 80%;
        }
    </style>
    <?php include 'navbar.php';
    echo $navbarCode;
    ?>

</head>
<body>


<div class="container block">
    <div class="panel panel-default resize center-block">
        <div class="panel-heading text-center"><h1>Buy<h1></div>

        <h1 align="center">Thank you for shopping</h1>


    </div>
</div>

</body>
</html>