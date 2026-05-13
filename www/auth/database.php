<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// echo "DB CHARGé";
// header('Content-type: text/html; charset=UTF-8');

// get data from .env file /docker environment variables
define('HOST', getenv('MARIADB_HOST'));
define('DB_NAME', getenv('MARIADB_DATABASE'));
define('USER', getenv('MARIADB_USER'));
define('PASS', getenv('MARIADB_PASSWORD'));

try {
    // echo 'mysql:host='.HOST.';port=3306;dbname='.DB_NAME,USER.'<br>';
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, USER, PASS);
    $db->exec('SET NAMES utf8');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connect > OK !";
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}

// $q = $db->query('SELECT * FROM articles');
// while ($article = $q->fetch()) {
//     echo '<br>'.$article['nom'];
// }





// fonction importée, copier-coller d'internet
// Convertit une date ou un timestamp en français
function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'nNovembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

/**
 * This function formats the response to pass it correctly to the javaScript function taht isplays the alert message on the screen
 *
 * @param mixed $code The html request code, doesn't do anything.
 * @param string $type The message type, it will be used as a class to display the alert.
 * @param string $message The message content.
 * @param bool $display Set to true by default, if false, no message will be echoed.
 * @return void Just echo the response for it to be read by a ajax request.
 */
function response($code, string $type, string $message, bool $display = true)
{
    if ($display) {
        echo $code . ";" . $type . ";" . $message;
    }
}
