<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Bootstrap Validator -->
<script src="dist/js/bootstrapValidator.min.js"></script>

<!-- Select2 Products add page only-->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- bootstrap datepicker pages (add purcahses) only-->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- DataTables products page only -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>

<!-- List products page script -->
<script>
  $(function () {
    /*$('#example1').DataTable()*/
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'pageLength'  : 10, 
      'lengthMenu': [[5,10, 25, 50,100, -1], [5,10, 25, 50,100, "All"]],
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
    })
  })
</script>

<!-- List products page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
  })
</script>

<!-- Add purchase page script -->
<script>
  $(function () {
	//Date picker
	$('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
	  autoclose: true
	})
  })
</script>

<script>
var site_url = "<?php echo getServerURL(); ?>";
</script>