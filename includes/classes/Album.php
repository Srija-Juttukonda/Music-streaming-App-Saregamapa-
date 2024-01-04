User
<style>/* Style for the "Post Comment" button */
#submitComment {
    color: black; /* Change the color of the button text */
    background-color: #ffffff; /* Change the background color of the button */
    /* Add any additional styles like padding, border, etc., as needed */
}

/* Style for the input field */
#commentText {
    color: black; /* Change the color of the text in the input field */
    /* Add any additional styles for the input field */
}
</style>
<?php include("includes/includedFiles.php");


if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $artist->getName(); ?></p>
		<p><?php echo $album->getNumberOfSongs(); ?> songs</p>

	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">
		
		<?php
		$songIdArray = $album->getSongIds();

		$i = 1;
		foreach($songIdArray as $songId) {

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>

						<input type='hidden' class='songId' value='". $albumSong->getId() . "'>

						<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>
        </div>

        <?php


$comments = []; 
$query = "SELECT * FROM comments WHERE album_id = '$albumId'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Push comments into the $comments array
        $comments[] = $row;
    }
    }
    ?>

<div class="commentsSection">
    <h3>Comments</h3>
    <?php
    if (!empty($comments)) {
        foreach ($comments as $comment) {
            ?>
            <div class='comment'>
                <p><?php echo $comment['comment_text']; ?></p>
            </div>
            <?php
        }
    }
    ?>
</div>
<!-- JavaScript for AJAX -->
<div class="addCommentSection">
    <h3>Add a Comment</h3>
    <form id="commentForm" >
        <textarea id="commentText" name="commentText" placeholder="Write your comment here" required></textarea>
        <input type="hidden" id="albumId" value="<?php echo $albumId; ?>">
        <input id="submitComment" type="submit" value="Post Comment" >
    </form>
</div>

<div class="commentsSection">
    <!-- Comments will be displayed here -->
</div>


		<script>
			
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';		
			tempPlaylist = JSON.parse(tempSongIds);
			console.log(tempPlaylist);
		</script>

<script>
document.getElementById('commentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Fetch form values
    var commentText = document.getElementById('commentText').value;
    var albumId = document.getElementById('albumId').value;

    // Construct the HTML for the new comment
    var newCommentHTML = "<div class='comment'>" +
    // Replace 'User' with the actual username or fetch it if needed
        "<p>" + commentText + "</p>" +
        "</div>";

    // Add the new comment HTML to the comments section
    var commentsSection = document.querySelector('.commentsSection');
    commentsSection.innerHTML += newCommentHTML;

    // Clear the comment textarea after submission
    document.getElementById('commentText').value = '';
});
</script>


	</ul>
</div>


<nav class="optionsMenu">
	

	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>