<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">
        <div class="col-md-6">
            <label for="descr" class="form-label required">Level Name</label>
            <select name="USERRIGHT[USERLEVEL]" id="" class="form-control" required>
                <?= system_queries('SYS_USERLEVEL') ?>
            </select>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label required">Description</label>
            <input type="text" name="USERRIGHT[DESCR]" class="form-control" id="" required>
        </div>
    </div>

    <div class="crm-heading">Navigation List</div>
    <div class="row gx-3">
        <table class="table table-default table-responsive crmgrid">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Navigation Name</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach (navigationList()->result() as $nav) : ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                        <td>
                            <input class="form-control" name="USERRIGHTDET[NAVID][]" type="hidden" value="<?= $nav->navid ?>">
                            <input class="form-control readonly" name="USERRIGHTDET[DESCR][]" type="text" value="<?= $nav->descr ?>" disabled readonly>
                        </td>
                        <td><select class="form-control" name="USERRIGHTDET[ACTIVE][]"><?= system_queries('SYS_YESNO') ?></select></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php crm_close_form('transaction_form'); ?>