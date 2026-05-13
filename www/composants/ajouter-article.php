<!-- encore verifier role pseudo et email de la personne -->
<?php
// si le formulaire est envoyé
echo "Page Ajout d'articles Chargée";

if(isset($_POST["formaddarticle"])) {
    echo 'Nous avons détecté une requête d\'ajout d\'article<br>';
    echo "Nous vous connectons à la base de données ";
    include "../database.php";
    global $db;
    echo "OK<br>";
    echo "Nous allons vérifier votre identité. <br>Préparation d'une requête ";
    $verif = $db->prepare("SELECT pseudo FROM users WHERE (pseudo = :pseudo AND  email = :email AND role = :role)");
    echo "OK<br>";
    echo "Nous exécutons la requête ";
    $verif->execute([
        'pseudo' => $_SESSION["pseudo"],
        'email' => $_SESSION["email"],
        "role" => implode(",", $_SESSION["role"])
    ]);
    echo "OK<br>";
    $result_verif = $verif->rowCount();
    echo "Nous vérifions votre identité ";
    if ($result_verif == 1 && $_SESSION['role'] == "admin") {
        echo "OK<br>";
        extract($_POST);
        echo "Nous préparons l'ajout d'un nouvel article ";
        $q = $db->prepare("INSERT INTO articles(nom,date_publication,image_bg,description,tags,url,videos,auteurs) VALUES(:nom,:date_publication,:image_bg,:description,:tags,:url,:videos,:auteurs)");
        echo "OK<br>";
        echo "Nous exécutons la requête ";
        $q->execute([
            'nom' => $nom,
            'date_publication' => $date_publication,
            'image_bg' => $image_bg,
            'description' => $description,
            'tags' => $tags,
            'url' =>$url,
            'videos' => $videos,
            'auteurs' => $auteurs,

        ]);
        echo "OK<br>";
    }
    else {
        echo "ERROR<br>";
        echo "Il semblerait que vos informations de connexion ne soient pas correctes ou que certains droits vous aient été révoqués. Merci de vous reconnecter.";
    }

}