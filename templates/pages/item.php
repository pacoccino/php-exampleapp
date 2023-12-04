<?php
$item = $data['item'];

$postCreated = isset($_GET['action']) && $_GET['action'] === 'create-post-success';

?>

<div class="home">
	<section id="about">
		<h1>Item</h1>
	</section>
	<section id="item">
		<?php
		if ($postCreated) {
			?>
			<p>Item Créé</p>
			<?php
		}
		?>
		<article>
			<h2>
				<?= htmlspecialchars($item['title']); ?>
			</h2>
			<h2>
				<?= htmlspecialchars($item['content']); ?>
			</h2>
		</article>
	</section>
</div>