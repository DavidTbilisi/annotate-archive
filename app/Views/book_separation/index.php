<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
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
        #book-separation form span {
            position: absolute;
            right: -15px;
            top: -35px;
            cursor: pointer;
        }

    </style>


    <div class="uk-container uk-container-xlarge uk-section" id="book-separation">

        <div uk-grid>
            <div class="uk-width-4-5@m uk-padding">
                <div class="uk-card">
                    <form class="uk-form-stacked">

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-stacked-text">Name Of Work</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-stacked-text" type="text" placeholder="Some text...">
                            </div>
                        </div>

                        <span uk-icon="icon: print" class="uk-icon-button uk-margin-small-right"></span>

                        <div class="uk-flex uk-flex-between uk-child-width-expand">

                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">დონე</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="form-stacked-text" type="text"
                                               placeholder="Some text...">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">პრეფიქსი</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="form-stacked-text" type="text"
                                               placeholder="Some text...">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">ნომერი</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="form-stacked-text" type="text"
                                               placeholder="Some text...">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">სუფიქსი</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="form-stacked-text" type="text"
                                               placeholder="Some text...">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="uk-text-right">
                            <button class="uk-button uk-button-primary uk-display-inline">Save</button>
                        </div>

                        <hr class="uk-divider-icon">

                    </form>
                    <table class="uk-table display" id="example" style="width:100%">
                        <thead>
                        <tr>
                            <th>დონე</th>
                            <th>პრეფიქსი</th>
                            <th>ნომერი</th>
                            <th>სუფიქსი</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (range(1, 5) as $item): ?>
                            <tr>
                                <td><?= $item ?> დონე</td>
                                <td><?= $item ?> პრეფიქსი</td>
                                <td><?= random_int(1, 999) ?></td>
                                <td><?= $item ?> სუფიქსი</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>
            </div>
            <div class="uk-width-1-5@m ">
                <div class="buttons uk-flex uk-flex-around uk-padding">
                    <div class="uk-button uk-button-danger">Cancel</div>
                    <div class="uk-button uk-button-primary">Save</div>
                </div>

                <div class="dates uk-flex uk-flex-between">
                    <div>
                        <label for="startdate">Start Date</label>
                        <input type="date" name="startdate" id="startdate">
                    </div>
                    <div>
                        <label for="enddate">End Date</label>
                        <input type="date" name="enddate" id="enddate">
                    </div>
                </div>

                <div class="nominals" style="margin-top: 50px">
                    <h1 class="uk-text-center">Nominals</h1>
                    <?php foreach (range(1, 7) as $checkbox): ?>
                        <div class="uk-margin">
                            <?= checkbox('one' . $checkbox, 'One' . $checkbox, true) ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
    <script>

        $(document).ready(function () {
            $('#example').DataTable({
                ordering: true
            });
        });

    </script>
<?= $this->endSection() ?>