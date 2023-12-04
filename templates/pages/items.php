<?php
$items = $data['items'];

$postCreationError = isset($_GET['action']) && $_GET['action'] === 'create-post-error';

?>

<div class="home">
	<section id="about">
		<h1>Items</h1>
	</section>

	<section id="new-item">
		<h2>New Item</h2>
		<form action="item&action=create" method="post">
			<label for="title">Titre</label>
			<input type="text" name="title">
			<label for="titcontentle">Contenu</label>
			<input type="text" name="content">
			<button type="submit">Create</button>
		</form>

		<?php
		if ($postCreationError) {
			?>
			<p>Erreur creation de l'item</p>
			<?php
		}
		?>
	</section>

	<section id="items">
		<?php foreach ($items as $item) { ?>
			<article>
				<h2>
					<?= htmlspecialchars($item['title']); ?>
				</h2>
				<a href="<?= 'item&id=' . $item['id']; ?>">Lire l'article</a>
			</article>
		<?php } ?>
	</section>

</div>