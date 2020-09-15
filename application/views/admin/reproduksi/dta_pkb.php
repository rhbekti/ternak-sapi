<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() . 'assets/jqueryUi/jquery-ui.js' ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#list-petugas').hide();
        tampil_data();

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
                            '<td><button class="btn-periksa btn btn-success btn-sm" data-idib="' + e[i].idib + '" data-idsapi="' + e[i].idsapi + '" data-namasapi="' + e[i].namasapi + '" data-tglib="' + e[i].tanggal + '"><i class="fas fa-eye"></i> Periksa</button></td>' +
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
            $('#PeriksaData').modal('show');
            $('[name="idib"]').val(idib);
            $('[name="idsapi"]').val(idsapi);
            $('[name="namasapi"]').val(namasapi);


            var dateFormat = "DD-MM-YYYY";
            var MinDate = new Date(tglib);

            dateMin = moment(MinDate, dateFormat);
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
        if (flashData) {
            Swal.fire({
                title: 'Data Ternak',
                text: flashData,
                type: 'success'
            });
        }
        if (errorData) {
            Swal.fire({
                title: 'Data Ternak',
                text: errorData,
                type: 'error',
                showConfirmButton: false,
                timer: 3000
            });
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