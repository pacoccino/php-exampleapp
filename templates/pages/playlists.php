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
			<form action="playlist&action=create" method="post">
				<label for="title">Titre</label>
				<input type="text" name="title" x-model="title">
				<button type="submit" x-bind:disabled="!title">Create</button>
			</form>
		</div>


		<?php
		if($creationError) {
			?>
			<p>Playlist creation error</p>
			<?php
		}
		?>
	</section>

	<?php

	$itemName = 'Playlist';
	$itemPage = 'playlist';

	$items = array_map(fn($playlist) => [
		'id' => $playlist->id,
		'title' => $playlist->title
	], $playlists);

	require dirname(__DIR__, 1).'/partials/_itemList.php';
	?>

</div>