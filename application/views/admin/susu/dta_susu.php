<!-- DataTables -->
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $('document').ready(function(){
        $('#tblsusu').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });

         // fungsi autocomplete kelompok
         $( "#namasapi" ).autocomplete({
                  source: "<?php echo site_url('/Susu/get_auto');?>",
                  select: function (event, ui) {
                    $('#namasapi').val(ui.item.label);
                    $('[name="kodesapi"]').val(ui.item.kode); 
                     }
                });
    });
</script>
</body>
</html>