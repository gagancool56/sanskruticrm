<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">

        <div class="col-md-6">
            <label for="descr" class="form-label required">Level Name</label>
            <input type="text" name="USERLEVEL[DESCR]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label required">Active</label>
            <select name="USERLEVEL[ACTIVE]" class="form-control" id="" required>
                <?= system_queries('SYS_YESNO') ?>
            </select>
        </div>
    </div>
</section>
<?php crm_close_form('transaction_form'); ?>