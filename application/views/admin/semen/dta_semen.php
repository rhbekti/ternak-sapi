<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
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
        var t = $("#tblsemen").dataTable({
            dom: '<"top"if>rt<"bottom"p>',
            initComplete: function() {
                var api = this.api();
                $('#tblsemen_filter input')
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
                "url": "<?php echo base_url() . 'index.php/Semen/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "kodesemen",
                    "orderable": false
                },
                {
                    "data": "kodesemen"
                },
                {
                    "data": "namasemen"
                },
                {
                    "data": "edit"
                },
                {
                    "data": "hapus"
                }
                // {"data": "editpass"}
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
        const pesan = $('.pesanerror').data('pesanerror');
        if (pesan) {
            $('#tambahsemen').modal('show');
        }
        const flashData = $('.flashdata').data('flashdata');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        if (flashData) {
            Toast.fire({
                type: 'success',
                title: ' Berhasil ' + flashData
            })
        }
        $('#tblsemen').on('click', '#btnEdit', function() {
            var kode = $(this).data('kodesemen');
            var nama = $(this).data('namasemen');
            $('#editsemen').modal('show');
            $('[name="kodesemen"]').val(kode);
            $('[name="kode"]').val(kode);
            $('[name="namasemen"]').val(nama);
        });
        $('#tblsemen').on('click', '#btnHapus', function() {
            var kode = $(this).data('kodesemen');
            $('#hapussemen').modal('show');
            $('[name="kodesemen"]').val(kode);
        });


    });
</script>
</body>

</html>