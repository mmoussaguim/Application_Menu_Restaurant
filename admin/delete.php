<?php
    require 'database.php';
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php"); 
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link href="../open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    <body>
        <h1 class="text-logo"><i class='fas fa-hamburger'></i> Burger Code <i class='fas fa-hamburger'></i></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-lg">
                    <h1><strong>Supprimer un item</strong></h1>
                    <br>
                    <form class="form" action="delete.php" role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-warning">Oui</button>
                          <a class="btn btn-secondary" href="index.php">Non</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>
