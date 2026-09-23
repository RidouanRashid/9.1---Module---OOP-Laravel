<?php
require_once __DIR__ . '/config.php';

/**
 * Valideert de ingevulde formuliergegevens server-side.
 * Client-side validatie (type="email") is makkelijk te omzeilen, dus we
 * controleren hier nog een keer alles wat binnenkomt.
 * Geeft een array met foutmeldingen terug; leeg = alles is geldig.
 */
function validateComment(string $name, string $email, string $comment): array
{
    $errors = [];

    if (trim($name) === '') {
        $errors['name'] = 'Vul een naam in.';
    } elseif (mb_strlen($name) > 100) {
        $errors['name'] = 'De naam mag maximaal 100 tekens lang zijn.';
    }

    // filter_var met FILTER_VALIDATE_EMAIL controleert of het een geldig e-mailadres is.
    if (trim($email) === '') {
        $errors['email'] = 'Vul een e-mailadres in.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Vul een geldig e-mailadres in.';
    } elseif (mb_strlen($email) > 150) {
        $errors['email'] = 'Het e-mailadres mag maximaal 150 tekens lang zijn.';
    }

    if (trim($comment) === '') {
        $errors['comment'] = 'Vul een reactie in.';
    }

    return $errors;
}

/**
 * Slaat een reactie op in de database via een prepared statement.
 * Prepared statements voorkomen SQL-injectie omdat de waarden nooit
 * als losse SQL-tekst in de query terechtkomen.
 */
function saveComment(PDO $pdo, string $name, string $email, string $comment): void
{
    $stmt = $pdo->prepare(
        'INSERT INTO comments (name, email, comment, created_at) VALUES (:name, :email, :comment, NOW())'
    );

    $stmt->execute([
        ':name' => trim($name),
        ':email' => trim($email),
        ':comment' => trim($comment),
    ]);
}

/**
 * Haalt alle reacties op, nieuwste eerst.
 */
function getComments(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT id, name, email, comment, created_at FROM comments ORDER BY created_at DESC');

    return $stmt->fetchAll();
}
