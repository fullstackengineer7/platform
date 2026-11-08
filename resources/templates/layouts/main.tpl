<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$title|default:"Blog Platform"}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Blog Platform</a>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        {block name="content"}{/block}
    </main>

    <footer class="bg-dark text-white-50 text-center py-3">
        &copy; 2026 Blog Platform
    </footer>
</body>
</html>
