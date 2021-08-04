<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<?php
$parsed =  file_get_contents(WRITEPATH.'/test_yaml.yml');
//dd($parsed);
?>

<h1 class="uk-text-center"><?=$page_title?></h1>
<div class="uk-container">
   <h1 class="uk-text-center uk-text-danger">STOP</h1>
</div>


<?= $this->endSection() ?>

