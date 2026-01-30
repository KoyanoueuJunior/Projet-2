<<<<<<< HEAD
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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $source_link = trim($_POST['source_link'] ?? '');
    $image = $_FILES['image'] ?? null;

    // Validation
    if (empty($title) || empty($description) || empty($source_link) || !$image) {
        $error = 'Tous les champs sont obligatoires.';
    } elseif (strlen($description) > 250) {
        $error = 'La description ne doit pas dépasser 250 caractères.';
    } elseif (!filter_var($source_link, FILTER_VALIDATE_URL)) {
        $error = 'Le lien doit être une URL valide.';
    } elseif (!in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
        $error = 'Seules les images PNG, JPG, GIF et WebP sont acceptées.';
    } elseif ($image['size'] > 5 * 1024 * 1024) {
        $error = 'L\'image ne doit pas dépasser 5 MB.';
    } else {
        // Create uploads directory if it doesn't exist
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Generate unique filename
        $filename = uniqid('buzz_') . '_' . basename($image['name']);
        $filepath = 'uploads/' . $filename;

        if (move_uploaded_file($image['tmp_name'], $filepath)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO buzz_posts (title, description, source_link, image, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->execute([$title, $description, $source_link, $filename]);
                $success = 'Buzz ajouté avec succès!';
                // Reset form
                $_POST = [];
            } catch (PDOException $e) {
                $error = 'Erreur lors de l\'ajout du buzz: ' . $e->getMessage();
                unlink($filepath);
            }
        } else {
            $error = 'Erreur lors du téléchargement de l\'image.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Buzz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h1>Buzz</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="ajouter_buzz.php" class="active">Ajouter Buzz</a></li>
                <li><a href="Apropos.php">À propos</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section class="form-section">
            <h2>Ajouter un nouveau Buzz</h2>

            <?php if ($error): ?>
                <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="buzz-form">
                <div class="form-group">
                    <label for="title">Titre *</label>
                    <input type="text" id="title" name="title" maxlength="100" required value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" maxlength="250" rows="4" required><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                    <small id="char-count">0/250</small>
                </div>

                <div class="form-group">
                    <label for="source_link">Lien vers la source *</label>
                    <input type="url" id="source_link" name="source_link" required value="<?php echo htmlspecialchars($_POST['source_link'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="image">Image (PNG, JPG, GIF, WebP - Max 5 MB) *</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit" class="btn-primary">Publier le Buzz</button>
                <a href="index.php" class="btn-secondary">Annuler</a>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; KKFJ. Tous droits réservés. | <a href="Apropos.php">À propos</a></p>
    </footer>

    <script>
        // Character counter for description
        const description = document.getElementById('description');
        const charCount = document.getElementById('char-count');

        description.addEventListener('input', function() {
            charCount.textContent = this.value.length + '/250';
        });
    </script>
</body>
</html>
=======
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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $source_link = trim($_POST['source_link'] ?? '');
    $image = $_FILES['image'] ?? null;

    // Validation
    if (empty($title) || empty($description) || empty($source_link) || !$image) {
        $error = 'Tous les champs sont obligatoires.';
    } elseif (strlen($description) > 250) {
        $error = 'La description ne doit pas dépasser 250 caractères.';
    } elseif (!filter_var($source_link, FILTER_VALIDATE_URL)) {
        $error = 'Le lien doit être une URL valide.';
    } elseif (!in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
        $error = 'Seules les images PNG, JPG, GIF et WebP sont acceptées.';
    } elseif ($image['size'] > 5 * 1024 * 1024) {
        $error = 'L\'image ne doit pas dépasser 5 MB.';
    } else {
        // Create uploads directory if it doesn't exist
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Generate unique filename
        $filename = uniqid('buzz_') . '_' . basename($image['name']);
        $filepath = 'uploads/' . $filename;

        if (move_uploaded_file($image['tmp_name'], $filepath)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO buzz_posts (title, description, source_link, image, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->execute([$title, $description, $source_link, $filename]);
                $success = 'Buzz ajouté avec succès!';
                // Reset form
                $_POST = [];
            } catch (PDOException $e) {
                $error = 'Erreur lors de l\'ajout du buzz: ' . $e->getMessage();
                unlink($filepath);
            }
        } else {
            $error = 'Erreur lors du téléchargement de l\'image.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Buzz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h1>Buzz</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="ajouter_buzz.php" class="active">Ajouter Buzz</a></li>
                <li><a href="Apropos.php">À propos</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section class="form-section">
            <h2>Ajouter un nouveau Buzz</h2>

            <?php if ($error): ?>
                <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="buzz-form">
                <div class="form-group">
                    <label for="title">Titre *</label>
                    <input type="text" id="title" name="title" maxlength="100" required value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" maxlength="250" rows="4" required><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                    <small id="char-count">0/250</small>
                </div>

                <div class="form-group">
                    <label for="source_link">Lien vers la source *</label>
                    <input type="url" id="source_link" name="source_link" required value="<?php echo htmlspecialchars($_POST['source_link'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="image">Image (PNG, JPG, GIF, WebP - Max 5 MB) *</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit" class="btn-primary">Publier le Buzz</button>
                <a href="index.php" class="btn-secondary">Annuler</a>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; KKFJ. Tous droits réservés. | <a href="Apropos.php">À propos</a></p>
    </footer>

    <script>
        // Character counter for description
        const description = document.getElementById('description');
        const charCount = document.getElementById('char-count');

        description.addEventListener('input', function() {
            charCount.textContent = this.value.length + '/250';
        });
    </script>
</body>
</html>
>>>>>>> bcb1587184b9d94fbd91bf1c34ae138503ea8b2f
