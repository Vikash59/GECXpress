<?php session_start();
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
if(isset($_SESSION["admin_name"]) && isset($_SESSION["admin_pass"]))
{
include './gecdp.php';
if(isset($_REQUEST["btnsave"])){
    $ntype= htmlspecialchars($_REQUEST["txtntype"],ENT_QUOTES);
    //echo $branch;
    $qry_d="INSERT INTO news_type (ntype) VALUES ('".$ntype."')";
    if(mysqli_query($con, $qry_d)){
        ?>
        <script>
            alert("New news type is added successfully!!");
            window.location.href="Edit_news_type.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            var str="<?php echo mysqli_error($con); ?>";  
            var res=str.replace(/'/g,"");
            alert(res);
        </script>
            <?php
    }
}
if(isset($_REQUEST["ntype_id"]) && $_REQUEST["false"]=='false'){
    //echo $_REQUEST["branch_id"];
    $qry_b="DELETE FROM news_type WHERE nid=".$_REQUEST["ntype_id"];
    if(mysqli_query($con, $qry_b))
    {
        ?>
        <script>
            alert("News type is removed successfully!!");
            window.location.href="Edit_news_type.php";
        </script>
        <?php
    }else{
    ?>
        <script>
            var str="<?php echo mysqli_error($con); ?>";  
            var res=str.replace(/'/g,"");
            alert(res);
        </script>
            <?php
    }
}
if(isset($_REQUEST["ntype_id"]) && isset($_REQUEST["trash"]) && isset($_REQUEST["trash"]) == 'yes'){
    $qry_h="UPDATE news_type SET trash='yes' WHERE nid=".$_REQUEST["ntype_id"];
    if(mysqli_query($con, $qry_h)){
        //echo "vikash";
        ?><script>alert('News_type is moved to trash!!');
                    window.location.href="Edit_news_type.php";
        </script><?php
    }
}
?>
<!DOCTYPE html>
<html>
    <head>        
    <title></title>    
        <meta charset="utf-8">
                <link rel="icon" href="images/bulb_logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <script type="text/javascript">
             function confirmDelete(link)
             {
                 if(confirm('Are you sure You want to Delete the News type'))
                 {
                     doAjax(link.href,"POST");
                 }
                 return false;
             }
            </script>
    </head>
    <body>
        <?phpad include './header.php'; ?>
    <div class="wrapper row3 center"  style="">
        <main class="hoc container clear"> 
          <!-- main body -->
          <div class="group center" style="margin-top: 20px;">
              <a href="#" data-toggle="modal" data-target="#myModal" style="color:#000;text-decoration: none;">
                  <article class="two_quarter"><i class="icon fa fa-plus"></i>
                    <h4 class="font-x1 uppercase"><p style="color:#E84C3D;text-decoration:none;font-size:17px;font-family: Georgia,'Times New Roman', 'Times, serif';">Add new news type</p></h4>
                </article>
                  <article class="one_quarter"><i class="icon fa fa-plus"></i>
                    <h4 class="font-x1 uppercase"><p style="color:#E84C3D;text-decoration:none;font-size:17px;font-family: Georgia,'Times New Roman', 'Times, serif';">Add new news type</p></h4>
                </article>
              </a>
          </div>
          <!-- / main body -->
        </main>
    </div>
    
        <div class="container" style="margin-top: 20px;">
        <?php
        if(isset($_REQUEST["trash"]) && isset($_REQUEST["trash"]) == 'yes'){
            $qry="SELECT * FROM news_type WHERE trash='yes' ORDER BY nid";
        }else{
            $qry="SELECT * FROM news_type WHERE trash!='yes' ORDER BY nid";
        }
            $result= mysqli_query($con, $qry);
            while($row= mysqli_fetch_array($result))
            {
                ?>                    
		<div class="alert alert-success alert-dismissable fade in">
                    <a href="Edit_news_type.php?ntype_id=<?php echo $row["nid"] ?> && trash='yes'" class="close" data-dismiss="alert" area-label="close" title="Remove the branch" onClick='return confirmDelete(this);'>&times</a>
			<?php echo $row["ntype"]; ?>
		</div>
                <?php
            }
        ?>
    </div>
        
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add new news type</h4>
                </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="email">New news type:</label>
                        <input type="" class="form-control" id="email" placeholder="Enter new news type" name="txtntype" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Save" name="btnsave" class="btn btn-info"/>
                    </div>
                </form>       
            </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
		 <!-- Modal -->
<?php
include './footer.php';
?>
    </body>
</html>
<?php
}else{
    header("location:Admin_login.php");
}
?>