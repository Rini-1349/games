<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
</head>
<body>
    <nav>
    <ul>
        <a href="index.php?action=homepage"><li>Accueil</li></a>
        <?php 
        if ($_SESSION)
        {
            $link='index.php?action=sessionDestoy';
            $changeConnection='Se déconnecter';
        }
        else
        {
            $link='index.php?action=connection';
            $changeConnection='Se connecter/S\'inscire';
        }
        ?>
        <a href="<?= $link ?>"><li><?= $changeConnection ?></li></a>
    </ul>
    </nav>
    <?= $content ?>
</body>
</html>