<?php 
    // echo "fichier chargé";
    // si le formulaire a été envoyé
    if(isset($_POST["form_signin"])) {
        // extraire les valeurs de la requete
        extract($_POST);

        // verifier que tous les champs soient bien remplis (si user modifie le html pour passer outre les attributs required)
        if (!empty($email) && !empty($password) && !empty($verif_password) && !empty($pseudo)) {
            // variable attestant que le formulaire de creatio de compte a bien été envoyé, avec toutes les valeurs renseignees
            $signin_form_sent = true;
            // Vérifier que le service de connexion ne soit pas hors service
            $inscription_status = get_status("inscription");
            if ($inscription_status == 1) {
                $erreur_mdp_signin ="La création de compte a été temporairement désactivée. Nous travaillons le problème. Merci de réessayer ultérieurement :)";

            } else {
                // echo "verification format email";
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreur_email_signin =  "Adresse e-mail non valide";
                } else {
                    // echo "verification de l'unicité du pseudo";
                    $q0 = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
                    $q0->execute([
                        'pseudo' => $pseudo
                    ]);
                    $result_q0 = $q0->rowCount();
                    
                    if ($result_q0 == 0) {
                        // vérifier que les 2 mots de passe soient bien identiques
                        // echo "verification que les mdp sont identiques";
                        if ($password == $verif_password) {
                            // hashage
                            $options = [
                                'cost' => 12,
                            ];

                            $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);


                            // verifier que l'email n'est pas deja utilisé
                            $q1 = $db->prepare("SELECT  email FROM users WHERE email = :email");
                            $q1->execute(['email' => $email]);
                            $result_q1 = $q1->rowCount();
                            // echo $result_q1;
                            if ($result_q1 == 0) {
                                // echo "stage1 OK";
                                // requete pour ajouter un utilisateur
                                $q2 = $db->prepare("INSERT INTO users(pseudo,email,password) VALUES(:pseudo,:email,:password)");
                                // echo "stage2 OK";
                                $q2->execute([
                                    'pseudo' => $pseudo,
                                    'email' => $email, 
                                    'password' => $hashpass
                                ]);
                                header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]);
                                // echo "Le compte a été créé!";                    
                            } 
                            else {
                                // echo "Cette adresse email est déjà utilisée";
                                global $erreur_email_signin ;
                                $erreur_email_signin =  "Cette adresse email est déjà utilisée par un autre compte";

                                // header('Location: https://knowitbetter.fr'.$_SERVER["PHP_SELF"]);

                            }



                        }
                        else {
                            $erreur_mdp_signin =  "Les mots de passe doivent être identiques";

                            // echo "Les mots de passe ne sont pas identiques";
                        }

                    } else {
                        $erreur_pseudo_signin =  "Pseudo déjà utilisé";

                    }
                }

            }
            



        }
        // si les champs ne sont pas remplis
        else {
            echo "Tous les champs ne sont pas remplis";
        }
    }


?>