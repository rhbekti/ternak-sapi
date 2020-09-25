<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() . 'assets/jqueryUi/jquery-ui.js' ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        tampil_terjadwal();
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        var t = $("#tblpengeringan").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#tblpengeringan_filter input')
                    .off('.DT')
                    // melakukan proses ketika ada input otomatis
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: "Sedang Mengambil Data"
            },
            processing: true,
            serverSide: true,
            searching: true,
            orderable: false,
            ajax: {
                "url": "<?php echo base_url() . 'index.php/Pengeringan/get_pengeringan' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idpengeringan",
                    "orderable": false
                },
                {
                    "data": "tagsapi"
                },
                {
                    "data": "tglmulai"
                },
                {
                    "data": "tglakhir"
                }
            ],
            order: [
                [1, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

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
                        var status = (r[i].status > 1) ? "sedang pengeringan" : "belum pengeringan";
                        html += '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + r[i].tagsapi + '</td>' +
                            '<td>' + r[i].namasapi + '</td>' +
                            '<td>' + status + '</td>' +
                            '<td><form action="<?= site_url('/Pengeringan/add'); ?>" method="post"><input type="hidden" name="status" value="' + r[i].status + '"><input type="hidden" name="idpkb" value="' + r[i].idpkb + '"><input type="hidden" name="idsapi" value="' + r[i].idsapi + '" required><input type="hidden" name="tanggal" value="' + r[i].tanggal + '" required><input type="hidden" name="idib" value="' + r[i].idib + '"><button type="submit" class="btn btn-sm btn-success btn-pengeringan">Mulai</button></form></td>' +
                            '</tr>';
                    }
                    $('#tbl-pkb').html(html);
                    $('#tblpkb').DataTable();
                }
            });
        }
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        const pesan = $('.pesanerror').data('pesanerror');
        if (pesan) {
            $('#tambahdata').modal('show');
        }
        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
        if (flashData) {
            Toast.fire({
                type: 'success',
                title: flashData
            });
        }
    });
</script>
</body>

</html>