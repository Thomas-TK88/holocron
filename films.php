<?php
// Connexion à la base de données
if (file_exists('constants_dev.php')) {
  include 'constants_dev.php';
} else {
  include 'constants_prod.php';
}

try {
    $pdo = new PDO(DB_CONN_URL, DB_CONN_USER, DB_CONN_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer la liste des films triés par nom (ou année)
$stmt = $pdo->query("SELECT * FROM films WHERE type = 'film' ORDER BY titre ASC");
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HOLOCRON - Films</title>
  <link rel="stylesheet" href="style.css" />
  <script src="interactions.js"></script>
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
  
  <!-- Zone de recherche -->
  <div class="search-bar">
    <input id="searchInput" type="text" placeholder="Rechercher un film..." />
  </div>

  <!-- Titre de page -->
  <main class="accueil-page">
    <h2>LES FILMS</h2>
    <p>Vous retrouverez ici la liste des films de l’univers STAR WARS.</p>

    <!-- Liste de films -->
    <section class="film-list">
      <?php foreach ($films as $film): ?>
      <div class="card film-card" data-search_Value="<?= htmlspecialchars($film['titre']) ?>">
        <div class="character-image">
            <?php if (!empty($film['image_url'])): ?>
              <img class="vignette" src="<?= htmlspecialchars("images/".$film['image_url']) ?>" alt="<?= htmlspecialchars($film['titre']) ?>">
            <?php else: ?>
              <b><?= htmlspecialchars($film['titre']) ?></b>
            <?php endif; ?>
        </div>
        <div class="film-info">
          <h3><?= htmlspecialchars($film['titre']) ?></h3>
          <ul>
            <li><strong>Année :</strong> <?= htmlspecialchars($film['annee'] ?? 'Inconnue') ?></li>
            <li><strong>Réalisateur :</strong> <?= htmlspecialchars($film['realisateur'] ?? 'Inconnu') ?></li>
            <li><strong>Résumé :</strong> <?= htmlspecialchars(substr($film['description'] ?? '', 0, 150)) ?>...</li>
          </ul>
          <div class="film-buttons">
            <a href="fiche.php?type=film&id=<?= $film['id_film'] ?>" class="cta">Voir le film</a>
            <a href="formulaire.php?type=film&id=<?= $film['id_film'] ?>">Donner son avis</a>           
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </section>
  </main>

  <!-- Navigation secondaire -->
  <div class="page-navigation">
    <a href="index.html
    " class="nav-btn">← Page accueil</a>
    <a href="series.php" class="nav-btn">Page séries →</a>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Holocron - Tous droits réservés</p>
  </footer>

</body>
</html>