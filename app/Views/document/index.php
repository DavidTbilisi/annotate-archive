<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<div class="uk-container">
    <h1 class="uk-text-center"><?= $page_title ?></h1>

    <form action="">

        <div class="uk-margin">
            <label for="doc_number">დოკუმენტის ნომერი</label>
            <input class="uk-input" type="text" id="doc_number">
        </div>

        <div class="uk-margin">
            <label for="doc_name">დოკუმენტის სახელი</label>
            <input class="uk-input" type="text" id="doc_name">
        </div>

        <div class="uk-text-right">
            <button class="uk-button uk-button-danger">გაუქმება</button>
            <button class="uk-button uk-button-primary ">შენახვა</button>
        </div>

    </form>
</div>
<?= $this->endSection() ?>

