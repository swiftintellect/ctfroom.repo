<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"  >
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="jquery.min.js"></script>
</head>
<body>
    <div class="container">
         <div class="jumbotron">
             <form method="post" id="login-form" class="login-form">
                <h2>Login Here</h2>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" name="uname" id="uname" placeholder="User Name">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default" id="login_submit" >Login</button>
             </form>
             <div class="result" id="result">
                <h2>Result Page</h2>
                <p id="message"></p>
                <p style="font-size: medium;" id="flag"></p>
                <p style="font-size: small;" id="token"></p>
             </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function(){
    $("#result").hide();
    $('#login_submit').click(function()
    {
        var formData = JSON.stringify($("#login-form").serializeArray());
        $.ajax({
            type: "POST",
                url: "login.php",
                dataType: "json",
                data: '{"username": "' + $('#uname').val() + '", "password" : "' + $('#password').val() + '"}',
                contentType: 'application/json',
                cache:false,
                success : function(result) {
                        console.log(result);
                    $("#login-form").hide();
                    $("#result").show();
                    if(result.status === "success" ){
                        $('#message').html(result.message);
                        $('#message').addClass('alert alert-success');
                        $('#flag').html("flag: ccke{"+result.flag+"}");
                        $('#flag').addClass('alert alert-success');
                        $('#token').html(result.token);
                        $('#token').addClass('alert alert-info');
                    } else {
                        $('#message').html(result.message);
                        $('#message').addClass('alert alert-danger');
                    }

                }
        });
        return false; 
    });
});
</script>
</html>
































































































































                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                <p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                #Todo
                                                                                                                                                                                                                                                                                                                                                                                                                                                - delete the login.php.bak file :-)
                                                                                                                                                                                                                                                                                                                                                                                                                                                - fix the PHP juggler blah blah vuln the security guys mentioned :-(
                                                                                                                                                                                                                                                                                                                                                                                                                                                - deploy on heroku for UATs
                                                                                                                                                                                                                                                                                                                                                                                                                                                - deploy on ECS :-(
                                                                                                                                                                                                                                                                                                                                                                                                                                                </p>
                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>--->


