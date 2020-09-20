<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() . 'assets/jqueryUi/jquery-ui.js' ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        tampil_terjadwal();

        function tampil_terjadwal() {
            $.ajax({
                url: "<?= site_url('/Pengeringan/get_data'); ?>",
                method: 'post',
                async: false,
                dataType: 'json',
                success: function(r) {
                    console.log(r);
                    var html = '';
                    for (let i = 0; i < r.length; i++) {
                        let no = i + 1;
                        html += '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + r[i].tagsapi + '</td>' +
                            '<td>' + r[i].namasapi + '</td>' +
                            '<td><button type="button" class="btn btn-sm btn-success" data-idsapi="' + r[i].idsapi + '" data-toggle="modal" data-target="#aturpengeringan">Mulai</td>' +
                            '</tr>';
                    }
                    $('#tbl-pkb').html(html);
                    $('#tblpkb').DataTable();
                }
            });
        }
    });
</script>
</body>

</html>