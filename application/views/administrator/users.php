<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">
        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">User Name</label>
            <input type="text" name="USERS[USERNAME]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">Password</label>
            <input type="text" name="USERS[PASSWORD]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">Name</label>
            <input type="text" name="USERS[DESCR]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="descr" class="form-label">HOD</label>
            <select name="USERS[HOD]" class="form-control">
                <?= system_queries('SYS_USERS') ?>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">User Level</label>
            <select name="USERS[USERLEVEL]" class="form-control" id="" required>
                <?= system_queries('SYS_USERLEVEL') ?>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">Active</label>
            <select name="USERS[ACTIVE]" class="form-control" id="" required>
                <?= system_queries('SYS_YESNO') ?>
            </select>
        </div>
    </div>

</section>
<?php crm_close_form('transaction_form'); ?>