<?php $title = 'Jouer'; ?>

<?php ob_start(); ?>

<form method="post" action="index.php?action=play&playerId=<?= $playerId ?>&gameId=<?= $gameId ?>&choice=<?= $choice ?>" >
<label for="response">Entrez un <?= $choice ?></label>
<input typ="text" name="response" id="response" required/>
<input type="submit" value="Valider" />
<?php echo 'Joueur : ' . $playerId . '/ jeu : ' . $gameId . '/ choix : ' . $choice; ?>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>