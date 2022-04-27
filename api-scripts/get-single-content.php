<?php
$contentDetails = getContentDetails();
$tmdbId = $contentDetails["id"];
$type = $contentDetails["type"];
$dbData = getSingleContent($tmdbId, $type);
?>

<script src="./js/api-script.js">
</script>


<script>

let dbData = <?php echo json_encode($dbData); ?>; 

fetchSingleContent(dbData["type"], dbData["tmdbId"], dbData["trailer"]);

</script>