<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Assignment 5</title>
    <?php include 'script_link.php';
    echo "<link rel='stylesheet' href='".$project_url."assets/bootstrap-3.3.7-dist/css/bootstrap.css'>";
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
        $(document).ready(function(){
            $('#register').on('click',function(){
                var username = $('#username').val();
                var password = $('#password').val();
                var repeatPassword = $('#repeatPassword').val();
                var emailAddress = $('#emailAddress').val();
                var phoneNumber = $('#phoneNumber').val();
                var address = $('#address').val();
                $.post('<?php echo $project_url; ?>index.php/CommonCtrl/register',{username:username,password:password,repeatPassword:repeatPassword,emailAddress:emailAddress,phoneNumber:phoneNumber,address:address},function (result) {
                    console.log(result);
                    if(result){
                        window.location = "<?php echo $project_url?>";
                    }
                })
            });
        });
    </script>
</head>
<body>
<div class="container block">
    <div class="panel panel-default resize center-block">
        <div class="panel-heading text-center"><h1>Register Customer <h1></div>
       <!-- <form action="processregister.php" method="post" >-->
            <div class="panel-body center-block resize-body">
                <label for="message"><font color="#e67e22" size="4"></font></label>
                <div class="">
                    <div class="form-group">
                        <label for="username"><font color="#0" size="4">Username</font></label>
                        <br>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Username" minlength="5" required>
                        <br>
                        <label for="password"><font color="#0" size="4">Password</font></label>
                        <br>
                        <input id="password" type="password" class="form-control" name="password"  placeholder="Password" required>
                        <br>
                        <label for="repeatPassword"><font color="#0" size="4">Renter Password</font></label>
                        <br>
                        <input id="repeatPassword" type="password" class="form-control" name="repeatPassword" placeholder="Re-enter password" required>
                        <br>
                        <label for="emailAddress"><font color="#0" size="4">Email Address</font></label>
                        <br>
                        <input id="emailAddress" type="text" class="form-control" name="emailAddress" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required>
                        <br>
                        <label for="phoneNumber"><font color="#0" size="4">Contact No</font></label>
                        <br>
                        <input id="phoneNumber" type="tel" class="form-control" name="phoneNumber" placeholder="+1 000-000-(0000)">
                        <br>
                        <label for="address"><font color="#0" size="4">Address</font></label>
                        <br>
                        <input id="address" type="text" class="form-control" name="address" placeholder="Address">
                       </div>
                </div>
            </div>
            <div  class="panel-footer text-center">
                <input  id="register" class="btn btn-lg btn-primary btn-block" value="Register">
            </div>
<!--        </form>
-->    </div>
</div>

</body>
</html>