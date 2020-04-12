<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>

<h1>Bienvenue</h1>
<a href="index.php?action=play" >Jouer</a>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>