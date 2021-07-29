<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<div class="uk-container">
    <h1 class="uk-text-center"><?= $page_title ?></h1>

    <div uk-grid>
        <div class="uk-width-3-5@m">
            <form action="">

                <div class="uk-margin">
                    <label for="doc_number">დოკუმენტის ნომერი</label>
                    <input class="uk-input" type="text" id="doc_number">
                </div>

                <div class="uk-margin">
                    <label for="doc_name">დოკუმენტის სახელი</label>
                    <input class="uk-input" type="text" id="doc_name">
                </div>



            </form>
        </div>

        <div class="uk-width-2-5@m">

            <div class="uk-flex uk-flex-between">
                <div>
                    <label for="start_day">საწყისი დღე</label>
                    <input name="start_day" class="uk-input" id="start_day" type="number" min="1" max="31">
                </div>
                <div>
                    <label for="start_month">საწყისი თვე</label>
                    <select name="start_month" class="uk-select" id="start_month">
                        <option value="">აირჩიე თვე</option>
                        <option value="1">იანვარი</option>
                        <option value="2">თებერვალი</option>
                        <option value="3">მარტი</option>
                        <option value="4">აპრილი</option>
                        <option value="5">მაისი</option>
                        <option value="6">ივნისი</option>
                        <option value="7">ივლისი</option>
                        <option value="8">აგვისტო</option>
                        <option value="9">სექტემბერი</option>
                        <option value="10">ოქტომბერი</option>
                        <option value="11">ნოემბერი</option>
                        <option value="12">დეკემბერი</option>
                    </select>
                </div>
                <div>
                    <label for="start_year">საწყისი წელი</label>
                    <input name="start_year" class="uk-input" id="start_year" type="number" min="1000" max="9999">
                </div>
            </div>

            <div class="uk-margin">
                <label for="object">სუბიექტი / ობიექტი</label>
                <input class="uk-input" type="text" id="object" name="object">
            </div>
        </div>
    </div>


    <div uk-grid>
        <div class="nominals">

                <div class="nominals" style="margin-top: 50px">
                    <h3 class="uk-text-center">ნომინალები</h3>
                    <?php foreach ( $nominals as $checkbox): ?>
                        <div class="uk-margin">
                            <label><input class="uk-checkbox" type="checkbox"> <?=$checkbox->title?></label> <br>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
        <div class="institutions">

                <div class="nominals" style="margin-top: 50px">
                    <h3 class="uk-text-center">დაწესებულება</h3>
                    <?php foreach ( $institutions as $checkbox): ?>
                        <div class="uk-margin">
                            <label><input class="uk-checkbox" type="checkbox"> <?=$checkbox->title?></label> <br>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
        <div class="connections">

                <div class="nominals" style="margin-top: 50px">
                    <h3 class="uk-text-center">კავშირები</h3>
                    <?php foreach ( $connections as $checkbox): ?>
                        <div class="uk-margin">
                            <label><input class="uk-checkbox" type="checkbox"> <?=$checkbox->title?></label> <br>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>

    </div>

    <div class="uk-text-right">
        <button class="uk-button uk-button-danger">გაუქმება</button>
        <button class="uk-button uk-button-primary ">შენახვა</button>
    </div>
</div>
    <?= $this->endSection() ?>

