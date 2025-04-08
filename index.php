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
        <form action="" id="imageForm" method="POST" novalidate>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" name="id" id="id" class="form-control" required>
                <div id="idError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
                <div id="titleError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="" hidden>Select your category</option>
                    <option value="nature">Nature</option>
                    <option value="human">Human</option>
                    <option value="animal">Animal</option>
                </select>
                <div id="categoryError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Description</label>
                <textarea name="message" id="message" class="form-control"></textarea>
                <div id="messageError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label" id="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <div id="imageError" class="invalid-feedback"></div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>