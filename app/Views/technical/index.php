<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<?php
$parsed =  file_get_contents(WRITEPATH.'/tech.yml');
//dd($parsed);
?>

<h1 class="uk-text-center"><?=$page_title?></h1>
<div class="uk-container">
   <h1 class="uk-text-center uk-text-danger">
       STOP
       <?php echo '<img src="'.(new chillerlan\QRCode\QRCode)->render($parsed).'" alt="STOP" />'; ?>
   </h1>


</div>


<?= $this->endSection() ?>

