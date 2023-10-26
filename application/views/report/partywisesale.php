<?php crm_start_report_form('report_form'); ?>
<section class="content-main bg-white">
    <div class="crm-heading mt-0"><?= $reportrow->descr ?></div>
    <div class="row gx-3">
        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Start Date</label>
            <input type="text" name="NA[STARTDATE]" placeholder="Order Date" value="<?= date('d-m-Y') ?>" class="form-control customdatepicker" readonly required>
        </div>
        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">End Date</label>
            <input type="text" name="NA[ENDDATE]" placeholder="Order Date" value="<?= date('d-m-Y') ?>" class="form-control customdatepicker" readonly required>
        </div>
        <div class="col-md-4 mb-4">
            <label for="descr" class="form-label required">Select Party</label>
            <select name="NA[PARTYID]" id="" class="form-control" required>
                <?= system_queries('sys_party'); ?>
            </select>
        </div>
        <div class="col-md-4"><button id="show_report" class="btn btn-primary">Show Report</button></div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-5 grid-report">
        </div>
    </div>
</section>

<?php crm_close_report_form('report_form'); ?>