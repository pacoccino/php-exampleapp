<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="app.css">
  <script src="//unpkg.com/alpinejs" defer></script>

  <title>
    <?php if (isset($seo['title']))
      echo $seo['title'] . ' - '; ?>
    Example App
  </title>
  <?php if (isset($seo['description'])) { ?>
    <meta name="description" content="<?= $seo['description'] ?>">
  <?php } ?>
</head>

<body>
  <main x-init="">
    <?php require 'partials/_header.php'; ?>
    <?php require($templatePath); ?>
    <?php require 'partials/_footer.php'; ?>
  </main>
</body>

</html>