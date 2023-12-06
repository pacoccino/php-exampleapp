<?php
$item = $data['song'];
$comments = $data['comments'];

$creationSuccess = isset($_GET['action']) && $_GET['action'] === 'create-success';

?>

<div class="home">
	<section id="about">
		<h1>Song</h1>
	</section>
	<section id="item">
		<?php
		if ($creationSuccess) {
			?>
			<p>Song created</p>
			<?php
		}
		?>
		<article>
			<h2>
				<?= htmlspecialchars($item['title']); ?>
			</h2>
			<blockquote>
				<?= htmlspecialchars($item['content']); ?>
			</blockquote>
			<p>
				<?= htmlspecialchars($item['created_at']); ?>
			</p>
		</article>
		<section id="comments">
			<h2>Comments</h2>
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