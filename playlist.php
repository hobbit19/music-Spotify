<?php include("includes/includedFiles.php");
	if(isset($_GET['id'])){
		$playlistId = $_GET['id'];
	}else {
		header("Location: index.php");
	}

$playlist = new Playlist($con,$playlistId);
$owner = new User($con,$playlist->getOwner());
?>

<div class="entityInfo">
	
	<div class="leftSection">
		<div class="playlistImage">
			<img src="assets/images/icons/playlist.png">
		</div>
	</div>

	<div class="rightSection">
		<h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getOwner();?></p>
		<p><?php echo $playlist->getNumberOfSongs();?> songs</p>
		<button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELTE PLAYLIST</button>
	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">
		<?php
		$songIdArray = $playlist->getSongIds();
		$i=1;
		foreach($songIdArray as $songId){
			$playlistSongs = new Song($con,$songId);
			$songArtist = $playlistSongs->getArtist();
			echo "<li class='tracklistRow'>
				<div class='trackCount'> 
					<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"". $playlistSongs->getId() ."\",tempPlayList,true)'>
					<span class='trackNumber'>$i<span>
				</div>
				<div class='trackInfo'>
					<span class='trackName'>". $playlistSongs->getTitle() . "</span>
					<span class='artistName'>". $songArtist->getName() . "</span>
				</div>
				<div class='trackOptions'>
					<img class='optionsButton' src='assets/images/icons/more.png' >
				</div>
				<div class='trackDuration'>
					<span class='duration'>". $playlistSongs->getDuration() . "</span>
				</div>
			</li>";
			$i++;
		}
		?>
<script >
	var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
	tempPlayList = JSON.parse(tempSongIds);
</script>
	</ul>
</div>

