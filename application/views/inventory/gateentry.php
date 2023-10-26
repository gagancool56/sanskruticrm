<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">
        <div class="col-md-4 mb-4">
            <label for="" class="form-label">Gate Entry No.</label>
            <input type="text" name="GR[GRID]" placeholder="System generated" class="form-control" readonly disabled required>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Entry Date</label>
            <input type="text" name="GR[GRDATE]" placeholder="Order Date" value="<?= date('d-m-Y') ?>" class="form-control customdatepicker" readonly required>
        </div>

        <div class="col-md-4">
            <label for="" class="form-label required">Party</label>
            <?= form_lookup('party', 'GR[PARTYID]', 'GR[DESCR_PARTYID]', '', false) ?>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Challan/Bill</label>
            <select name="GR[CHALLANTYPE]" id="" class="form-control">
                <option>Select a value</option>
                <option value="C">Challan</option>
                <option value="B">Bill</option>
            </select>
        </div>
        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Challan/Bill No.</label>
            <input type="text" name="GR[CHALLANNO]" placeholder="Challan No" value="" class="form-control" required>
        </div>
        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Challan/Bill Date</label>
            <input type="text" name="GR[CHALLANDATE]" placeholder="Challan Date" value="<?= date('d-m-Y') ?>" class="form-control customdatepicker" readonly required>
        </div>
        <div class="col-md-4 mb-4">
            <label for="" class="form-label">Vehicle No.</label>
            <input type="text" name="GR[VEHICLENO]" placeholder="Vehicle No" class="form-control">
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Total Amount</label>
            <input type="text" name="GR[TOTALAMOUNT]" value="0.00" class="form-control" readonly required>
        </div>
    </div>

    <!-- GR Address START. -->
    <div class="crm-heading">Item Details</div>
    <table class="table table-default table-responsive crmgrid" id="gr_item_details">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="tr_clone">
                <td style="width:1%">1</td>
                <td><?= form_lookup('item', 'GRDET[ITEMID][]', 'GRDET[DESCR_ITEMID][]', '', true) ?></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="GRDET[QUANTITY][]" class="form-control quantity"></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="GRDET[RATE][]" class="form-control rate" readonly></td>
                <td style="width:10%">
                    <input type="number" min="0" placeholder="0.00" name="GRDET[AMOUNT][]" class="form-control amount" readonly>
                    <input type="hidden" name="GRDET[GRDETID][]" class="form-control" readonly>
                </td>
                <td style="width:5%">
                    <button class="btn btn-danger p-1 deleterow"><i class="icon material-icons md-delete_forever p-0 m-0"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</section>
<?php crm_close_form('transaction_form'); ?>