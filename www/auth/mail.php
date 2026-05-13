<?php
function report_an_error($objet, $contenu)
{

    $headers = "From: ERROR REPORT <error_reports@knowitbetter.fr>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Optionnel : ajouter un en-tête pour la vérification de l'authenticité du message
    // $headers .= "DKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed; d=knowitbetter.fr; s=mail; h=From:Subject:Date:Message-ID:Content-Type:MIME-Version; bh=xxxx; b=xxxx;\r\n";

    $mail_sent = mail("administrateur@knowitbetter.fr", $objet, $contenu, $headers);

    if ($mail_sent) {
        // echo "Le message a été envoyé avec succès à ". $to;
        return true;
    } else {
        // echo "Une erreur s'est produite lors de l'envoi du message.";
        return false;
    }
}





function email_user($to, $objet, $contenu,$nom_email) {
    
    $headers = "From: KnowITbetter ". $nom_email ."<noreply@knowitbetter.fr>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Optionnel : ajouter un en-tête pour la vérification de l'authenticité du message
    // $headers .= "DKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed; d=knowitbetter.fr; s=mail; h=From:Subject:Date:Message-ID:Content-Type:MIME-Version; bh=xxxx; b=xxxx;\r\n";

    $mail_sent = mail($to, $objet, $contenu, $headers);

    if ($mail_sent) {
        // echo "Le message a été envoyé avec succès à ". $to;
        return true;
    } else {
        // echo "Une erreur s'est produite lors de l'envoi du message.";
        return false;
    }
}