<?php $title='Connexion'; ?>

<?php ob_start(); ?>
<h1>Connexion</h1>
	<p>Entrez votre identifiant et votre mot de passe pour vous connecter</p>
	<form method="post" action="index.php?action=connection">
		<label for="login">Adresse e-mail ou Pseudo</label>
		<input type="text" name="login" id="login" autofocus required />
		<label for="mdp">Mot de passe</label>
		<input type="password" name="pass" id="pass" required />
		<input type="submit" value="Valider" />
	</form>
	<a href="index.php?action=signUp" >S'inscire</a>
<?php $content=ob_get_clean(); ?>

<?php require('template.php'); ?>