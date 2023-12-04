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
		<div x-data="{ title: '', content: '' }">
			<form action="item&action=create" method="post">
				<label for="title">Titre</label>
				<input type="text" name="title" x-model="title">
				<label for="titcontentle">Contenu</label>
				<input type="text" name="content" x-model="content">
				<button type="submit" x-bind:disabled="!title || !content">Create</button>
			</form>
		</div>


		<?php
		if ($postCreationError) {
			?>
			<p>Erreur creation de l'item</p>
			<?php
		}
		?>
	</section>

	<section id="items">
		<h2>Item list</h1>
			<ul>
				<?php foreach ($items as $item) { ?>
					<li>

						<a href="<?= 'item&id=' . $item['id']; ?>">
							<?= htmlspecialchars($item['title']); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
	</section>

</div>