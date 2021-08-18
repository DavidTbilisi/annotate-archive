<?php
$dates = explode("-",$data['dates']);
$levels = explode(',', $data['levels']);
?>

<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>




<div class="uk-container uk-section">

    <article class="uk-article">
        <h1 class="uk-article-title"><?=$data['name']?></h1>
        <p class="uk-article-meta">
            <?=DateTime::createFromFormat('d/m/Y', $dates[0])->format('d M, Y')?>-
            <?=DateTime::createFromFormat('d/m/Y', $dates[1])->format('d M, Y')?>
        </p>
        <p class="uk-article-meta">     <?=$data['nominals']?>   </p>

        <div class="uk-grid uk-flex ">
            <div>
                <table class="uk-table uk-table-striped">
                    <thead>
                    <tr>
                        <th>დონე</th>
                        <th>პრეფიქსი</th>
                        <th>ნომერი</th>
                        <th>სუფიქსი</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($levels as $lvl): $level = explode('_', $lvl)?>
                    <tr>
                        <td><?=$level[0]?></td>
                        <td><?=$level[1]?></td>
                        <td><?=$level[2]?></td>
                        <td><?=$level[3]?></td>
                    </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
            <div>
                <img src="<?=base_url('images/Book.png')?>" title="<?=$image?>" alt="<?=$image?>">
            </div>
        </div>
    </article>



</div>

<?= $this->endSection() ?>