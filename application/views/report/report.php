<section class="content-main bg-white">
    <div class="crm-heading mt-0">Report List</div>
    <div class="row gx-3">
        <ol>
            <?php if (!empty($reports)) :
                $count = 1;
                foreach ($reports as $report) : ?>
                    <li class="h6"><?= $count++ . '. ' ?><a href="<?= report_url($report->xreportid, $report->url) ?>" class="text-muted"><?= $report->descr ?></a></li>
            <?php endforeach;
            endif; ?>
        </ol>
    </div>
</section>