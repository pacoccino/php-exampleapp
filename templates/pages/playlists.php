<?php
$playlists = $data['playlists'];

$creationError = isset($_GET['action']) && $_GET['action'] === 'create-error';
?>

<div class="home">
	<section id="about">
		<h1>Playlists</h1>
	</section>

	<section id="new-item">
		<h2>New playlist</h2>
		<div x-data="{ title: '' }">
			<form action="song&action=create" method="post">
				<label for="title">Titre</label>
				<input type="text" name="title" x-model="title">
				<button type="submit" x-bind:disabled="!title">Create</button>
			</form>
		</div>


		<?php
		if ($creationError) {
			?>
			<p>Playlist creation error</p>
			<?php
		}
		?>
	</section>

	<section id="playlists">
		<h2>Playlists list</h1>
			<ul>
				<?php foreach ($playlists as $playlist) { ?>
					<li>
						<span>🎶</span>
						<a href="<?= 'playlist&id=' . $playlist['id']; ?>">

							<?= htmlspecialchars($playlist['title']); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
	</section>

</div>