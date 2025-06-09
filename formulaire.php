<?php
// Connexion à la base de données
if (file_exists('constants_dev.php')) {
  include 'constants_dev.php';
} else {
  include 'constants_prod.php';
}

require 'constants_bdd_avis.php';

try {
    $pdo = new PDO(DB_CONN_URL, DB_CONN_USER, DB_CONN_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer l'id et le type dans l'URL
$id_element = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$type_element = $_GET['type'] ?? 'film';

// Titre personnalisé
$titre = "Donnez votre avis sur ce " . htmlspecialchars($type_element);

// Récupérer les avis pour cet élément
$query = $pdo->prepare("SELECT * FROM avis WHERE id_element = :id_element AND type_element = :type_element ORDER BY id_avis DESC");
$query->bindParam(':id_element', $id_element);
$query->bindParam(':type_element', $type_element);
$query->execute();
$avis = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HOLOCRON - Avis</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="header-banner">
    <h1>HOLOCRON</h1>
  </header>

  <!-- Navigation -->
  <nav class="main-nav">
    <ul>
      <li><a href="index.html">Accueil</a></li>
      <li><a href="films.php">Films</a></li>
      <li><a href="series.php">Séries</a></li>
      <li><a href="personnages.php">Personnages</a></li>
      <li><a href="planete.php">Planètes</a></li>
    </ul>
  </nav>

  <main>
    <h2><?= $titre ?></h2>

    <form action="ajouter_avis.php" method="POST">
      <input type="hidden" name="id_element" value="<?= $id_element ?>">
      <input type="hidden" name="type_element" value="<?= htmlspecialchars($type_element) ?>">
      
      <div class="form-group">
        <label for="utilisateur">Votre nom :</label>
        <input type="text" name="utilisateur" id="utilisateur" required placeholder="Entrez votre nom" />
      </div>

      <div class="form-group">
        <label for="contenu">Votre avis :</label>
        <textarea name="contenu" id="contenu" required placeholder="Écrivez votre avis..." rows="5"></textarea>
      </div>

      <div class="form-group">
        <button type="submit">Envoyer mon avis</button>
      </div>
    </form>

    <hr>

    <h3>Avis des utilisateurs :</h3>
    <?php if (count($avis) > 0): ?>
      <ul>
        <?php foreach ($avis as $item): ?>
          <li>
            <strong><?= htmlspecialchars($item['auteur']) ?> :</strong>
            <p><?= nl2br(htmlspecialchars($item['commentaire'])) ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>Aucun avis n'a encore été publié.</p>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; 2025 Holocron - Tous droits réservés</p>
  </footer>
</body>
</html>