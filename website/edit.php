<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");

$stmt->execute([$id]);

$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Livre introuvable !");
}

// Mettre à jour le livre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ['title' => $title, 'author' => $author, 'year' => $year, 'genre' => $genre] = $data;

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, published_year = ?, genre = ? WHERE id = ?");
    
    $stmt->execute([$title, $author, $year, $genre, $id]);

    header("Location: index.php");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Modifier le Livre</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Auteur</label>
                <input type="text" class="form-control" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Année</label>
                <input type="number" class="form-control" name="year" value="<?= $book['published_year'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" name="genre" value="<?= htmlspecialchars($book['genre']) ?>">
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>