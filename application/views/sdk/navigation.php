<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="row gx-3">
        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label">Title</label>
            <input type="text" name="NAV[TITLE]" placeholder="Type here" class="form-control" id="descr">
        </div>
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Form</label>
            <select name="NAV[FORMID]" class="form-control" id="" require>
                <option value="">Select Form</option>
                <?php foreach (get_form_list() as $form) : ?>
                    <option value="<?= $form->formid ?>"><?= $form->descr ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Parent</label>
            <select name="NAV[PARENTID]" class="form-control" id="" require>
                <option value="">Select Parent</option>
                <option value="2">Master</option>
                <option value="3">Transaction</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Active</label>
            <select name="NAV[ACTIVE]" class="form-control" id="" require>
                <option value="">Select Parent</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
        </div>
    </div>

    <!-- SO Address START. -->
    <div class="crm-heading">Navigation Features</div>
    <table class="table table-default table-responsive crmgrid" id="so_item_details">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Discount</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="tr_clone">
                <td style="width:5%">1</td>
                <td style="width:10%">
                    <select name="NAVFEATURES[DESCR][]" class="form-control itemid" required>
                        <?= system_queries('sys_navfeature'); ?>
                    </select>
                </td>
                <td style="width:10%"><input type="number" min="1" placeholder="0.00" name="NAVFEATURES[QUANTITY][]" class="form-control quantity" required></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="NAVFEATURES[RATE][]" class="form-control rate" required></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="NAVFEATURES[DISCOUNT][]" class="form-control discount" required></td>
                <td style="width:20%">
                    <input type="number" min="0" placeholder="0.00" name="NAVFEATURES[AMOUNT][]" class="form-control amount" readonly required>
                    <input type="hidden" name="NAVFEATURES[SODETID][]" class="form-control" readonly>
                </td>
            </tr>
        </tbody>
    </table>

</section>