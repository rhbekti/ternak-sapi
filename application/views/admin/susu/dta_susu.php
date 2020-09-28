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
        var t = $("#tblsusu").dataTable({
            dom: '<"top"if>rt<"bottom"p>',
            initComplete: function() {
                var api = this.api();
                $('#tblsusu_filter input')
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
                "url": "<?php echo base_url() . 'index.php/Susu/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idpengukuran",
                    "orderable": false
                },
                {
                    "data": "tanggal"
                },
                {
<<<<<<< HEAD
                    "data": "tagsapi"
=======
                    "data": "namasapi"
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
                },
                {
                    "data": "namakandang"
                },
                {
                    "data": "pagi"
                },
                {
                    "data": "sore"
                },
                {
                    "data": "edit"
                },
                {
                    "data": "hapus"
                }
            ],
            order: [
<<<<<<< HEAD
                [0, 'desc']
=======
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
        var rh = $("#tblsapi").dataTable({
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
                    "data": "namasapi"
                },
                {
                    "data": "namapeternakan"
                },
                {
                    "data": "namakandang"
                },
                {
                    "data": "tambah"
                }
            ],
            order: [
                [0, 'asc']
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
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
        $('#tblsusu').on('click', '#btnhapus', function() {
            var id = $(this).data('idpengukuran');
            $('#Modalhapus').modal('show');
            $('[name="idpengukuran"]').val(id);
        });
<<<<<<< HEAD
        // tombol hapus
=======
        // tombol edit
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
        $('#tblsusu').on('click', '#btnedit', function() {
            var id = $(this).data('idpengukuran');
            $('#Modalhapus').modal('show');
            $('[name="idpengukuran"]').val(id);
        });
<<<<<<< HEAD
        // tombol edit
        $('#tblsusu').on('click', '.btn-edit', function() {
            var idpengukuran = $(this).data('idpengukuran');
            var tagsapi = $(this).data('tagsapi');
            var idsapi = $(this).data('idsapi');
            var idkandang = $(this).data('idkandang');
            var xlaktasi = $(this).data('xlaktasi');
            var tanggal = $(this).data('tglsusu');
            var pagi = $(this).data('pagi');
            var sore = $(this).data('sore');
            $('#ModalEdit').modal('show');
            $('[name="idpengukuran"]').val(idpengukuran);
            $('[name="idsapi_edit"]').val(idsapi);
            $('[name="kandang_edit"]').val(idkandang);
            $('[name="tagsapi_edit"]').val(tagsapi);
            $('[name="tanggal_edit"]').val(tanggal);
            $('[name="xlaktasi_edit"]').val(xlaktasi);
            $('[name="pagi_edit"]').val(pagi);
            $('[name="sore_edit"]').val(sore);
        });
        $('#tagsapi').on('keyup', function() {
            var tag = $('#tagsapi').val();
            if (tag !== '') {
                var data = {
                    tag: tag
                }
                $.ajax({
                    url: "<?= site_url('/Sapi/valid_tag'); ?>",
                    method: 'post',
                    async: true,
                    data: data,
                    success: function(respon) {
                        console.log(respon);
                        var r = JSON.parse(respon);
                        if (r.length == '') {
                            $('#validasi_tag').html('data tidak ditemukan');
                        } else {
                            var i = 0;
                            var tgl;
                            var kandang;
                            var idsapi;
                            for (i; i < r.length; i++) {
                                tgl = r[0].tglakhir;
                                kandang = r[0].idkandang;
                                idsapi = r[0].idsapi;
                            }
                            // mengatur range tanggal
                            var dateFormat = "DD-MM-YYYY";
                            var MinDate = tgl;

                            dateMin = moment(MinDate, dateFormat);

                            $("#tglsusu").datetimepicker({
                                format: dateFormat,
                                minDate: dateMin,
                            });
                            $('[name="kandang"]').val(kandang);
                            $('[name="idsapi"]').val(idsapi);
                            $('#validasi_tag').html('');
                        }
                    }
                });
            }
        });
        // membersihkan form jika batal
        $('.btn-tutup').on('click', function() {
            $('[name="tanggal"]').val('');
            $('[name="tagsapi"]').val('');
            $('[name="xlaktasi"]').val('');
            $('[name="pagi"]').val('');
            $('[name="sore"]').val('');
            $('[name="idkandang"]').val('');
        });

        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
=======
        // tombol pilih
        $('#tblsapi').on('click', '#pilihternak', function() {
            var idsapi = $(this).data('idsapi');
            var nmsapi = $(this).data('nmsapi');
            var idkandang = $(this).data('idkandang');
            var nmkandang = $(this).data('nmkandang');
            var idpeternakan = $(this).data('idpeternakan');
            var nmpeternakan = $(this).data('namapeternakan');
            $('#view_ternak').modal('hide');
            $('[name="idsapi"]').val(idsapi);
            $('[name="nmsapi"]').val(nmsapi);
            $('[name="idkandang"]').val(idkandang);
            $('[name="nmkandang"]').val(nmkandang);
            $('[name="idpeternakan"]').val(idpeternakan);
            $('[name="namapeternakan"]').val(nmpeternakan);
        });
        //  sweet alert
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
<<<<<<< HEAD
=======

        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
        if (flashData) {
            Toast.fire({
                type: 'success',
                title: flashData
<<<<<<< HEAD
            })
        }
=======
            });
        }

>>>>>>> b2581427159ddf2fd76e4848105359c214c04a42
    });
</script>
</body>

</html>