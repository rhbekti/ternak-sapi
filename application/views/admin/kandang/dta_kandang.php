<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() . 'assets/jqueryUi/jquery-ui.js' ?>" type="text/javascript"></script>
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
        var t = $("#tblkandang").dataTable({
            dom: '<"top"if>rt<"bottom"p>',
            initComplete: function() {
                var api = this.api();
                $('#tblkandang_filter input')
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
                "url": "<?php echo base_url() . 'index.php/kandang/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idkandang",
                    "orderable": false
                },
                {
                    "data": "namakandang"
                },
                {
                    "data": "lokasikandang"
                },
                {
                    "data": "kapasitas"
                },
                {
                    "data": "namapeternakan"
                },
                {
                    "data": "edit"
                },
                {
                    "data": "hapus"
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
        var rh = $("#tblpeternakan").dataTable({
            dom: '<"top"if>rt<"bottom"p>',
            initComplete: function() {
                var api = this.api();
                $('#tblpeternakan_filter input')
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
                "url": "<?php echo base_url() . 'index.php/peternakan/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "id_peternakan",
                    "orderable": false
                },
                {
                    "data": "namapeternakan"
                },
                {
                    "data": "alamat"
                },
                {
                    "data": "pilih"
                }
            ],
            order: [
                [0, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        // tombol pilih
        $('#tblpeternakan').on('click', '#pilihpeternakan', function() {
            var id = $(this).data('idpeternakan');
            var nama = $(this).data('namapeternakan');
            $('#view_peternakan').modal('hide');
            $('[name="peternakan"]').val(id);
            $('[name="namapeternakan"]').val(nama);
        });
        $('#tblkandang').on('click', '#editkandang', function() {
            var id = $(this).data('idkandang');
            var nama = $(this).data('namakandang');
            var lokasi = $(this).data('alamat');
            var kapasitas = $(this).data('kapasitas');
            var namapeternakan = $(this).data('namapeternakan');
            var peternakan = $(this).data('peternakan');
            $('#ModalEdit').modal('show');
            $('[name="idkandang"]').val(id);
            $('[name="namakandang"]').val(nama);
            $('[name="lokasikandang"]').val(lokasi);
            $('[name="kapasitas"]').val(kapasitas);
            $('[name="peternakan"]').val(peternakan);
            $('[name="namapeternakan"]').val(namapeternakan);
        });

        // tombol hapus
        $('#tblkandang').on('click', '#hapusdata', function() {
            var id = $(this).data('idkandang');
            $('#Modalhapus').modal('show');
            $('[name="idkandang"]').val(id);
        });
<<<<<<< HEAD

        const pesan = $('.pesanerror').data('pesanerror');
        if (pesan) {
            $('#tambahdata').modal('show');
        }
        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
=======
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
<<<<<<< HEAD
        if (flashData) {
            Toast.fire({
                type: 'success',
                title: ' Berhasil ' + flashData
            })
=======
        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
        if (flashData) {
            Toast.fire({
                type: 'success',
                title: flashData
            });
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
        }
    });
</script>
</body>

</html>