<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link href="./open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">


        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Holtwood+One+SC" />
        <link rel="stylesheet" href="css/style.css">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="js/script.js"></script>
        
    </head>
    <body>
        
        <div class="container site">
            <h1 class="text-logo"><i class='fas fa-hamburger'></i> Burger Code <i class='fas fa-hamburger'></i></h1>
            
            <?php
                require 'admin/database.php';
                echo '<nav class="navbar navbar-light navbar-expand-md">
                        <ul class="nav nav-pills" >';
                $db = Database::connect();
                $statement = $db->query('SELECT * FROM categories');
                $categories = $statement->fetchAll();
                foreach ($categories as $category) 
                {
                    if($category['id'] == '1')
                        echo '<li role="presentation" class="nav-item"><a class="nav-link active" data-toggle="tab" href="#' . $category['id'] . '">' . $category['name'] . '</a></li>';
                    else
                        echo '<li role="presentation" class="nav-item"><a class="nav-link" data-toggle="tab" href="#' . $category['id'] . '">' . $category['name'] . '</a></li>';
                }

                echo    '</ul>
                      </nav>';

                echo '<div class="tab-content">';

                foreach ($categories as $category) 
                {
                    if($category['id'] == '1')
                        echo '<div class="tab-pane active" id="' . $category['id'] .'">';
                    else
                        echo '<div class="tab-pane" id="' . $category['id'] .'">';
                    
                    echo '<div class="row">';
                    
                    $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                    $statement->execute(array($category['id']));
                    while ($item = $statement->fetch()) 
                    {
                        echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="images/' . $item['image'] . '" alt="..." class="img-thumbnail">
                                    <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['name'] . '</h4>
                                        <p>' . $item['description'] . '</p>
                                        <a href="#" class="btn btn-order" role="button"><span class="oi oi-cart"></span> Commander</a>
                                    </div>
                                </div>
                            </div>';
                    }
                   
                   echo    '</div>
                        </div>';
                }
                Database::disconnect();
                echo  '</div>';                 
            ?>
        
        </div>
        
        
        
        
    </body>
</html>