<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <form action="">
            <div class="form-group">
                <label for="matricule" class="for-label">Matricule</label>
                <input type="number" name="matricule" id="matricule" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cv" class="form-label">CV</label>
                <input type="file" name="cv" id="cv" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="linkedin" class="form-label">LinkedIn profile</label>
                <input type="text" name="linkedin" id="linkedin" class="form-control" required>
            </div>
        </form>
        <button class="btn btn-sm btn-info">Envoyer</button>
    </div>
</body>
</html>