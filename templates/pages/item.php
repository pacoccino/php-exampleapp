<?php
$item = $data['item'];
$comments = $data['comments'];

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
			<p>
				<?= htmlspecialchars($item['content']); ?>
				</h2>
		</article>
		<section id="comments">
			<h2>Commentaires</h2>
			<ul>
				<?php foreach ($comments as $comment) { ?>
					<li>
						<?= htmlspecialchars($comment['content']); ?>
					</li>
				<?php } ?>
			</ul>
		</section>
	</section>
</div>