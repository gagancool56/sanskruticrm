<?php crm_start_form('transaction_form'); ?>

<section class="content-main bg-white">
    <div class="crm-heading">Main</div>
    <div class="row gx-3">
        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">Party Name</label>
            <input type="text" name="PARTY[DESCR]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">Display Name.</label>
            <input type="text" name="PARTY[SHORTDESCR]" placeholder="Type here" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="descr" class="form-label required">Party Type.</label>
            <select name="PARTY[SUPPTYPE]" class="form-control" required>
                <option value="" selected="selected">Please select a value</option>
                <option value="CUS">Customer</option>
                <option value="SUP">Supplier</option>
                <option value="SCC">Supplier-cum-Customer</option>
                <option value="CCS">Customer-cum-Supplier</option>
                <!-- <option value="COM">Comission Agent</option> -->
                <!-- <option value="AGT">Agent</option>
                <option value="TPT">Transporter</option>
                <option value="EMP">Marketing Employee</option> -->
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">Active</label>
            <select name="PARTY[ACTIVE]" class="form-control" id="" required>
                <option value="">Select Parent</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
        </div>

        <div class="col-md-4 mb-4">
            <label for="" class="form-label required">Created By</label>
            <select name="PARTY[CREATED_BY]" class="form-control" readonly required>
                <?= system_queries('SYS_USERS') ?>
            </select>
        </div>
    </div>

    <!-- Party Address START. -->
    <div class="crm-heading">Address</div>
    <div class="row gx-3">
        <div class="col-md-6 mb-4">
            <label for="" class="form-label required">Address Line 1</label>
            <input type="text" name="PARTYADD[ADDRESSLINE1]" placeholder="Type here" class="form-control" id="" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label required">Address Line 2</label>
            <input type="text" name="PARTYADD[ADDRESSLINE2]" placeholder="Type here" class="form-control" id="" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label required">Pincode</label>
            <input type="text" name="PARTYADD[PINCODE]" placeholder="Type here" class="form-control" required>
        </div>
    </div>


    <!-- Contact Person START. -->
    <div class="crm-heading">Contact Person</div>
    <div class="row gx-3">
        <div class="col-md-6 mb-4">
            <label for="descr" class="form-label required">Prefix</label>
            <select name="PARTYCON[PREFIX]" id="" class="form-control" required>
                <option value="" selected="selected">Please select a value</option>
                <option value="MR">Mr</option>
                <option value="MRS">Mrs</option>
                <option value="Dr">Dr</option>
                <option value="MS">Ms</option>
            </select>
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label required">Name</label>
            <input type="text" name="PARTYCON[CONTACTPERSON]" value="" class="form-control" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label required">Official Contact No.</label>
            <input type="number" min="0" name="PARTYCON[PHONE1]" value="" class="form-control" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label">Contact No.</label>
            <input type="number" min="0" name="PARTYCON[PHONE2]" value="" class="form-control">
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label">E-mail</label>
            <input type="email" name="PARTYCON[EMAIL]" value="" class="form-control">
        </div>
        <div class="col-md-6 mb-4">
            <label for="" class="form-label required">Designation</label>
            <input type="text" name="PARTYCON[DESIGNATION]" value="" class="form-control" required>
        </div>
    </div>
</section>
<?php crm_close_form('transaction_form'); ?>