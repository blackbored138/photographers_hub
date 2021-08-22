<?php foreach ($backlog as $backlogs) : 
    $last_updated_at = date("d-m-Y @ h:m:s", strtotime($backlogs->updated_at));
    ?>
    <li>
        <div class="row">
            <div class="col-md-8">
                <i class="fa fa-square mr-1" style="color:<?= $backlogs->label_color ?>"></i> <span class="backlogs-list text-black"><?= $backlogs->feedback ?></span>
                <p class="backlogs-list-footer"><?= $last_updated_at ?></p>
                
            </div>
            <div class="col-md-3">
                <select data-id="<?= magicfunction($backlogs->feedback_id,'e')  ?>" class="custom-select rounded-0 change-feedback-type">
                    <option selected value="0">Backlog</option>
                    <?php foreach ($feedback_types as $types) : ?>
                        <option <?= ($types->type_id == $backlogs->feedback_type)?'selected':''; ?> value="<?= magicfunction($types->type_id, 'e') ?>"><?= $types->type_name ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>
    </li>
    <hr>
<?php endforeach; ?>