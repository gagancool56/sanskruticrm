<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">
        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label">Item ID</label>
            <input type="text" name="ITEM[ITEMID]" placeholder="System generated" class="form-control disabled" disabled>
        </div>

        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">Item Name</label>
            <input type="text" name="ITEM[DESCR]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="descr" class="form-label required">Rate</label>
            <input type="number" min="0" name="ITEM[RATE]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">Active</label>
            <select name="ITEM[ACTIVE]" class="form-control" id="" required>
                <option value="">Select Parent</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
        </div>
    </div>
</section>
<?php crm_close_form('transaction_form'); ?>