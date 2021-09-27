<?php
$dates = explode("-",$data['dates']);
?>

<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>




<div class="uk-container uk-section">

    <article class="uk-article">
        <h1 class="uk-article-title"> <?=$data['title']?></h1>
        <h3 class="uk-article-title"> ID: <?=$data['name']?></h3>
        <p class="uk-article-meta">
            <?=DateTime::createFromFormat('d/m/Y', $dates[0])->format('d/m/Y')?> -
            <?=DateTime::createFromFormat('d/m/Y', $dates[1])->format('d/m/Y')?>
        </p>
        <p class="uk-article-meta">     <?=$data['nominals']?>   </p>

        <div class="uk-grid uk-flex ">
   
            <div>
                <img src="<?=base_url('images/Book.png')?>" title="<?=$image?>" alt="<?=$image?>">
            </div>
        </div>
    </article>



</div>

<?= $this->endSection() ?>