<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<div class="uk-container">
    <h1 class="uk-text-center">
        <?= $page_title ?>
        <span id="print" uk-icon="icon: print" class="uk-icon-button uk-margin-left"></span>
    </h1>

    <div uk-grid>
        <div class="uk-width-3-5@m">
            <form action="">

                <div class="uk-margin">
                    <label for="doc_number">დოკუმენტის ნომერი</label>
                    <input class="uk-input" type="text" name="doc_number" id="doc_number">
                </div>

                <div class="uk-margin">
                    <label for="doc_name">დოკუმენტის სახელი</label>
                    <input class="uk-input" type="text" name="doc_name" id="doc_name">
                </div>


            </form>

            <div uk-grid class="uk-flex uk-flex-between">
                <div class="nominals">

                    <div class="nominal" style="margin-top: 50px">
                        <h3 class="uk-text-center">ნომინალები</h3>
                        <select name="nominals" id="" class="uk-select">
                            <option value="">აირჩიეთ ნომინალი</option>
                        <?php foreach ( $nominals as $checkbox): ?>
                           <option value="<?=$checkbox->title?>"><?=$checkbox->title?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="institutions">

                    <div class="institution" style="margin-top: 50px">
                        <h3 class="uk-text-center">ავტორი</h3>
                        <div class="uk-margin">

                        <select name="institutions" id="" class="uk-select">
                            <option value="">აირჩიეთ დაწესებულება</option>
                        <?php foreach ( $institutions as $checkbox): ?>
                           <option value="<?=$checkbox->title?>"><?=$checkbox->title?></option>
                        <?php endforeach; ?>
                        </select>

                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="uk-width-2-5@m">

            <div class="uk-flex uk-flex-between">
                <div>
                    <label for="start_day">დღე</label>
                    <input name="start_day" class="uk-input" id="start_day" type="number" min="1" max="31">
                </div>
                <div>
                    <label for="start_month">თვე</label>
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
                    <label for="start_year">წელი</label>
                    <input name="start_year" class="uk-input" id="start_year" type="number" min="1000" max="9999">
                </div>
            </div>

            <div class="connections">

                <div class="connection" style="margin-top: 50px">
                    <h3 class="">კავშირები</h3>
                    <?php foreach ( $connections as $checkbox): ?>
                        <div class="uk-margin">
                            <label><input class="uk-checkbox" name="connections[]" type="checkbox"> <?=$checkbox->title?></label><br>

                            <div class="uk-inline" uk-tooltip="title: სუბიექტი/ობიექტი; pos: top-right; delay: 500" >
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" name="subject[]">
                            </div>

                        </div>
                    <?php endforeach; ?>
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


        let nom = document.querySelector("[name^=nom]").value, 
            inst = document.querySelector("[name^=inst]").value, 
            conn = [];

        document.querySelectorAll('input[name^=conn]:checked').forEach(function(e){
            let subject = e.parentElement.parentElement.querySelector("[name^=sub]").value;
            conn.push( `${e.nextSibling.data} - ${subject}` );
        });

        // nominal = nominal.slice(0,-1);

        let dates = `${sd}/${sm}/${sy}`;

        data.append('dates',dates);
        data.append('nominals',nom);
        data.append('author', inst);
        data.append('doc_numb', $('#doc_number').val());
        data.append('title',$('#doc_name').val());
        data.append('connection_types', conn);
        data.append('type', 'ds');

        console.log(data);

        axios({
            method:"post",
            headers:{
                'Content-Type':'multipart/form-data'
            },
            url:"<?=base_url('document/qrcode')?>",
            data:data
        }).then(data=>{
                console.log(data);
                alert(data.data.message);
                open('<?=base_url("document/show")?>');
            }
        )

    });

</script>
    <?= $this->endSection() ?>

