<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use Carbon\Carbon;

session_start();
Carbon::setLocale('nl');

$pdo = getConnection();

// Alles gebeurt op deze ene pagina: bij een POST-request verwerken we het
// formulier en sturen we daarna door naar onszelf (Post/Redirect/Get).
// Zo kom je bij een fout terug op het formulier, en voorkom je dat een
// refresh de reactie nog een keer verstuurt.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $comment = $_POST['comment'] ?? '';

    $errors = validateComment($name, $email, $comment);

    if (empty($errors)) {
        saveComment($pdo, $name, $email, $comment);
        unset($_SESSION['old'], $_SESSION['errors']);
    } else {
        // Fouten en ingevulde waarden bewaren we tijdelijk in de sessie,
        // zodat het formulier na de redirect weer gevuld en met foutmelding
        // getoond kan worden.
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = ['name' => $name, 'email' => $email, 'comment' => $comment];
    }

    header('Location: index.php');
    exit;
}

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? ['name' => '', 'email' => '', 'comment' => ''];
unset($_SESSION['errors'], $_SESSION['old']);

$comments = getComments($pdo);
?>
<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Challenge: PHP en MySQL</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Video</h1>

        <iframe width="640" height="360" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

        <h2>Plaats een reactie</h2>

        <form method="post" action="index.php" novalidate>
            <div class="field">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name']) ?>">
                <?php if (isset($errors['name'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email']) ?>">
                <?php if (isset($errors['email'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="comment">Reactie</label>
                <textarea id="comment" name="comment" rows="4"><?= htmlspecialchars($old['comment']) ?></textarea>
                <?php if (isset($errors['comment'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['comment']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit">Versturen</button>
        </form>

        <h2>Reacties (<?= count($comments) ?>)</h2>

        <?php if (empty($comments)): ?>
            <p>Nog geen reacties. Wees de eerste!</p>
        <?php else: ?>
            <ul class="comments">
                <?php foreach ($comments as $c): ?>
                    <li>
                        <div class="comment-header">
                            <!-- htmlspecialchars() voorkomt dat opgeslagen HTML/JS wordt uitgevoerd (XSS). -->
                            <strong><?= htmlspecialchars($c['name']) ?></strong>
                            <time datetime="<?= htmlspecialchars($c['created_at']) ?>">
                                <?= Carbon::parse($c['created_at'])->diffForHumans() ?>
                            </time>
                        </div>
                        <p><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>

</html>