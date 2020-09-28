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
        var t = $("#tblsapi").dataTable({
            dom: '<"top"if>rt<"bottom"p>',
            initComplete: function() {
                var api = this.api();
                $('#tblsapi_filter input')
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
                "url": "<?php echo base_url() . 'index.php/Sapi/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idsapi",
                    "orderable": false
                },
                {
                    "data": "tagsapi"
                },
                {
                    "data": "namasapi"
                },
                {
                    "data": "kelamin"
                },
                {
                    "data": "tipesapi"
                },
                {
                    "data": "nama_bangsa"
                },
                {
                    "data": "namapeternakan"
                },
                {
                    "data": "status"
                },
                {
                    "data": "edit"
                },
                {
                    "data": "hapus"
<<<<<<< HEAD
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
        var kd = $("#tblkandang").dataTable({
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
                    "data": "pilih"
                },
                {
                    "data": "namakandang"
                },
                {
                    "data": "lokasikandang"
                },
                {
                    "data": "namapeternakan"
=======
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
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
<<<<<<< HEAD
=======
        var kd = $("#tblkandang").dataTable({
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
                    "data": "pilih"
                },
                {
                    "data": "namakandang"
                },
                {
                    "data": "lokasikandang"
                },
                {
                    "data": "namapeternakan"
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
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
        // tombol pilih
        $('#tblkandang').on('click', '#pilihkandang', function() {
            var idkandang = $(this).data('idkandang');
            var nmkandang = $(this).data('nmkandang');
            var idpeternakan = $(this).data('idpeternakan');
            var nmpeternakan = $(this).data('nmpeternakan');
            $('#view_ternak').modal('hide');
            $('[name="idkandang"]').val(idkandang);
            $('[name="namakandang"]').val(nmkandang);
            $('[name="idpeternakan"]').val(idpeternakan);
            $('[name="namapeternakan"]').val(nmpeternakan);
        });
        // tombol hapus
        $('#tblsapi').on('click', '#btnHapus', function() {
            var id = $(this).data('idsapi');
            $('#Modalhapus').modal('show');
            $('[name="idsapi"]').val(id);
        });

        $('#tgllahirform').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: "DD-MM-YYYY",
            useCurrent: false
        });
        $('#waktulahir').datetimepicker({
            format: 'HH:mm:ss'
        });
        $("#peternakan").autocomplete({
            source: "<?php echo site_url('peternakan/get_peternakan'); ?>",
            select: function(event, ui) {
                $('#peternakan').val(ui.item.label);
                $('[name="idpeternakan"]').val(ui.item.idpt);
            }
        });
        $("#kandang").autocomplete({
            source: "<?php echo site_url('kandang/get_kandang'); ?>",
            select: function(event, ui) {
                $('#kandang').val(ui.item.label);
                $('[name="idkandang"]').val(ui.item.idkd);
            }
        });
        $('#btntanggal').click(function() {
            var tanggal = $('#tgllahir').val();
            var waktu = $('#waktulahirternak').val();
            $('#view_tanggal').modal('hide');
            $('#tgllahirternak').val(tanggal);
            $('#waktulahirsapi').val(tanggal);
            $('[name="tgllahirternak"]').val(tanggal);
            $('[name="waktulahirsapi"]').val(waktu);
        });
        //  sweet alert
<<<<<<< HEAD
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