<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>
<?php
if (empty($_GET['id'])) {
    redirect("users.php");
    
} else {
    $user = User::find_by_id($_GET['id']);
    if (isset($_POST['update'])) {
        if ($user) {
            $user->username =  $_POST['username'];
            $user->fullname =  $_POST['fullname'];
            $user->password = $_POST['password'];
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();      
              $user->save();
        }
      
    }
    

}



?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php") ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php") ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    User
                    <small>Subheading</small>
                </h1>
                <div class="col-md-6">
                    <img height="100px" width="200px" src="<?php echo $user->image_path_and_placeholder() ?>" alt="">
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <input type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $user->fullname ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" class=" btn-primary btn pull-right">
                        </div>
                            <a href="delete_user.php?id=<?php echo $user->id ?>" class="btn btn-danger">Delete</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>