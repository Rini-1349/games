<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>

<div class="col-sm-12 col-lg-8">
    <h2>. El cadavro Eskiso .</h2>
    <p> Inscris un verbe
    <br />Inscris un sujet
    <br />Inscris un complément
    <br />Mais ou et donc or ni car 
    <br />C't'enculé
    </p>

    <a href="index.php?action=play" >Jouer</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>