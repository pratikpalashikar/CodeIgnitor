<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Including the script at the end to lazy load-->
    <?php include 'script_link.php';
        echo "<link rel='stylesheet' href='".$project_url."assets/bootstrap-3.3.7-dist/css/bootstrap.css'>";
    ?>
    <meta charset="UTF-8">
    <title>Assignment 5</title>

    <style>
        .panel-heading {
            padding: 5px 15px;
        }

        .panel-footer {
            padding: 1px 15px;
            color: #A0A0A0;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
    </style>
    <script type="text/javascript">

        $(document).ready(function(){


            $.get('<?php echo $project_url;?>index.php/CommonCtrl/logout',function (data) {
                console.log(data);
            });


            $('#login').on('click',function(){
                window.location.href = "<?php echo $project_url;?>";
            });
        });

    </script>
</head>
<body>
<!--this is the content for the nav bar-->
<!--Include the navbar on every page-->


<!--this is the content for middle section of the page-->
<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Logout </strong>
                </div>
                <div class="panel-body">
                    <div>
                        <fieldset>
                            <div class="row">
                                <div class="center-block">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">

                                    <h2 align="center">Successfully Logged out</h2>
                                    <h3 align="center">Click here to login</h3>
                                    <div class="form-group">
                                        <input id="login" class="btn btn-lg btn-primary btn-block" value="Login">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="panel-footer ">
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>