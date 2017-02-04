<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Including the script at the end to lazy load-->
    <meta charset="UTF-8">
    <title>Assignment 5</title>
    <?php include 'script_link.php';
    echo "<link rel='stylesheet' href='".$project_url."assets/bootstrap-3.3.7-dist/css/bootstrap.css'>";
    ?>

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

            $('#register').on('click',function(){
                window.location.href = "<?php echo $project_url; ?>index.php/CommonCtrl/registerNavigate";
            });

            $('#submit').on('click',function(){

                var username = $('#username').val();
                var password = $('#password').val();
                $.post('<?php echo $project_url; ?>index.php/CommonCtrl/validateLogin',{username:username,password:password},function (result) {
                    console.log(result);
                    if(result){
                        window.location = "<?php echo $project_url?>index.php/CommonCtrl/page2";
                    }

                })

            });




        });

    </script>
</head>
<body>


<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Sign in to continue</strong>
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
              <!--  <form action="<?php /*echo site_url().'/CommonModel/login';*/?>" method="post">-->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input type="text" id="username" class="form-control" name=username placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input type="password" id="password" class="form-control" name=password  placeholder="Password"  required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                </div>
                <div class="form-group">
                    <input id="register" class="btn btn-lg btn-primary btn-block" value="New User Register Here">
                </div>
                <!--</form>-->
            </div>
        </div>
    </fieldset>
</div></div><div class="panel-footer ">
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>