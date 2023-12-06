<?php
$songs = $data['songs'];

$creationError = isset($_GET['action']) && $_GET['action'] === 'create-error';
?>

<div class="home">
	<section id="about">
		<h1>Songs</h1>
	</section>

	<section id="new-item">
		<h2>New song</h2>
		<div x-data="{ title: '', content: '' }">
			<form action="song&action=create" method="post">
				<label for="title">Titre</label>
				<input type="text" name="title" x-model="title">
				<label for="content">Contenu</label>
				<input type="text" name="content" x-model="content">
				<button type="submit" x-bind:disabled="!title || !content">Create</button>
			</form>
		</div>


		<?php
		if($creationError) {
			?>
			<p>Song creation error</p>
			<?php
		}
		?>
	</section>

	<section id="songs">
		<h2>Song list</h1>
			<ul>
				<?php foreach($songs as $song) { ?>
					<li>
						<span>🎶</span>
						<a href="<?= 'song&id='.$song['id']; ?>">
							<?= htmlspecialchars($song['title']); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
	</section>

</div>