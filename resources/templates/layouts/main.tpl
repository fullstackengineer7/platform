<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|default:"Blog Platform"}</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
        </nav>
    </header>

    <main>
        {block name="content"}{/block}
    </main>

    <footer>
        <p>&copy; 2026 Blog Platform</p>
    </footer>
</body>
</html>
