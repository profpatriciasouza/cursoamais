<script>
<?php 
$tv = $this->valueTest;
if(!empty($tv)) {
    ?>$(document).ready(function() { t.add('<?=$id?>', '<?=$tv?>'); });<?php
}
?>
</script>