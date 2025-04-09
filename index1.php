<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="id" class="form-label">ID</label>
                <input type="text" name="id" id="id" class="form-control" required>
                <span id="idError"></span>
            </div>
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
                <span id="titleError"></span>
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select">
                    <option value="" hidden>Select your category</option>
                    <option value="nature">Nature</option>
                    <option value="human">Human</option>
                    <option value="animal">Animal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message" class="form-label">Description</label>
                <textarea name="message" id="message"></textarea>
            </div>
            <div class="form-group">
                <label for="image" class="form-label" id="image">Image</label>
                <input type="image" alt="" class="form-control" id="image"><?= $fileInfo ?><br>
            </div>
        </form>
        <button class="btn btn-primary"></button>
    </div>
</body>
</html>