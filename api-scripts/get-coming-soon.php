<?php
$dbData = getComingSoon();
?>

<script src="./js/api-script.js">
</script>


<script>

let dbData = <?php echo json_encode($dbData); ?>; 

for(let i=0; i<dbData.length; i++) {
    fetchContent(dbData[i]["type"], dbData[i]["tmdbId"]);
}

</script>