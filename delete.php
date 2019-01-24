<?php
    require 'database.php';
    $id = 0;

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customers  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php");

    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Create Data!</title>
</head>
<body>
<!--<h1>Hello, world!</h1>-->
<!--<button type="button" class="btn btn-primary">Primary</button>-->
<br><br>
<div class="container">
    <div class="span10 offset1" style="margin-top: 50px; margin-left: 50px">
        <div class="row">
            <h3>Delete a Customer</h3>
        </div>

        <form class="form-horizontal" action="delete.php" method="post" style="margin-top: 50px;">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-danger" role="alert">Are you sure to delete ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn btn-primary" href="index.php">No</a>
            </div>
        </form>
    </div>
</div> <!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js" ></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>