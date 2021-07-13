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
            </li>

            <li id="institutions">
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
            </li>

            <li id="connection">
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
                <label><input class="uk-checkbox" type="checkbox" checked> A</label> <br>
            </li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>
