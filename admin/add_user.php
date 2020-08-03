<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>
<?php

    // $photo = Photo::find_by_id($_GET['id']);
    // if (isset($_POST['update'])) {
    //     if ($photo) {
    //         $photo->title =  $_POST['title'];
    //         $photo->caption =  $_POST['caption'];
    //         $photo->alternate_text = $_POST['alternate_text'];
    //         $photo->description = $_POST['description'];
    //         $photo->save();
            
    //     }
    // }



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
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="col-md-8">
                        <div class="form-group">
                        <label for="username">Username</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" name="caption" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="caption" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>