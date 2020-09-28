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
        var tb = $("#tblrepib").dataTable({
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
                "url": "<?php echo base_url() . 'index.php/Reproduksi_IB/get_data' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idib",
                    "orderable": false
                },
                {
                    "data": "tanggal"
                },
                {
                    "data": "namasapi"
                },
                {
                    "data": "namasemen"
                },
                {
                    "data": "ibke"
                },
                {
                    "data": "intensitas"
                },
                {
                    "data": "keterangan"
                },
                {
                    "data": "namapetugas"
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
        var rh = $("#tblsemen").dataTable({

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
                    "data": "pilih_semen"
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
        $('#pilihsemen').on('click', function() {
            $('#ModalSemen').modal('show');
        });
        $('#sapibetina').on('keyup', function() {
            var tag = $('#sapibetina').val();
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
                        var r = JSON.parse(respon);
                        if (r.length == '') {
                            $('#validasi_tag').html('data tidak ditemukan');
                        } else {
                            $('#validasi_tag').html('');
                        }
                    }
                });
            }
        });
        $('#tblsemen').on('click', '.btn-semen', function() {
            var idsemen = $(this).data('kodesemen');
            var nmsemen = $(this).data('namasemen');
            $('#ModalSemen').modal('hide');
            $('[name="kodesemen"]').val(idsemen);
            $('[name="namasemen"]').val(nmsemen);
        });
        $('#tblrepib').on('click', '#btnHapus', function() {
            var idib = $(this).data('idib');
            $('#hapusData').modal('show');
            $('[name="idib"]').val(idib);
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
        $('#petugas').on('keyup', function() {
            if ($('#petugas').val() !== '') {
                $('#list-petugas').show();
                var data = {
                    nmpetugas: $('#petugas').val()
                };
                $.ajax({
                    url: "<?= site_url('/Petugas/get_petugas'); ?>",
                    method: 'post',
                    data: data,
                    success: function(respon) {
                        r = JSON.parse(respon);
                        if (r.length == '') {
                            $('#list-petugas').hide();
                        } else {
                            var i;
                            var html = '';
                            for (i = 0; i < r.length; i++) {
                                html += '<option class="nm" data-nama="' + r[i].nama + '" value="' + r[i].idpetugas + '">' + r[i].nama + '</option>';
                            }
                            $('#list-petugas').html(html);
                        }
                    }
                });
            } else {
                $('#list-petugas').hide();
            }
        });
        $('#list-petugas').on('click', '.nm', function() {
            var idpetugas = $(this).val();
            var nmpetugas = $(this).data('nama');
            $('#list-petugas').hide();
            $('#petugas').val(nmpetugas);
            $('#idpetugas').val(idpetugas);
        });
        const pesan = $('.pesanerror').data('pesanerror');
        if (pesan) {
            $('#ModalTambah').modal('show');
        }
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
<<<<<<< HEAD
        const errorData = $('.flashdata').data('pesan');
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
        if (errorData) {
            Toast.fire({
                type: 'success',
                title: ' Gagal ' + flashData
            })
=======
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