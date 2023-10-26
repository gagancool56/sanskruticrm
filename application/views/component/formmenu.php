<div class="transaction-menu">
    <ul class="list-unstyled">
        <?php if ($type == 'view') : ?>
            <li>
                <a href="?method=add" class="panelactions" data-type="add">
                    <div class="img-with-text">
                        <img src="<?= asset_url('new.png', 'assets/transactions-icons/') ?>">
                        <p>New</p>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if (in_array($type, array('add', 'revise'))) : ?>
            <li>
                <a href="javascript:void(0);" class="panelactions" data-formid="<?= $formid ?>" data-type="save" data-knavid="<?= $knavid ?>">
                    <div class="img-with-text">
                        <img src="<?= asset_url('save.png', 'assets/transactions-icons/') ?>">
                        <p>Save</p>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if (in_array($type, array('view')) && !empty($is_record)) : ?>
            <li>
                <a href="javascript:void(0);" class="panelactions" data-type="revise">
                    <div class="img-with-text">
                        <img src="<?= asset_url('revise.png', 'assets/transactions-icons/') ?>">
                        <p>Revise</p>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if (in_array($type, array('add', 'revise'))) : ?>
            <li>
                <a href="javascript:void(0);" class="panelactions" data-type="cancel">
                    <div class="img-with-text">
                        <img src="<?= asset_url('cancel.png', 'assets/transactions-icons/') ?>">
                        <p>Cancel</p>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($type == 'view') : ?>
            <li>
                <a href="javascript:void(0);" class="panelactions" data-type="find" data-knavid="<?= $knavid ?>" data-formid="<?= $formid ?>">
                    <div class="img-with-text">
                        <img src="<?= asset_url('find.png', 'assets/transactions-icons/') ?>">
                        <p>Find</p>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($type == 'view' && !empty(@$actions)) : ?>
            <li>
                <a href="#" class="panelactions dropdown-toggle" data-type="actions" data-knavid="<?= $knavid ?>" data-formid="<?= $formid ?>" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="img-with-text">
                        <img src="<?= asset_url('actions.png', 'assets/transactions-icons/') ?>">
                        <p>Actions</p>
                    </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?= $actions ?>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>