 <!-- content-main end// -->
 </main>
 <!-- Javascript inline START. -->
 <script type="text/javascript">
     var crm_viewer = <?= json_encode(get_viewerjs()); ?>;
     <?= $jdata ?>
     var crm_rowdata = <?= json_encode(view_rowdata()); ?>;
 </script>
 <!-- Javascript inline END -->
 <script src="<?= asset_url('js/vendors/jquery-3.6.0.min.js', 'assets/admin/') ?>"></script>
 <script src="<?= asset_url('js/vendors/bootstrap.bundle.min.js', 'assets/admin/') ?>"></script>
 <script src="<?= asset_url('js/vendors/select2.min.js', 'assets/admin/') ?>"></script>
 <script src="<?= asset_url('js/vendors/perfect-scrollbar.js', 'assets/admin/') ?>"></script>
 <script src="<?= asset_url('js/vendors/jquery.fullscreen.min.js', 'assets/admin/') ?>"></script>
 <script src="<?= asset_url('js/vendors/chart.js', 'assets/admin/') ?>"></script>
 <!-- Main Script -->
 <script src="<?= asset_url('js/main.js', 'assets/admin/') ?>" type="text/javascript"></script>
 <script src="<?= asset_url('js/custom-chart.js', 'assets/admin/') ?>" type="text/javascript"></script>

 <!-- Dattables Script -->
 <script src="<?= asset_url('datatables.js', 'assets/admin/datatables/') ?>" type="text/javascript"></script>
 <script src="<?= asset_url('dataTables.buttons.min.js', 'assets/admin/datatables/') ?>"></script>
 <script src="<?= asset_url('jszip.min.js', 'assets/admin/datatables/') ?>"></script>
 <script src="<?= asset_url('pdfmake.min.js', 'assets/admin/datatables/') ?>"></script>
 <script src="<?= asset_url('vfs_fonts.js', 'assets/admin/datatables/') ?>"></script>
 <script src="<?= asset_url('buttons.html5.min.js', 'assets/admin/datatables/') ?>"></script>

 <!-- Custom Dattables Script -->
 <script src="<?= asset_url('datatable.js', 'assets/') ?>" type="text/javascript"></script>
 <!-- Summernote -->
 <script src="<?= asset_url('plugins/summernote/summernote-lite.min.js', 'assets/admin/') ?>"></script>
 <!-- Datepicker  -->
 <script src="<?= asset_url('datepicker.js', 'assets/admin/datepicker/') ?>"></script>
 <script src="<?= asset_url('crmvalidate.js', 'assets/') ?>"></script>
 <script src="<?= asset_url('custom.js', 'assets/') ?>"></script>
 <script src="<?= asset_url('lookup.js', 'assets/') ?>"></script>
 <?php if (@$is_report) : ?>
     <script src="<?= asset_url('report.js', 'assets/') ?>"></script>
 <?php endif; ?>
 <?php global $data, $KNAVID, $KFORMID; ?>
 <script>
     $(document).ready(function() {
         $('#summernote').summernote({
             dialogsInBody: true,
             tabSize: 2,
             height: 400
         });

         setTimeout(() => {
             $('.alert').fadeOut('slow');
         }, 5000);
     });
     var KNAVID = "<?= $KNAVID ?>";
     var KFORMID = "<?= $KFORMID ?>";
 </script>
 <?= include_formjs(); ?>
 </body>

 </html>