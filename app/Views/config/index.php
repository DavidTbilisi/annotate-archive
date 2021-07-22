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
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <div class="uk-margin uk-flex uk-space-between">
                    <button class="uk-button uk-button-primary">add</button>
                    <input type="text" class="uk-input" name="nominal" placeholder="nominal">
                </div>

            </li>

            <li id="institutions">
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <div class="uk-margin uk-flex uk-space-between">
                    <button class="uk-button uk-button-primary">add</button>
                    <input type="text" class="uk-input" name="institutions" placeholder="institutions">
                </div>

            </li>

            <li id="connection">
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <div class="uk-margin uk-flex uk-space-between">
                    <button class="uk-button uk-button-primary">add</button>
                    <input type="text" class="uk-input" name="connection" placeholder="connection">
                </div>

            </li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>
