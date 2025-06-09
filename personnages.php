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

    // Exemple de récupération des personnages depuis la base de données
    $stmt = $pdo->query("SELECT id_personnage, nom, description, image_url, sound_url FROM personnages ORDER BY nom");
    $personnages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion ou de requête : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HOLOCRON - Personnages</title>
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
  

  <main class="accueil-page">
    <h2>LES PERSONNAGES</h2>
    <p>Vous retrouverez ici les principaux personnages de l’univers STAR WARS</p>

  <!-- Zone de recherche -->
  <div class="search-bar">
    <input id="searchInput" type="text" placeholder="Rechercher un personnage..." />
  </div>

  <!-- Liste des personnages -->
    <div class="character-list">
      <?php foreach ($personnages as $perso): ?>
        <div class="card character-card" data-search_value="<?= htmlspecialchars($perso['nom']) ?>">
          <div class="character-image">
            <?php if (!empty($perso['image_url'])): ?>
              <img class="vignette flippable" data-flip_img="<?= htmlspecialchars("images/flip/".$perso['image_url']) ?>" data-normal_img="<?= htmlspecialchars("images/normal/".$perso['image_url']) ?>" src="<?= htmlspecialchars("images/normal/".$perso['image_url']) ?>" alt="<?= htmlspecialchars($perso['nom']) ?>">
            <?php else: ?>
              <b><?= htmlspecialchars($perso['nom']) ?></b>
            <?php endif; ?>
          </div>
          <div class="character-info">
            <h3><?= htmlspecialchars($perso['nom']) ?></h3>
            <p><?= nl2br(htmlspecialchars($perso['description'])) ?></p>
            <div class="film-buttons">
              <a href="fiche.php?id=<?= $perso['id_personnage'] ?>&type=personnage" class="cta">Voir le personnage</a>
              <a href="formulaire.php?id=<?= $perso['id_personnage'] ?>&type=personnage" class="review-btn">Donner un avis</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Navigation -->
    <div class="page-navigation">
      <a href="series.php" class="nav-btn">← Page séries</a>
      <a href="planete.php" class="nav-btn">Page planètes →</a>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Holocron - Tous droits réservés</p>
  </footer>

</body>
</html>