<?php
$dates = explode("-",$data['dates']);
?>

<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>




<div class="uk-container uk-section">

    <article class="uk-article">
        <h1 class="uk-article-title"><?=$data['title']?> - <?=$data['doc_numb']?></h1>
        <p class="uk-article-meta">
            <?=DateTime::createFromFormat('d/m/Y', $dates[0])->format('d/m/Y')?>
        </p>


        <div class="uk-grid uk-flex ">
            <div>
                <div>
                   
                <p><b>ნომინალი:</b> <?=$data['nominals']?></p>
                <p><b>კავშირის ტიპი - ხელმომწერი:</b> <?=$data['connection_types']?></p>
                <p><b>ავტორი:</b> <?=$data['author']?></p>
                </div>
            </div>
            <div>
                <img src="<?=base_url('images/Document.png')?>" title="<?=$image?>" alt="<?=$image?>">
            </div>
        </div>
    </article>



</div>

<?= $this->endSection() ?>