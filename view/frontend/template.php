<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="public/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="public/css/style.css" />
    <title><?= $title ?></title>
</head>
<body>
    <div class="container">
    <header>
        <div class="row">
            <a class="col-xs-12 col-sm-8" href="index.php?action=homepage">
                <h1>Larinouille</h1> 
                <p id="sparkling">Games &amp; Sparkling
                <br /><span class="sous_titre">Since 1988</span></p>
            </a>
            <nav class="col-xs-12 col-sm-4" id="nav">
                <ul>
                    <?php 
                    if ($_SESSION)
                    {
                        $link='index.php?action=sessionDestoy';
                        $changeConnection='Se déconnecter';
                    }
                    else
                    {
                        $link='index.php?action=connection';
                        $changeConnection='Se connecter/S\'inscrire';
                    }
                    ?>
                    <a href="<?= $link ?>"><li><?= $changeConnection ?></li></a>
                </ul>
            </nav>
        </div>
    </header>
    </div>
    <div class="row">
    <?= $content ?>
    </div>
</body>
</html>