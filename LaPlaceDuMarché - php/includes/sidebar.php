<div class="sidebar">
<h4>Derniers Articles</h4>
<head>
    <link rel="stylesheet" href="style/stylesidebar.css">
</head>
<?php

    $select = $bdd->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,3");
    $select->execute();

    while($s=$select->fetch(PDO::FETCH_OBJ)){

        ?>

        <h8><?php echo $s->title; ?></h8><br/>
        <h8><?php echo $s->description; ?></h8><br/>
        <h8><?php echo $s->price; ?> €</h8><br/>
        <br/><br/>
        <?php
    }    

?>




</div>