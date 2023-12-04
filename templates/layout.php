<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Example app</title>
  <link rel="stylesheet" href="app.css">
  <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
  <main x-init="">
    <?php require 'partials/_header.php'; ?>
    <?php require($templatePath); ?>
    <?php require 'partials/_footer.php'; ?>
  </main>
</body>

</html>