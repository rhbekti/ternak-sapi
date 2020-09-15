<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
        $('#list-petugas').hide();
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
        var t = $("#tblrepib").dataTable({
            dom: '<"top"if>rt<"bottom"p>',
            initComplete: function() {
                var api = this.api();
                $('#tblrepib_filter input')
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
                "url": "<?php echo base_url() . 'index.php/Reproduksi_ET/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idtransfer",
                    "orderable": false
                },
                {
                    "data": "tanggal"
                },
                {
                    "data": "betina"
                },
                {
                    "data": "idsapidonor"
                },
                {
                    "data": "keterangan"
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
        // menampilkan data sapi jantan
        $.ajax({
            url: "<?= site_url('/Sapi/get_jantan'); ?>",
            method: "post",
            async: false,
            success: function(data) {
                r = JSON.parse(data);
                var html = '';
                var i;
                for (i = 0; i < r.length; i++) {
                    var no = i + 1;
                    html += '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + r[i].namasapi + '</td>' +
                        '<td>' + r[i].kelamin + '</td>' +
                        '<td>' + r[i].namapeternakan + '</td>' +
                        '<td><button class="btn-jantan btn btn-success" data-idsapi="' + r[i].kdsapi + '" data-namasapi="' + r[i].namasapi + '" data-idib="' + r[i].idib + '"><i class="fas fa-plus-circle"></i></button></td>' +
                        '</tr>';
                }
                $('#tabel-sapi-jantan').html(html);
                $('#tbljantan').DataTable();
            }
        });
        // menampilkan data sapi betina
        $.ajax({
            url: "<?= site_url('/Sapi/get_betina'); ?>",
            method: "post",
            async: false,
            success: function(data) {
                r = JSON.parse(data);
                var html = '';
                var i;
                for (i = 0; i < r.length; i++) {
                    var no = i + 1;
                    html += '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + r[i].namasapi + '</td>' +
                        '<td>' + r[i].kelamin + '</td>' +
                        '<td>' + r[i].namapeternakan + '</td>' +
                        '<td><button class="btn-tambah btn btn-success" data-idsapi="' + r[i].kdsapi + '" data-namasapi="' + r[i].namasapi + '" data-idib="' + r[i].idib + '"><i class="fas fa-plus-circle"></i></button></td>' +
                        '</tr>';
                }
                $('#tabel-sapi').html(html);
                $('#tblrepib').DataTable();
            }
        });
        $('#tblrepib').on('click','.btnHapus',function(){
            var id = $(this).data('idtransfer');
            $('#ModalHapus').modal('show');
            $('[name="idtransfer"]').val(id);
        });
        $('#ternak-jantan').on('click', function() {
            $('#Modalternakjantan').modal('show');
        });
        $('#ternak-betina').on('click', function() {
            $('#Modalternak').modal('show');
        });
        $('#tabel-sapi').on('click', '.btn-tambah', function() {
            var idsapi = $(this).data('idsapi');
            var nmsapi = $(this).data('namasapi');
            $('#Modalternak').modal('hide');
            $('[name="sapibetina"]').val(nmsapi);
            $('[name="idsapibetina"]').val(idsapi);
        });
        $('#tbljantan').on('click', '.btn-jantan', function() {
            var idsapi = $(this).data('idsapi');
            var nmsapi = $(this).data('namasapi');
            $('#Modalternakjantan').modal('hide');
            $('[name="sapijantan"]').val(nmsapi);
            $('[name="idsapijantan"]').val(idsapi);
        });
        $('#tglform').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: "DD-MM-YYYY",
            useCurrent: false
        });
       
        const flashData = $('.flashdata').data('flashdata');
        const errorData = $('.pesanerror').data('pesanerror');
        if (flashData) {
            Swal.fire({
                title: 'Data Ternak',
                text: flashData,
                type: 'success'
            });
        }
        if (errorData) {
            $('#ModalTambah').modal('show');
        }
    });
</script>
</body>

</html>