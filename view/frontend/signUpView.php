<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>

<form method="post" action="index.php?action=signUp">
	<label for="name">Nom</label>
	<input type="text" name="name" id="name" autofocus required />
	<br />
	<label for="first_name">Prénom</label>
	<input type="text" name="first_name" id="first_name" required />
	<br />
	<label for="pseudo">Pseudo</label>
	<input type="text" name="pseudo" id="pseudo" required />
	<br />
	<label for="email">Adresse mail</label>
	<input type="text" name="email" id="email" required />
	<br />
	<label for="pass">Mot de passe</label>
	<input type="password" name="pass" id="pass" required />
	<p>Le mot de passe doit contenir entre 8 et 20 caractères dont 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial</p>
	<br />
	<label for="pass_confirm">Confirmation de mot de passe</label>
	<input type="password" name="pass_confirm" id="pass_confirm" required />
	<br />
	<input type="submit" value="Valider" />
</form>
<p><?= $errorMessage ?></p>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>