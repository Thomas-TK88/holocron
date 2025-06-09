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
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des paramètres GET
$type = $_GET['type'] ?? '';
$id = intval($_GET['id'] ?? 0);

if (!in_array($type, AVIS_AUTORISE) || $id <= 0) {
    echo "Fiche introuvable.";
    exit;
}

// Préparation sécurisée de la requête selon le type
switch ($type) {
    case 'film':
    case 'serie': // film et série font partie de la même table : films
        $stmt = $pdo->prepare("SELECT * FROM films WHERE id_film = ? AND type = ?");
        $stmt->execute([$id, $type]);
        break;
    case 'personnage':
        $stmt = $pdo->prepare("SELECT * FROM personnages WHERE id_personnage = ?");
        $stmt->execute([$id]);
        break;
    case 'planete':
        $stmt = $pdo->prepare("SELECT * FROM planetes WHERE id_planete = ?");
        $stmt->execute([$id]);
        break;
    default:
        echo "Fiche introuvable.";
        exit;
}

$fiche = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fiche) {
    echo "Fiche introuvable.";
    exit;
}

// Récupérer les avis liés à cette fiche
$stmtAvis = $pdo->prepare("SELECT * FROM avis WHERE type_element = ? AND id_element = ? ORDER BY date_avis DESC");
$stmtAvis->execute([$type, $id]);
$avisList = $stmtAvis->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HOLOCRON - Fiche <?= htmlspecialchars($fiche['nom']) ?></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Header -->
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

  <main class="fiche-container">
    <h2><?= htmlspecialchars($fiche[BDD_TABLE_NOM[$type]]) ?></h2>

    <div class="fiche-content">
      <div class="fiche-image">
        <?php if (!empty($fiche['image_url'])): ?>
          <img class="vignette" src="<?= htmlspecialchars("images/normal/".$fiche['image_url']) ?>" alt="Image de <?= htmlspecialchars($fiche[BDD_TABLE_NOM[$type]]) ?>" />
        <?php else: ?>
          <p>[Pas d'image disponible]</p>
        <?php endif; ?>
      </div>

      <div class="fiche-description">
        <p><?= nl2br(htmlspecialchars($fiche['description'])) ?></p>

        <?php if ($type === 'film' || $type === 'serie'): ?>
          <p><strong>Année :</strong> <?= htmlspecialchars($fiche['annee'] ?? 'Inconnue') ?></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Bouton pour donner un avis -->
    <div class="fiche-options">
      <a href="formulaire.php?type=<?= urlencode($type) ?>&id=<?= urlencode($id) ?>" class="review-btn">Donner un avis</a>
    </div>

    <!-- Liste des avis -->
    <section class="avis-section">
      <h3>Avis des utilisateurs (<?= count($avisList) ?>)</h3>
      <?php if (count($avisList) === 0): ?>
        <p>Aucun avis pour le moment. Soyez le premier à donner le vôtre !</p>
      <?php else: ?>
        <ul>
          <?php foreach ($avisList as $avis): ?>
            <li>
              <strong><?= htmlspecialchars($avis['auteur']) ?></strong> - <em><?= htmlspecialchars($avis['date_avis']) ?></em>
              <p><?= nl2br(htmlspecialchars($avis['commentaire'])) ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Holocron - Tous droits réservés</p>
  </footer>

</body>
</html>