<div class="modal fade" id="finder-modal" tabindex="-1" aria-hidden="true" style="height: 450px;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3bb77e;">
                <h5 class="modal-title text-white" style="font-size: 18px;font-weight:100;"><?= $finderName ?></h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-10">
                <table class="table table-bordered table-hover display" id="finder-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <?php foreach ($finderHeader as $header) : ?>
                                <th><?= $header ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <?php foreach ($finderHeader as $header) : ?>
                                <th><?= $header ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>