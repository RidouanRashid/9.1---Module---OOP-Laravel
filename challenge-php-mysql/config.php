<?php
// Database-configuratie. Standaard XAMPP-instellingen (gebruiker "root", geen wachtwoord).
define('DB_HOST', 'localhost');
define('DB_NAME', 'challenge_php_mysql');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Maakt en geeft een PDO-connectie terug.
 * PDO met prepared statements voorkomt SQL-injectie.
 */
function getConnection(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    return new PDO($dsn, DB_USER, DB_PASS, $options);
}
