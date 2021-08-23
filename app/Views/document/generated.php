<?php
$dates = explode("-",$data['dates']);
$inst = explode(",",$data['institutions']);
$conn = explode(",",$data['connection_types']);
$nom = explode(",",$data['nominals']);
?>

<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>




<div class="uk-container uk-section">

    <article class="uk-article">
        <h1 class="uk-article-title"><?=$data['name']?> - <?=$data['doc_numb']?></h1>
        <p class="uk-article-meta">
            <?=DateTime::createFromFormat('d/m/Y', $dates[0])->format('d M, Y')?>
        </p>
        <p class="uk-article-meta">     <?=$data['nominals']?>   </p>

        <div class="uk-grid uk-flex ">
            <div>
                <div class="uk-grid uk-flex ">
                    <div>
                        <h4>ნომინალები</h4>
                        <ul class="uk-list uk-list-disc">
                            <?php foreach($nom as $n): ?>
                            <li><?=$n?></li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <div>
                        <h4>კავშირის ტიპი - ხელმომწერი</h4>
                        <ul class="uk-list uk-list-disc">
                            <?php foreach($conn as $con): ?>
                                <li><?=$con?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div>
                        <h4>დაწესებულებები</h4>
                        <ul class="uk-list uk-list-disc">
                            <?php foreach($inst as $ins): ?>
                                <li><?=$ins?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <img src="<?=base_url('images/Document.png')?>" title="<?=$image?>" alt="<?=$image?>">
            </div>
        </div>
    </article>



</div>

<?= $this->endSection() ?>