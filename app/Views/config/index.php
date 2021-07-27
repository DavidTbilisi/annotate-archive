<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>

<h1 class="uk-text-center">Config Page</h1>

<div class="uk-container">
    <div class="uk-margin-medium-top">
        <ul uk-tab class="uk-flex-center">
            <li><a href="#">Nominal</a></li>
            <li><a href="#">Institutions</a></li>
            <li><a href="#">Connection Types</a></li>
        </ul>

        <ul class="uk-switcher uk-margin">
            <li id="nominal">
                <?php foreach($nominals as $nominal): ?>
                <label><input class="uk-checkbox" type="checkbox" checked> <?= $nominal->title?></label> <br>
                <?php endforeach; ?>
                <form action="<?=base_url('config/add_nominal')?>" method="POST">
                <div class="uk-margin uk-flex uk-space-between">
                    <button class="uk-button uk-button-primary">add</button>
                    <input type="text" class="uk-input" name="nominal" placeholder="nominal">
                </div>
                </form>

            </li>

            <li id="institutions">
                <?php foreach($institutions as $inst): ?>
                <label><input class="uk-checkbox" type="checkbox" checked> <?=$inst->title?></label> <br>
                <?php endforeach; ?>

                <form action="<?=base_url('config/add_institution')?>" method="POST">
                <div class="uk-margin uk-flex uk-space-between">
                    <button class="uk-button uk-button-primary">add</button>
                    <input type="text" class="uk-input" name="institutions" placeholder="institutions">
                </div>
                </form>


            </li>

            <li id="connection">
                <?php foreach($connections as $connection): ?>
                    <label><input class="uk-checkbox" type="checkbox" checked> <?=$connection->title?></label> <br>
                <?php endforeach; ?>

                <form action="<?=base_url('config/add_connection')?>" method="POST">
                <div class="uk-margin uk-flex uk-space-between">
                    <button class="uk-button uk-button-primary">add</button>
                    <input type="text" class="uk-input" name="connection" placeholder="connection">
                </div>
                </form>

            </li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>
