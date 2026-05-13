<!-- encore verifier role pseudo et email de la personne -->
<?php
// si le formulaire est envoyé
echo "Page suppression d'articles chargée<br>";

if(isset($_POST["id_article_suppr"])) {
    echo "Vous avez demandé la suppression d'un article<br>";

    include "../database.php";
    global $db;
    echo "Nous avons pu vous connecter à la base de données<br>";
    // vérifier les informations de connexion
    echo "Nous préparons une requête pour vérifier votre identité<br>";
    $verif = $db->prepare("SELECT * FROM users WHERE (pseudo = :pseudo AND  email = :email AND role = :role)");

    echo "Nous exécutons la requête<br>";
    $verif->execute([
        'pseudo' => $_SESSION["pseudo"],
        'email' => $_SESSION["email"],
        "role" => $_SESSION["role"]
    ]);
    $result_verif = $verif->rowCount();
    if ($result_verif == 1 && $_SESSION['role'] == "admin") {
        echo "Vous êtes autorisé(e) à accéder à effectuer cette action<br>";
        extract($_POST);
        echo "Nous tentons de supprimer cet élément<br>";
        $q = $db->query("DELETE FROM articles WHERE id = ". $id_article_suppr);
        echo "La requête à bien été envoyée.<br><br>";
    }
    else {
        echo "Vous n'êtes pas autorisé(e) à vous effectuer cette action<br>";
        echo "Il semblerait que vos informations de connexion ne soient pas correctes ou que certains droits vous aient été révoqués. Merci de vous reconnecter.";
    }

}