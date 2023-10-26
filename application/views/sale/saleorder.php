<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">
        <div class="col-md-4 mb-4">
            <label for="" class="form-label">Order No.</label>
            <input type="text" name="SO[ORDERNO]" placeholder="System generated" class="form-control" readonly disabled required>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Order Date</label>
            <input type="text" name="SO[ORDERDATE]" placeholder="Order Date" value="<?= date('d-m-Y') ?>" class="form-control customdatepicker" readonly required>
        </div>

        <div class="col-md-4">
            <label for="" class="form-label required">Party</label>
            <?= form_lookup('party', 'SO[PARTYID]', 'SO[DESCR_PARTYID]', '', false) ?>
        </div>

        <div class="col-md-4">
            <label for="" class="form-label required">Order Type</label>
            <select name="SO[ORDERTYPE]" class="form-control" required>
                <option value="" selected="selected">Please select a value</option>
                <option value="NEW">New</option>
                <option value="SAM">Sample</option>
                <option value="RRP">Rotten Replacement</option>
                <option value="DRP">Damange Replacement</option>
            </select>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Delivery Date</label>
            <input type="text" name="SO[DELIVERYDATE]" placeholder="Delivery Date" value="<?= date('d-m-Y') ?>" class="form-control customdatepicker" readonly>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Re-Order Date</label>
            <input type="text" name="SO[REORDERDATE]" placeholder="Re Order Date" value="" class="form-control customdatepicker" readonly required>
        </div>

        <div class="col-md-4">
            <label for="" class="form-label required">Payment Status</label>
            <select name="SO[PAYMENTSTATUS]" class="form-control" required>
                <option value="" selected="selected">Please select a value</option>
                <option value="1">Paid</option>
                <option value="2">Pending</option>
            </select>
        </div>

        <div class="col-md-4 hidden">
            <label for="" class="form-label">Payment Method</label>
            <select name="SO[PAYMENTMETHOD]" class="form-control">
                <option value="" selected="selected">Please select a value</option>
                <option value="1">QR Code</option>
                <option value="2">CC Machine</option>
                <option value="3">Machine QR</option>
                <option value="4">Cash</option>
                <option value="4">Pending</option>
            </select>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Total Amount</label>
            <input type="text" name="SO[TOTALAMOUNT]" value="0.00" class="form-control" readonly required>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Agent Name</label>
            <select name="SO[CREATED_BY]" class="form-control" readonly required>
                <?= system_queries('SYS_USERS') ?>
            </select>
        </div>
    </div>

    <!-- SO Address START. -->
    <div class="crm-heading">Item Details</div>
    <table class="table table-default table-responsive crmgrid" id="so_item_details">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Discount<br>(Per Unit)</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="tr_clone">
                <td style="width:1%">1</td>
                <td><?= form_lookup('item', 'SODET[ITEMID][]', 'SODET[DESCR_ITEMID][]', '', true) ?></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="SODET[QUANTITY][]" class="form-control quantity"></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="SODET[RATE][]" class="form-control rate" readonly></td>
                <td style="width:10%"><input type="number" min="0" placeholder="0.00" name="SODET[DISCOUNT][]" class="form-control discount"></td>
                <td style="width:10%">
                    <input type="number" min="0" placeholder="0.00" name="SODET[AMOUNT][]" class="form-control amount" readonly>
                    <input type="hidden" name="SODET[SODETID][]" class="form-control" readonly>
                </td>
                <td style="width:5%">
                    <button class="btn btn-danger p-1 deleterow"><i class="icon material-icons md-delete_forever p-0 m-0"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</section>
<?php crm_close_form('transaction_form'); ?>