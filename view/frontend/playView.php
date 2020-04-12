<?php $title = 'Jouer'; ?>

<?php ob_start(); ?>

<form methode="post" action="index.php?action=play&playerId=<?= $playerId ?>&gameId=<?= $gameId ?>&choice=<?= $choice ?>" >
<input typ="text" name="response" />
<input type="submit" value="Valider" />
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>