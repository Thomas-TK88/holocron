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
$stmt = $pdo->query("SELECT * FROM films WHERE type = 'serie' ORDER BY titre ASC");
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HOLOCRON - Séries</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Charge et execute le fichier javascript pour les interactions -->
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
    <input id="searchInput" type="text" placeholder="Rechercher une série..." />
  </div>

  <!-- Titre de page -->
  <main class="accueil-page">
    <h2>LES SÉRIES</h2>
    <p>Vous retrouverez ici la liste des séries de l’univers STAR WARS.</p>

    <!-- Liste de séries -->
    <section class="film-list">
      <?php foreach ($films as $serie): ?>
        <div class="card film-card" data-search_value="<?= htmlspecialchars($serie['titre']) ?>">
        <div class="character-image">
            <?php if (!empty($serie['image_url'])): ?>
              <img class="vignette" src="<?= htmlspecialchars("images/normal/".$serie['image_url']) ?>" alt="<?= htmlspecialchars($serie['titre']) ?>">
            <?php else: ?>
              <b><?= htmlspecialchars($serie['titre']) ?></b>
            <?php endif; ?>
        </div>
          <div class="film-info">
            <h3><?= htmlspecialchars($serie['titre']) ?></h3>
            <ul>
              <li><strong>Année :</strong> <?= htmlspecialchars($serie['annee_de_sortie']) ?></li>
              <li><strong>Résumé :</strong> <?= htmlspecialchars($serie['resume']) ?></li>
            </ul>
            <div class="film-buttons">
              <a href="fiche.php?id=<?= $serie['id_film'] ?>&type=serie" class="cta">Voir la série</a>
              <a href="formulaire.php?id=<?= $serie['id_film'] ?>&type=serie">Donner son Avis</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>;
    </section>
  </main>

  <!-- Navigation -->
  <div class="page-navigation">
    <a href="films.php" class="nav-btn">← Page films</a>
    <a href="personnages.php" class="nav-btn">Page personnages →</a>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Holocron - Tous droits réservés</p>
  </footer>

</body>
</html>