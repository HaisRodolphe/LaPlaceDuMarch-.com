<?php

    require_once('includes/header.php');

    $select = $bdd->prepare("SELECT * FROM products1");
    $select->execute();

    while($s=$select->fetch(PDO::FETCH_OBJ)){
    
        ?>

        <h2><?php echo $s->title; ?></h2>
        <h5><?php echo $s->description; ?></h5>
        <h4><?php echo $s->price; ?> €</h4>
        <br/><br/>
        <?php
    }    


    require_once('includes/footer.php');

?>