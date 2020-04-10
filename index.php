<?php 

require('controller/frontend.php');

try 
{
    if (isset ($_GET['action']))
    {
        $action = htmlspecialchars($_GET['action']);

        if ($action == 'signUp')
        {
            $errorMessage = '';

            if (isset ($_POST['name']) AND isset ($_POST['first_name']) AND isset ($_POST['pseudo']) AND isset ($_POST['email']) AND isset ($_POST['pass']) and isset ($_POST['pass_confirm']))
            {
                $name = htmlspecialchars($_POST['name']);
                $first_name = htmlspecialchars($_POST['first_name']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $pass = htmlspecialchars($_POST['pass']);
                $pass_confirm = htmlspecialchars($_POST['pass_confirm']);

                if (!preg_match("#^[a-z0-9_.-]+@[a-z0-9_.-]{2,}\.[a-z]{2,4}$#", $email))
                {
                    $errorMessage = 'Format d\'adresse email non valide';
                    signUpForm($errorMessage);
                }
                elseif (!preg_match("#^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[0-9])(?=\S*[\W])\S{8,20}$#", $pass))
                {
                    $errorMessage = 'Le mot de passe doit contenir entre 8 et 20 caractères dont 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial';
                    signUpForm($errorMessage);
                }
                elseif ($pass != $pass_confirm)
                {
                    $errorMessage = 'Mots de passe différents';
                    signUpForm($errorMessage);
                }
                else
                {
                    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                    addPlayer($name, $first_name, $pseudo, $email, $hashedPass);
                }              
            }
            else
            {
                signUpForm($errorMessage);
            }
        }
        if ($action == 'connection')
        {
            if (isset($_POST['login']) AND isset($_POST['pass']))
            {
                $login=htmlspecialchars($_POST['login']);
                $pass=htmlspecialchars($_POST['pass']);
                connectionPlayer($login, $pass);
            }
            else
            {
                connectionForm();
            }
        }
    }
    else 
    {
        echo 'Page d\'accueil';
    }
}
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}