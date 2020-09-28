<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() . 'assets/jqueryUi/jquery-ui.js' ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#list-petugas').hide();
        tampil_data();
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
        var tb = $("#tblperiksapkb").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#tblperiksapkb_filter input')
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
                "url": "<?php echo base_url() . 'index.php/Pkb/get_json' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idpkb",
                    "orderable": false
                },
                {
                    "data": "tanggal"
                },
                {
                    "data": "tagsapi"
                },
                {
                    "data": "hasil"
                },
                {
                    "data": "nama"
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

        function tampil_data() {
            $.ajax({
                url: "<?= site_url('/Pkb/get_data') ?>",
                method: 'post',
                async: false,
                dataType: 'json',
                success: function(e) {
                    var html = '';
                    for (var i = 0; i < e.length; i++) {
                        var no = i + 1;
                        var status = (e[i].status_ternak < 1) ? "belum diperiksa" : "sudah diperiksa";
                        html += '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + e[i].tagsapi + '</td>' +
                            '<td>' + e[i].namasapi + '</td>' +
                            '<td>' + e[i].ibke + '</td>' +
                            '<td>' + status + '</td>' +
                            '<td><button class="btn-periksa btn btn-success btn-sm" data-idib="' + e[i].idib + '" data-idsapi="' + e[i].kdsapi + '" data-namasapi="' + e[i].namasapi + '" data-tglib="' + e[i].tanggal + '" data-tglakhir="' + e[i].tglakhir + '"><i class="fas fa-eye"></i> Periksa</button></td>' +
                            '</tr>';
                    }
                    $('#tbl-pkb-body').html(html);
                    $('#tblpkb').DataTable();
                }
            });
        }
        $('#tblpkb').on('click', '.btn-periksa', function() {
            var idib = $(this).data('idib');
            var idsapi = $(this).data('idsapi');
            var namasapi = $(this).data('namasapi');
            var tglib = $(this).data('tglib');
            var tglakhir = $(this).data('tglakhir');
            $('#PeriksaData').modal('show');
            $('[name="idib"]').val(idib);
            $('[name="idsapi"]').val(idsapi);
            $('[name="namasapi"]').val(namasapi);

            var dateFormat = "DD-MM-YYYY";
            var MinDate = new Date(tglib);
            var MaxDate = new Date(tglakhir);

            dateMin = moment(MinDate, dateFormat);
            dateMax = moment(MaxDate, dateFormat);
            $('#tglform').datetimepicker({
                icons: {
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: dateFormat,
                minDate: dateMin,
                useCurrent: false
            });
        });

        const flashData = $('.flashdata').data('flashdata');
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
        }
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

    });
</script>
</body>

</html>