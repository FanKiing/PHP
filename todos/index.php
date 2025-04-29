<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TodoList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">Ma TodoList</a>
    <div class="ms-auto">
        <a href="create.php" class="btn btn-success">New Todo</a>
    </div>
</nav>

<div class="container mt-4">
    <form method="GET" class="mb-3">
        <label for="category" class="form-label">Filtrer par catégorie :</label>
        <select name="category_id" class="form-select" onchange="this.form.submit()">
            <option value="">Toutes</option>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM categories");
            $cats=mysqli_fetch_all($result,MYSQLI_ASSOC); //[dict(cat1),dict(cat2),dict(cat3)]
            foreach ($cats as $cat) {
                $selected = $_GET['category_id'] ==$cat['id'] ? 'selected' : '';
                echo "<option value=".$cat['id']." ".$selected.">".$cat['name']."</option>";
            }
            ?>
        </select>
    </form>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $filter = '';
        if (!empty($_GET['category_id'])) {
            $cat_id = intval($_GET['category_id']);
            $filter = "WHERE todos.category_id = $cat_id";
        }

        $sql = "SELECT todos.*, categories.name AS category 
                FROM todos LEFT JOIN categories ON todos.category_id = categories.id $filter";
        $result = $conn->query($sql);
        $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($todos as $todo)  {
            echo "<tr>
                    <td>{$todo['title']}</td>
                    <td>{$todo['category']}</td>
                    <td>
                        <a href='show.php?id={$todo['id']}' class='btn btn-info btn-sm'>Afficher</a>
                        <a href='edit.php?id={$todo['id']}' class='btn btn-primary btn-sm'>Modifier</a>
                        <a href='delete.php?id={$todo['id']}' class='btn btn-danger btn-sm' 
                           onclick='return confirm(\"Supprimer ce todo ?\")'>Supprimer</a>
                    </td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
