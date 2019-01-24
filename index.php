<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Hello, world!</title>
</head>
<body>
<!--<h1>Hello, world!</h1>-->
<!--<button type="button" class="btn btn-primary">Primary</button>-->
<br><br>
<div class="container">
    <div class="row">
        <h1>PHP CRUD</h1>
    </div>
    <br>
    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success"> Create</a>
        </p>

        <!--        bare de recherche-->
        <div style="margin-left: 820px; margin-top: -55px">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        
        <!--        tableau des data-->
        <table class="table table-striped table-bordered" style="margin-top: 25px">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>Mobile Number</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM customers ORDER BY id DESC';
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>'. $row['name'] . '</td>';
                echo '<td>'. $row['email'] . '</td>';
                echo '<td>'. $row['mobile'] . '</td>';
                echo '<td width=250> 

                        <a class="btn btn-dark" href="read.php?id='.$row['id'].'">Read</a>
                        <a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>
                        <a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>
                     
                     </td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js" ></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>