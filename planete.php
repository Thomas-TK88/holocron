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

    // Récupérer les planètes depuis la base de données
    $stmt = $pdo->query("SELECT id_planete, nom, description, image_url FROM planetes ORDER BY nom");
    $planetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion ou de requête : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>HOLOCRON - Planètes</title>
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

  <main class="accueil-page">

    <h2>LES PLANÈTES</h2>
    <p>Vous retrouverez ici les principales planètes de l’univers STAR WARS</p>
  
  <!-- Zone de recherche -->
  <div class="search-bar">
    <!-- Barre de recherche avec un identifiant nommé 'searchInput' -->
    <input id="searchInput" type="text" placeholder="Rechercher une planète..." />
  </div>
  
    <!-- Liste des planètes -->
    <div class="planet-list">
      <?php foreach ($planetes as $planete): ?>
        <!-- cree les div des items avec la classe 'card' et un element data avec les donnée pour la recherche -->
        <div class="card planet-card" data-search_value="<?= htmlspecialchars($planete['nom']) ?>">
          <div class="planet-image">
            <?php if (!empty($planete['image_url'])): ?>
              <!-- cree les items img avec la classe 'flippable' et les elements data avec les données pour le changement d'image -->
              <img class="vignette flippable"  data-flip_img="<?= htmlspecialchars("images/flip/".$planete['image_url']) ?>" data-normal_img="<?= htmlspecialchars("images/normal/".$planete['image_url']) ?>" src="<?= htmlspecialchars("images/normal/".$planete['image_url']) ?>" alt="<?= htmlspecialchars($planete['nom']) ?>" />
            <?php else: ?>
              <b><?= htmlspecialchars($planete['nom']) ?></b>
            <?php endif; ?>
          </div>
          <div class="planet-info">
            <h3><?= htmlspecialchars($planete['nom']) ?></h3>
            <p><?= nl2br(htmlspecialchars($planete['description'])) ?></p>
            <div class="film-buttons">
              <a href="fiche.php?type=planete&id=<?= $planete['id_planete'] ?>" class="cta">Voir la planète</a>
              <a href="formulaire.php?id=<?= $planete['id_planete'] ?>&type=planete" class="review-btn">Donner son avis</a>
            </div>
            </div>
        </div>
      <?php endforeach; ?>
    </div>
  
    <!-- Navigation -->
    <div class="page-navigation">
      <a href="personnages.php" class="nav-btn">← Page persos</a>
    </div>
  </main>
  
  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Holocron - Tous droits réservés</p>
  </footer>

</body>
</html>