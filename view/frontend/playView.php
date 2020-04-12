<?php $title = 'Jouer'; ?>

<?php ob_start(); ?>

<div class="col-xs-12">
<h2>A vous de jouer</h2>
<form method="post" action="index.php?action=play&playerId=<?= $playerId ?>&gameId=<?= $gameId ?>&choice=<?= $choice ?>" >
<label for="response">Entrez un <?= $choice ?></label>
<input typ="text" name="response" id="response" required/>
<input type="submit" value="Valider" />
</form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>