<?php
$song = $data['song'];
$comments = $data['comments'];
$songId = $data['songId'];

$creationSuccess = isset($_GET['action']) && $_GET['action'] === 'create-success';

?>

<div class="home">
	<section id="about">
		<h1>Song</h1>
	</section>
	<section id="item">
		<?php
		if($creationSuccess) {
			?>
			<p>Song created</p>
			<?php
		}
		?>
		<article>
			<h2>
				<?= htmlspecialchars($song->title); ?>
			</h2>
			<blockquote>
				<?= htmlspecialchars($song->content); ?>
			</blockquote>
			<p>
				<?= htmlspecialchars($song->created_at); ?>
			</p>
		</article>
		<section id="comments">

			<h2>Comments</h2>

			<div x-data="{ content: '' }">
				<form action="song&action=comment&id=<?= $songId ?>" method="post">
					<label for="content">Add comment</label>
					<input type="text" name="content" x-model="content">
					<button type="submit" x-bind:disabled="!content">Add</button>
				</form>
			</div>

			<ul>
				<?php foreach($comments as $comment) { ?>
					<li>
						<?= htmlspecialchars($comment->content); ?>
					</li>
				<?php } ?>
			</ul>
		</section>
	</section>
</div>