<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
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
        var t = $("#tblpeternakan").dataTable({
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
                    "data": "cetak"
                },
                {
                    "data": "nosiup"
                },
                {
                    "data": "namapeternakan"
                },
                {
                    "data": "alamat"
                },
                {
                    "data": "notelp"
                },
                {
                    "data": "namapeternak"
                },
                {
                    "data": "nmkec"
                },
                {
                    "data": "nmkab"
                },
                {
                    "data": "nmpropinsi"
                },
                {
                    "data": "edit"
                },
                {
                    "data": "hapus"
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
        // tombol hapus
        $('#tblpeternakan').on('click', '#hapusdata', function() {
            var id = $(this).data('idpeternakan');
            $('#Modalhapus').modal('show');
            $('[name="idpeternakan"]').val(id);
        });


        //fungsi select berhubung
        $('#propinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: '<?= site_url('/wilayah/get_kab'); ?>',
                method: 'post',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].kodekabupaten + '">' + data[i].namakabupaten + '</option>';
                    }
                    $('#kabupaten').html(html);
                }
            });
            var pro = $('#propinsi').val();
            $.ajax({
                url: '<?= site_url('/wilayah/get_kec'); ?>',
                method: 'post',
                data: {
                    pro: pro
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].kodekecamatan + '">' + data[i].namakecamatan + '</option>';
                    }
                    $('#kecamatan').html(html);
                }
            });
        });
        // fungsi autocomplete kelompok
        $("#kelompok").autocomplete({
            source: "<?php echo site_url('peternakan/get_auto'); ?>",
            select: function(event, ui) {
                $('#kelompok').val(ui.item.label);
                $('[name="kodekelompok"]').val(ui.item.kode);
            }
        });
        // fungsi autocomplete kelompok
        $("#koperasi").autocomplete({
            source: "<?php echo site_url('peternakan/get_koperasi'); ?>",
            select: function(event, ui) {
                $('#koperasi').val(ui.item.label);
                $('[name="kodekoperasi"]').val(ui.item.kode);
            }
        });
        //fungsi select berhubung
        $('#kabupaten').change(function() {
            var pro = $('#propinsi').val();
            var kab = $(this).val();
            $.ajax({
                url: '<?= site_url('/wilayah/get_kechange'); ?>',
                method: 'post',
                data: {
                    pro,
                    kab: pro,
                    kab
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].kodekecamatan + '">' + data[i].namakecamatan + '</option>';
                    }
                    $('#kecamatan').html(html);
                }
            });
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


        //sweet alert
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
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