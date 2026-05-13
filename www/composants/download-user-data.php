<?php
// echo "hello";
session_start();
include "../database.php";
include "verif-auth-user.php";
// var_dump($db);
// try {
//     $q = $db->prepare("SELECT pseudo, email, prenom, nom, ddn, date, loved-articles, enregistrements FROM users WHERE email= :email");

// } catch (PDOException $e) {
//     echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
// }


// Vérification de l'identité de l'utilisateur
// echo "fichier chargé";
// echo $_SESSION["pseudo"];
        // if (isset($db)) {echo"aahhhh";}
    if (verif_auth_user() == true) {
        // echo "fonction lancée";
        $query_data =$db->prepare("SELECT pseudo, email, prenom, nom, ddn, `date`, `loved_articles`, `enregistrements` FROM users WHERE id= :id");
        // echo "requete preparee";
        $query_data->execute([
            'id' => $_SESSION["id"],
        ]);
        // echo "requete envoyee";
        $user_data = $query_data->fetch();
        $contenu = "Mes données personnelles - KnowITbetter\n\nPseudo: ".$user_data["pseudo"]."\nemail: ".$user_data["email"]."\nPrénom: ".$user_data["prenom"]."\nNom: ".$user_data["nom"]."\nDate de naissance: ".$user_data["ddn"]."\nDate d'inscription: ".$user_data["date"]."\n\nPréférences\n\nArticles enregistrés: ".$user_data["enregistrements"]."\nArticles likés: ".$user_data["loved_articles"];
        // echo $contenu;
        // echo $user_data["enregistrements"] ;
    }


// Définition du contenu du fichier
$email = "user@service.com";
$pseudo = "user_pseudo";
$nom = "user_nom";
$prenom = "user_prenom";
$ddn = "user_ddn";
$date_inscription = "date";
$articles_aimes = "liste loved articles";
$articles_enregistres = "liste articles enregistres";



// $contenu = "Mes données personnelles - KnowITbetter\nCette fonction n'est pas encore opérationnelle\n";

// Définition du nom du fichier
$nom_fichier = "mes-donnees-knowitbetter.txt";

    // Ouverture du fichier en mode écriture
    $fichier = fopen($nom_fichier, "w");

    // Ecriture du contenu dans le fichier
    fwrite($fichier, $contenu);

    // Fermeture du fichier
    fclose($fichier);

    // Définition des entêtes HTTP pour forcer le téléchargement
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($nom_fichier).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    // header('Content-Length: ' . filesize($fichier));

    // Affichage du contenu du fichier
    readfile($nom_fichier);

    // Suppression du fichier temporaire
    unlink($nom_fichier);
?>
