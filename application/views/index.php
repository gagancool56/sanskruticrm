<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>
            <p>Whole data about your business here</p>
        </div>
        <div>
            <label for="from">From</label>
            <input type="text" id="fromdate" class="readonly" value="<?= isset($_SESSION['FROMDATE']) ? $_SESSION['FROMDATE'] : date('d/m/Y'); ?>" name="from" readonly>
            <label for="to">to</label>
            <input type="text" id="todate" class="readonly" value="<?= isset($_SESSION['TODATE']) ? $_SESSION['TODATE'] : date('d/m/Y'); ?>" name="to" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Revenue</h6>
                        <span><?= @$dashdata['totalRevenue'] ?></span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">New Orders</h6>
                        <span><?= @$dashdata['totalOrders'] ?></span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Paid Amt.</h6>
                        <span><?= @$dashdata['totalPaid'] ?></span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Pending Amt.</h6>
                        <span><?= @$dashdata['totalPending'] ?></span>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <h4 class="card-title">Latest orders</h4>
        </header>
        <div class="card-body">
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 custom-dtable display">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle" scope="col" width="10%">Order ID</th>
                                <th class="align-middle" scope="col" width="10%">Order Type</th>
                                <th class="align-middle" scope="col" width="20%">Party Name</th>
                                <th class="align-middle" scope="col" width="10%">Agent Name</th>
                                <th class="align-middle" scope="col" width="15%">Order Date</th>
                                <th class="align-middle" scope="col" width="10%">Qty</th>
                                <th class="align-middle" scope="col" width="10%">Total</th>
                                <th class="align-middle" scope="col" width="10%">Payment Status</th>
                                <th class="align-middle" scope="col" width="10%">Payment Method</th>
                                <th class="align-middle" scope="col" width="20%">View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($dashdata['sorows'])) :
                                foreach ($dashdata['sorows'] as $row) : ?>
                                    <tr>
                                        <td><a href="javascript:void(0);" class="fw-bold"><?= 'SAF-', $row['soid'] ?></a></td>
                                        <td><?= $row['ordertype'] ?></td>
                                        <td><?= $row['party'] ?></td>
                                        <td><?= $row['agent_name'] ?></td>
                                        <td><?= date('d-M-Y', strtotime($row['orderdate'])); ?></td>
                                        <td><?= $row['quantity']; ?></td>
                                        <td><?= number_format($row['amount'], 2); ?></td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-<?= @$row['paymentstatus'] == 'Paid' ? 'success' : 'danger' ?>"><?= @$row['paymentstatus'] ?></span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> <?= $row['paymentmethod'] ?></td>
                                        <td>
                                            <a href="<?= base_url('crmform/3/10/?method=view&soid=' . $row['soid']) ?>" target="_blank" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-responsive end// -->
        </div>
    </div>
</section>