<!-- Ce fichier a besoin de ces fichiers pour fonctionner : 
    database.php
    loved-articles.php
    enregistrement-articles.php
-->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>

    div.sharing-options{
        display:flex;
        flex-wrap:nowrap;
        text-align:center;
        align-items:center; 
        box-shadow: 1px 1px 10px #00000030; 
        border-radius:50px;
        height: 50px; 
        justify-content: space-around;
        padding:10px;
        margin: 20px 10px

    }
    /* enregistrements */
    .enregistrement-icon {
        color:black;
        padding:6px;
        width:16px;
        height:16px;
        cursor: pointer;
    }
    .enregistrement-icon.enregistre {
        color:orange;
    }

    /* coups de coeur */
    .loved-articles-icon {
        color:black;
        cursor: pointer;
        padding:6px;
        width:16px;
        height:16px;  
        

    }
    .loved-articles-icon.loved {
        color:rgb(255,45,85);
    }

    /* Partage */
    .partager-icon {
        color:black;
        padding:6px;
        width:16px;
        height:16px;  
        cursor: pointer;

    }

    div.sharing-options * {
        box-sizing: unset;
    }

    @media (min-width: 900px) {
        .enregistrement-icon:hover {
        cursor: pointer;
        border-radius: 50%;
        background-color:orange;
        color:white;
        padding:6px;
        text-align:center;
        }
        .loved-articles-icon:hover {
            cursor: pointer;
            border-radius: 50%;
            background-color:rgb(255,45,85);
            color:white;
            padding:6px;
            text-align:center;
        }
        .partager-icon:hover {
        cursor: pointer;
        border-radius: 50%;
        background-color:black;
        color:white;
        padding:6px;
        text-align:center;
    }
    }
</style>


<div class="sharing-options">
<?php 
            global $db;
            include "ajax/gestion_coups_de_coeur.php";
            include "ajax/gestion_enregistrements.php";

                
                if (isset($_SESSION["pseudo"])) {?>
                <p id="aimer-button"><i id="love-icon" class='fa-solid fa-heart text-icon loved-articles-icon <?php if (is_article_loved($article["id"])) {echo "loved";}?>' onclick="change_love_status(<?=$article['id']?>);"></i></p>
                <p id="enregistrer-button"><i id="enregistrement-icon" class='fa-solid fa-bookmark text-icon enregistrement-icon <?php if (is_article_enregistre($article["id"])) {echo "enregistre";}?>' onclick="change_enregistrement_status(<?=$article['id']?>);"></i></p>
                <p id="partager-button" onclick='navigator.share({title: document.title,url: document.location.href,});'><i class='fa-solid fa-arrow-up-from-bracket text-icon partager-icon'></i></p>

            <?php
            
                } else {
                    echo "<a href='https://connexion.knowitbetter.fr?redirect=https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]."' style='margin:10px 20px;'>Connectez-vous pour enregistrer et liker cet article</a><p onclick='navigator.share({title: document.title,url: document.location.href,});'><i class='fa-solid fa-arrow-up-from-bracket text-icon'></i></p>";
                }
        
            ?>
                    <script>
                        $(document).ready(function() {
                            $('#form_change_love_status').submit(function(e) {
                                e.preventDefault(); // empêche le rafraîchissement de la page
                                $.ajax({
                                    url: '../composants/ajax/gestion_coups_de_coeur.php',
                                    type: 'POST',
                                    data: $(this).serialize(),
                                    success: function(data) {
                                        // gère la réponse du serveur ici
                                        // console.log('Réponse du serveur : ' + data);
                                        data = data.split(",");
                                        console.log(data);
                                        if (data[0] == "error") {
                                            // afficher message d'erreur

                                        } else if (data[0] == "success") {
                                            // afficher message de succès

                                            // mettre à jour les informations de pseudo
                                            
                                            if (data[1] == 'suppression') {
                                                // supprimer l'article de la page des coups de coeur
                                                document.getElementById("love-icon").classList.remove("loved");

                                            } else if (data[1] == 'ajout') {
                                                document.getElementById("love-icon").classList.add("loved");
                                                // ne rien faire
                                            }
                                            
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        // gère l'erreur ici
                                        console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                    }
                                });
                            });
                        });


                        function change_love_status(id){
                            document.getElementById("id_article_aime").value = id;
                            $('#form_change_love_status').submit();
                        }
                        // enregistrements
                        $(document).ready(function() {
                            $('#form_change_enregistrement_status').submit(function(e) {
                                e.preventDefault(); // empêche le rafraîchissement de la page
                                $.ajax({
                                    url: '../composants/ajax/gestion_enregistrements.php',
                                    type: 'POST',
                                    data: $(this).serialize(),
                                    success: function(data) {
                                        // gère la réponse du serveur ici
                                        // console.log('Réponse du serveur : ' + data);
                                        data = data.split(",");
                                        console.log(data);
                                        if (data[0] == "error") {
                                            // afficher message d'erreur

                                        } else if (data[0] == "success") {
                                            // afficher message de succès

                                            // mettre à jour les informations de pseudo
                                            
                                            if (data[1] == 'suppression') {
                                                // supprimer l'article de la page des coups de coeur
                                                document.getElementById("enregistrement-icon").classList.remove("enregistre");

                                            } else if (data[1] == 'ajout') {
                                                document.getElementById("enregistrement-icon").classList.add("enregistre");
                                                // ne rien faire
                                            }
                                            
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        // gère l'erreur ici
                                        console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                    }
                                });
                            });
                        });

                        function change_enregistrement_status(id){
                            document.getElementById("input_id_article_enregistre").value = id;
                            $('#form_change_enregistrement_status').submit();
                        }
                    </script>

                    <form name="form_change_love_status" id="form_change_love_status" method="post" style="display:none;">
                        <input type="number" name="id_article_aime" id="id_article_aime" value="">
                        <input type="submit" value="form_change_love_status">
                    </form>
                    <form name="form_change_enregistrement_status" id="form_change_enregistrement_status" method="post" style="display:none;">
                        <input type="number" name="id_article_enregistre" id="input_id_article_enregistre" value="">
                        <input type="submit" value="form_change_enregistrement_status" name="form_change_enregistrement_status">
                    </form>

        </div>

