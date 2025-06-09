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
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_element = $_POST['id_element'];
    $type_element = $_POST['type_element'];
    $utilisateur = $_POST['utilisateur'];
    $contenu = $_POST['contenu'];

    if (!in_array($type_element, AVIS_AUTORISE) || empty($id_element)) {
        die("Élément non valide.");
    }

    // Vérifier que l'élément existe dans la table correspondante
    $table_name = AVIS_TABLE[$type_element];
    $id_column_name = AVIS_TABLE_ID[$type_element];
    $sql = "SELECT COUNT(*) FROM $table_name WHERE $id_column_name = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_element);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        die("Erreur : L'élément demandé n'existe pas.");
    }

    // Insérer l'avis
    $sql = "INSERT INTO avis(type_element, id_element, auteur, commentaire) VALUES (:type_element, :id_element, :utilisateur, :avis)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':type_element', $type_element);
    $stmt->bindParam(':id_element', $id_element);
    $stmt->bindParam(':utilisateur', $utilisateur);
    $stmt->bindParam(':avis', $contenu);

    if ($stmt->execute()) {
        header("Location: formulaire.php?type=$type_element&id=$id_element");
        exit;
    } else {
        echo "Erreur lors de l'ajout de l'avis.";
    }
}
?>