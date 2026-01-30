<?php
session_start();

// Database connection
$host = 'localhost';
$db_name = 'buzz_app';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection Error: ' . $e->getMessage());
}

// Fetch all buzz posts
$stmt = $pdo->query("SELECT * FROM buzz_posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h1>Buzz</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="ajouter_buzz.php">Ajouter un Buzz</a></li>
                <li><a href="Apropos.php">À propos</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Buzz</h1>
            <p>Restez informé des tendances et de l'actualité du web</p>
            <a href="add_buzz.php" class="btn-primary">Partager un Buzz</a>
        </div>
    </header>

    <main class="container">
        <section class="buzz-section">
            <h2>Les Buzzs Actuels</h2>
            
            <?php if (!empty($posts)): ?>
                <div class="buzz-grid">
                    <?php foreach ($posts as $post): ?>
                        <article class="buzz-card">
                            <div class="buzz-image">
                                <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            </div>
                            <div class="buzz-content">
                                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p class="description"><?php echo htmlspecialchars($post['description']); ?></p>
                                <div class="buzz-footer">
                                    <a href="<?php echo htmlspecialchars($post['source_link']); ?>" target="_blank" class="btn-source">Voir la source</a>
                                    <span class="date"><?php echo date('d/m/Y à H:i', strtotime($post['created_at'])); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Aucun buzz pour le moment. <a href="ajouter_buzz.php">Soyez le premier à en ajouter!</a></p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy;  KFFJ. Tous droits réservés. | <a href="Apropos.php">À propos</a></p>
    </footer>
</body>
</html>