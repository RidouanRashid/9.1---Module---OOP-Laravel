# Challenge: PHP en MySQL

Comments-sectie onder een video. Reacties (naam, e-mail, commentaar) worden
server-side gevalideerd en opgeslagen in een MySQL-tabel; alles gebeurt op
één pagina (`index.php`).

## Installatie (XAMPP)

1. Zet deze map in `htdocs` (staat er al: `challenge-php-mysql`).
2. Importeer de database:
   ```
   mysql -u root < sql/database.sql
   ```
   (of importeer `sql/database.sql` via phpMyAdmin)
3. Installeer de composer-dependencies:
   ```
   composer install
   ```
4. Start Apache en MySQL in XAMPP en open:
   ```
   http://localhost/9.1 - Module - OOP & Laravel/challenge-php-mysql/
   ```

## Gebruikte composer package

- **nesbot/carbon** — voor de "x geleden" tijdsaanduiding bij elke reactie
  (`diffForHumans()`), vergelijkbaar met hoe GitHub dat doet.

## Validatie / beveiliging

- Alle formuliervelden worden server-side gecontroleerd in `functions.php`
  (`validateComment()`), ook al staat er client-side `type="email"` op het
  veld — dat is namelijk te omzeilen.
- Bij een ongeldig e-mailadres (of lege velden) kom je terug op het
  formulier met een foutmelding en je eerder ingevulde waarden (via
  Post/Redirect/Get + sessie).
- Opgeslagen tekst wordt bij het tonen met `htmlspecialchars()` ge-escaped,
  zodat er geen HTML/JS kan worden geïnjecteerd (XSS).
- Database-queries gebruiken PDO prepared statements (voorkomt SQL-injectie).

## Bestanden

- `index.php` — de pagina: video, formulier en reactielijst.
- `functions.php` — validatie + database-functies.
- `config.php` — database-verbinding (PDO).
- `style.css` — basisstyling.
- `sql/database.sql` — database-dump (structuur van de `comments`-tabel).
- `composer.json` / `composer.lock` — composer-dependencies (Carbon).
