<?php session_start();

if(isset($_SESSION["admin_name"]) && isset($_SESSION["admin_pass"]))
{

?>
<?php 
 include '.././gecdp.php';
 if(isset($_REQUEST["btnregister"]))
 {
     $name= htmlspecialchars($_REQUEST["txtuser"],ENT_QUOTES);
     $pass= md5(htmlspecialchars($_REQUEST["txtpass"],ENT_QUOTES));
     $email= htmlspecialchars($_REQUEST["txtemail"],ENT_QUOTES);
     
     $qry="INSERT INTO admin
         (admin_name,admin_pass,admin_email)
         VALUES
         ('".$name."','".$pass."','".$email."');
             ";
     $result=mysqli_query($con,$qry);
     
     if($result)
     {
         ?>
            <script>alert('Admin is registered!!!');
            //window.location.href="Admin_registration.php";
            </script>
            <?php
     }
     else
     {
         ?>

            <script type='text/javascript'>
                var str="<?php echo mysqli_error($con); ?>";  
                var res=str.replace(/'/g,"");

                alert(res);
            </script>
            <?php
     }
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Registration Page</title>        
        <link rel="icon" href="images/bulb_logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body  style="background-color: #474747;">
        
            <br><br>
               <div class="container">
                   
		<div class="panel panel-default" style="background-color:#eee">
		<div class="container"><br>
                    <center style="">
                        <img src="new_admin.jpg" class="img-circle" alt="Responsive image" ></center>
                        <h3 class="text-left" style="text-align: center;  " ><strong>  Admin Registration</strong></h3>
          
		
		<h3> </h3>
		</div><br><br>
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
		
               <div class="form-group">
               <label class="control-label col-sm-3" for="user">Admin id:</label>
               <div class="col-sm-6" >
               <input type="text" class="form-control" id="user" placeholder="Enter admin id" name="txtuser">
               </div>
               </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Admin email:</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" placeholder="Enter admin email id" name="txtemail"/>
                        </div>
                    </div>
               <div class="form-group">
               <label class="control-label col-sm-3" for="pass">Password:</label>
               <div class="col-sm-6">          
                <input type="password" class="form-control" id="pass" placeholder="Enter password" name="txtpass">
                </div>
                </div>
	        <div class="form-group">
	      <button class="btn btn-success center-block btn-lg" type="submit" name="btnregister">Login</button>
		</div>
                  </form>

                    </div>
               </div>
            
                 </body>
                 </html>
<?php
}
else
{
    header("Location:Admin_login.php");
}
?>