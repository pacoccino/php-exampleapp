<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Example app</title>
  <link rel="stylesheet" href="app.css">
</head>

<body>
  <main>
    <?php require 'partials/_header.php'; ?>
    <?php require($templatePath); ?>
    <?php require 'partials/_footer.php'; ?>
    <script src="app.js"></script>
  </main>
</body>

</html>