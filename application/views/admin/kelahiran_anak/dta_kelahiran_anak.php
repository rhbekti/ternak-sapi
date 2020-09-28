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
                    "data": "namaanak"
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
        var rh = $("#tblanak").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#tblanak_filter input')
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
                "url": "<?php echo base_url() . 'index.php/Kelahiran_anak/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idkelahiran",
                    "orderable": false
                },
                {
                    "data": "tagsapi"
                },
                {
                    "data": "bobotlahir"
                },
                {
                    "data": "jeniskelamin"
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
        // var table = $("#tblkelahiran").dataTable({
        //     initComplete: function() {
        //         var api = this.api();
        //         $('#tblkelahiran_filter input')
        //             .off('.DT')
        //             .on('input.DT', function() {
        //                 api.search(this.value).draw();
        //             });
        //     },
        //     oLanguage: {
        //         sProcessing: "loading..."
        //     },
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         "url": "<?= site_url('/Kelahiran/get_data'); ?>",
        //         "type": "POST"
        //     },
        //     columns: [{
        //             "data": "idkelahiran",
        //             "orderable": false
        //         },
        //         {
        //             "data": "tanggal"
        //         },
        //         {
        //             "data": "tagsapi"
        //         },
        //         {
        //             "data": "namapeternakan"
        //         },
        //         {
        //             "data": "statuslahir"
        //         },
        //         {
        //             "data": "add"
        //         }
        //     ],
        //     order: [
        //         [1, 'asc']
        //     ],
        //     rowCallback: function(row, data, iDisplayIndex) {
        //         var info = this.fnPagingInfo();
        //         var page = info.iPage;
        //         var length = info.iLength;
        //         var index = page * length + (iDisplayIndex + 1);
        //         $('td:eq(0)', row).html(index);
        //     }

        // });
        get_data();

        function get_data() {
            $.ajax({
                url: "<?= site_url('/Kelahiran/get_data'); ?>",
                method: 'post',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var e = data.data;
                    var html = '';
                    for (var i = 0; i < e.length; i++) {
                        var no = i + 1;
                        var status = (e[i].status_ternak > 1) ? "belum ditambahkan" : "sudah ditambahkan";
                        html += '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + e[i].tanggal + '</td>' +
                            '<td>' + e[i].tagsapi + '</td>' +
                            '<td>' + e[i].namapeternakan + '</td>' +
                            '<td>' + e[i].statuslahir + '</td>' +
                            '<td>' + status + '</td>' +
                            '<td><button class="btn-add btn btn-success btn-sm" data-idsapi="' + e[i].idsapi + '" data-status="' + e[i].statuslahir + '" data-idib="' + e[i].idib + '"><i class="fas fa-plus"></i></button></td>' +
                            '</tr>';
                    }
                    $('#tblkelahiranbody').html(html);
                    $('#tblkelahiran').DataTable();
                }
            })
        }
        $('#btn-tambah').on('click', function() {
            $('#tambahModal').modal('show');
        });
        $('#tblkelahiran').on('click', '.btn-add', function() {
            var idsapi = $(this).data('idsapi');
            var status = $(this).data('status');
            var idib = $(this).data('idib');
            $('#tambahModal').modal('hide');
            $('#inputModal').modal('show');
            $('[name="idsapi"]').val(idsapi);
            $('[name="status"]').val(status);
            $('[name="idib"]').val(idib);
        });
        const pesan = $('.pesanerror').data('pesanerror');
        if (pesan) {
            $('#tambahdata').modal('show');
        }
        //  sweet alert
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
    });
</script>
</body>

</html>