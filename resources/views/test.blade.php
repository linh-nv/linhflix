<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
</head>
<body>
    <h2>Create Category</h2>
    <form action="http://linhflix.great-site.net/public/api/category/create" method="GET">
        <p>Are you sure you want to Create this category?</p>
        <input type="text" name="title">
        <input type="text" name="description">
        <input type="text" name="status">
        <input type="text" name="slug">
        <input type="submit" value="Create">
    </form>
    <h2>Update Category</h2>
    <form action="http://linhflix.great-site.net/public/api/category/10" method="PUT">
        <p>Are you sure you want to update this category?</p>
        <input type="text" name="title">
        <input type="text" name="description">
        <input type="text" name="status">
        <input type="submit" value="Update">
    </form>
    <h2>Delete Category</h2>
    <form action="http://linhflix.great-site.net/public/api/category/8" method="DELETE">
        <p>Are you sure you want to delete this category?</p>
        <input type="submit" value="Delete">
    </form>
</body>
</html>
