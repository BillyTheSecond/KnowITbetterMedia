<?php 
                        // echo "modif-profil OK";
                        if(isset($_POST["form_modif_profil"])) {
                            // user a cliqué sur le bouton pour modifier ses informations
                            // echo "Le formulaire a été soumis<br>";
                            extract($_POST);
                            // echo "Les données ont été extraites<br>";

                            $requete = "UPDATE `users` SET ";
                            if (isset($prenom) && $prenom != ""){
                                $requete .= " prenom = '". $prenom . "',";
                            }
                            if (isset($nom) && $nom != ""){
                                $requete .= " nom = '". $nom ."',";
                            }
                            if (isset($email) && $email != ""){
                                $requete .= " email = '". $email ."',";
                            }
                            if (isset($ddn) && $ddn != ""){
                                $requete .= " ddn = '". $ddn ."',";
                            }
                            if ($requete[-1] == ",") {
                                $requete = substr($requete,0,-1);
                            }
                            $requete .= " WHERE id= '". $_SESSION['id'] . "'";

                            // echo "La requete a été créée : ". $requete . "<br>";
                            
                            if ($requete != "UPDATE `users` SET ". " WHERE id= '". $_SESSION['id'] . "'") {
                                $q = $db->query($requete);
                                // echo "requete publiée<br>";

                            }


                            
                        }

                    ?>
