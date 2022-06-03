
<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php 
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
		<title>Admin | Simple Online Quiz System</title>
	</head>

	<body id='login-body' class="bg-light">
		<div class="card col-md-4 offset-md-4 mt-4">
                <img src="image/Y•Form.png" alt="" width="auto" height="auto" style="margin-right:auto; margin-left:auto; display:block;">
                
            <div class="card-body">
                     <form id="login-frm">
                        <div style="font-family: Courier;" class="form-group">
                            <label style="font-family:Trebuchet MS;font-weight:bolder">Username</label>
                            <input type="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label style="font-family:Trebuchet MS;font-weight:bolder">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div> 
                        <div  class="form-group text-right">
                            <button style="font-family: Courier; background-color: darkturquoise; border-color: darkturquoise" class="btn btn-dark btn-block" name="submit">Login</button>
                        </div>
                        
                    </form>
            </div>
        </div>

		</body>

        <script>
            $(document).ready(function(){
                $('#login-frm').submit(function(e){
                    e.preventDefault()
                    $('#login-frm button').attr('disable',true)
                    $('#login-frm button').html('Please wait...')

                    $.ajax({
                        url:'./login_auth.php?type=1',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                            console.log(err)
                            alert('An error occured');
                            $('#login-frm button').removeAttr('disable')
                            $('#login-frm button').html('Login')
                        },
                        success:function(resp){
                            if(resp == 1){
                                location.replace('home.php')
                            }else{
                                alert("Incorrect username or password.")
                                $('#login-frm button').removeAttr('disable')
                                $('#login-frm button').html('Login')
                            }
                        }
                    })

                })
            })
        </script>
</html>