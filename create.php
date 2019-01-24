
<?php
    // enregistrer les donnes dans la base de donnee
    require  'database.php';

    if ( !empty($_POST)){
        // les erreurs de validation
        $nameError = null;
        $emailError = null;
        $mobileError = null;

        // les valeurs du champ du formulaire
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        // validation des champs
        // validation du champs name
        $valid = true;
        if (empty($name)){
            $nameError = 'Please enter Name';
            $valid = false;
        }

        //validation du champ email vide et respct de la symptaxe email
        if (empty($email)){
            $emailError = 'Please enter Email Address';
            $valid = false;
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        // validation du champs mobile
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }

        // enserssion des valeurs dans la base de donnée
        if ($valid){
            // connexion bd
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (name, email, mobile) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name, $email, $mobile));
            Database::disconnect();
            header("Location: index.php");
        }
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
    <div class="row">
        <h1>Create a Customer</h1>
    </div>
    <br>
    <form class="form-horizontal" action="create.php" method="post">

        <div class="form-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">Name</label>
            <div class="form-group">
                <input class="form-control" name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>" style="width: 500px">
                <?php if (!empty($nameError)): ?>
                    <span class="help-inline"><?php echo $nameError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($emailError)?'error':'';?>">
            <label class="control-label">Email Address</label>
            <div class="form-group">
                <input class="form-control" name="email" type="text"  placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>" style="width: 500px">
                <?php if (!empty($emailError)): ?>
                    <span class="help-inline"><?php echo $emailError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($mobileError)?'error':'';?>">
            <label class="control-label">Mobile Number</label>
            <div class="form-group">
                <input class="form-control" name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>" style="width: 500px">
                <?php if (!empty($mobileError)): ?>
                    <span class="help-inline"><?php echo $mobileError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Create</button>
            <a class="btn btn-dark" href="index.php">Back</a>
        </div>
    </form>
</div> <!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js" ></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>