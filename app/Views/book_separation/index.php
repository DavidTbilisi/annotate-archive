<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<?php $months = ["იანვარი","თებერვალი","მარტი",  "აპრილი","მაისი","ივნისი","ივლისი",  "აგვისტო","სექტემბერი","ოქტომბერი",  "ნოემბერი","დეკემბერი"] ?>
<?php
helper('form');
function checkbox($data = '', string $value = '', bool $checked = false, $extra = ''): string
{
    $defaults = [
        'type' => 'checkbox',
        'name' => (!is_array($data) ? $data : ''),
        'value' => $value,
        'class' => "uk-checkbox",
    ];

    if (is_array($data) && array_key_exists('checked', $data)) {
        $checked = $data['checked'];
        if ($checked === false) {
            unset($data['checked']);
        } else {
            $data['checked'] = 'checked';
        }
    }

    if ($checked === true) {
        $defaults['checked'] = 'checked';
    } elseif (isset($defaults['checked'])) {
        unset($defaults['checked']);
    }
    return '<label><input ' . parse_form_attributes($data, $defaults) . stringify_attributes($extra) . "> $value </label>\n";
    return '<input ' . parse_form_attributes($data, $defaults) . stringify_attributes($extra) . " />\n";
}

?>


<style>
    #book-separation form #print {
        position: absolute;
        right: -15px;
        top: -35px;
        cursor: pointer;
    }
</style>




<div class="uk-container uk-container-xlarge"
    id="book-separation">

    <h1 class="uk-text-center">
        <?= $page_title ?>
        <span id="print" uk-icon="icon: print"
            class="uk-icon-button uk-margin-left"></span>
    </h1>

    <div uk-grid>
        <div class="uk-width-3-5@m uk-padding">
            <div class="uk-card">
                <div class="uk-form-stacked">

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">საქმის იდენტიფიკატორი</label>
                        <div class="uk-form-controls">
                            <input name="name" class="uk-input" id="form-stacked-text" type="text" placeholder="Some text...">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">სახელი</label>
                        <div class="uk-form-controls">
                            <input name="title" class="uk-input" id="form-stacked-text" type="text" placeholder="Some text...">
                        </div>
                    </div>

                </div>

                <div class="nominals"
                    style="margin-top: 50px">
                    <h1 class="uk-text-center">
                        ნომინალები</h1>
                    <?php foreach ( $nominals as $checkbox): ?>
                    <div class="uk-margin">
                        <?= checkbox($checkbox->title, $checkbox->title) ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="uk-width-2-5@m uk-padding">

        <div class="uk-flex uk-flex-between uk-child-width-expand">
            <div class="dates">
                <div class="uk-flex uk-flex-between">
                    <div>
                        <label for="start_day_date">საწყისი დღე</label>
                        <input name="start_day_date" class="uk-input" id="start_day_date" type="number" min="1" max="31">
                    </div>
                    
                    <div>
                        <label for="start_month_date">საწყისი თვე</label>
                        <select name="start_month_date" class="uk-select" id="start_month_date">
                            <option value=""> აირჩიე თვე </option>
                            <?php
                            foreach($months as $index => $value){
                                $index++;
                                echo "<option value=\"$index\"> {$value} </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="start_year_date">საწყისი წელი</label>
                        <input name="start_year_date" class="uk-input" id="start_year_date" type="number" min="1000" max="9999">
                    </div>
                </div>
                <div class="uk-flex uk-flex-between" style="margin-top: 40px">
                    <div>
                        <label for="end_day_date">საბოლოო დღე</label>
                        <input name="end_day_date" class="uk-input" id="end_day_date" type="number" min="1" max="31">
                    </div>
                    <div>
                        <label for="end_month_date">საბოლოო თვე</label>
                        <select name="end_month_date" class="uk-select" id="end_month_date">
                            <option value=""> აირჩიე თვე </option>
                            <?php foreach($months as $index => $value){
                                $index++;
                                echo "<option value=\"$index\"> {$value} </option>";
                            } ?>
                        </select>
                    </div>
                    <div>
                        <label for="end_year_date"> საბოლოო წელი </label>
                        <input name="end_year_date" class="uk-input" id="end_year_date" type="number" min="1000" max="9999">
                    </div>
                </div>
                </div>
        </div>
        </div>
    </div>
    <script>
        let print = $('#print');
        print.on("click", function () {
            var data = new FormData();

            function val(selector) {
                return document.querySelector(selector).value
            }

            let sd = val('[name^=start_day]');
            let sm = val('[name^=start_month]');
            let sy = val('[name^=start_year]');
            let ed = val('[name^=end_day]');
            let em = val('[name^=end_month]');
            let ey = val('[name^=end_year]');

            let nominal = [],
                levels = [];

            document.querySelectorAll('input[name]:checked').forEach(function (e) {
                    nominal.push(e.value);
                });
            document.querySelectorAll('#example tbody tr').forEach(function (e) {
                    levels.push(e.innerText.split('\t').join("_"));
                });

            // nominal = nominal.slice(0,-1);

            let dates = `${sd}/${sm}/${sy}-${ed}/${em}/${ey}`;

            data.append('dates', dates);
            data.append('nominals', [nominal]);
            data.append('name', val('input[name=name]'));
            data.append('title', val('input[name=title]'));

            axios({
                method: "post",
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                url: "<?=base_url('book/to_yaml')?>",
                data: data
            }).then(data => {
                console.log(data);
                alert(data.data
                    .message);
                open(
                    '<?=base_url("book/test")?>');
            })

        });


        $("#add").on("click", function () {

            let lvl = $("#form-stacked-text1").val();
            let pre = $("#form-stacked-text2").val();
            let num = $("#form-stacked-text3").val();
            let suf = $("#form-stacked-text4").val();

            $("#example tbody").append(
                `<tr>
                    <td> ${lvl} </td>
                    <td> ${pre} </td>
                    <td> ${num} </td>
                    <td> ${suf} </td>
                    <td class="uk-text-center uk-flex uk-flex-around">
                        <a class="uk-text-danger" title="რედაქტირება" href="" uk-icon="icon: copy"></a>
                        <a class="uk-text-danger" title="წაშლა" href="" uk-icon="icon: trash"></a>
                    </td>
                </tr>`

            )
        })

        // $(document).ready(function () {
        // $('#example').DataTable({
        //     ordering: true
        // });
        // });
    </script>
    <?= $this->endSection() ?>