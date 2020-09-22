<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() . 'assets/jqueryUi/jquery-ui.js' ?>" type="text/javascript"></script>
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

        var table = $("#tblkelahiran").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#tblkelahiran_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?= site_url('/Kelahiran/get_data'); ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "idkelahiran",
                    "orderable": false
                },
                {
                    "data": "tanggal"
                },
                {
                    "data": "namasapi"
                },
                {
                    "data": "xlaktasi"
                },
                {
                    "data": "namapeternakan"
                },
                {
                    "data": "statuslahir"
                },
                {
                    "data": "keterangan"
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
        $.ajax({
            url: "<?= site_url('/Kelahiran/get_kelahiran'); ?>",
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
                        '<td>' + r[i].tagsapi + '</td>' +
                        '<td>' + r[i].namapeternakan + '</td>' +
                        '<td>' + r[i].idib + '</td>' +
                        '<td><button class="btn-tambah btn btn-success" data-idsapi="' + r[i].idsapi + '" data-tagsapi="' + r[i].tagsapi + '" data-idib="' + r[i].idib + '" data-idfarm="' + r[i].idfarm + '" data-idpkb="' + r[i].idpkb + '"><i class="fas fa-plus-circle"></i></button></td>' +
                        '</tr>';
                }
                $('#tabel-sapi').html(html);
                $('#tblrepib').DataTable();

            }
        })
        // end setup datatables
        $('#tblrepib').on('click', '.btn-tambah', function() {
            var idsapi = $(this).data('idsapi');
            var tagsapi = $(this).data('tagsapi');
            var idib = $(this).data('idib');
            var idfarm = $(this).data('idfarm');
            var idpkb = $(this).data('idpkb');
            $('#Modalternak').modal('hide');
            $('#tambahData').show();
            $('[name="idsapi"]').val(idsapi);
            $('[name="namasapi"]').val(tagsapi);
            $('[name="idib"]').val(idib);
            $('[name="idfarm"]').val(idfarm);
            $('[name="idpkb"]').val(idpkb);
        });
        $('#tblkelahiran').on('click', '.btn-hapus', function() {
            let id = $(this).data('idkelahiran');
            $('#Modalhapus').modal('show');
            $('[name="idkelahiran"]').val(id);
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
                        var i;
                        var html = '';
                        for (i = 0; i < r.length; i++) {
                            html += '<option class="nm" data-nama="' + r[i].nama + '" value="' + r[i].idpetugas + '">' + r[i].nama + '</option>';
                        }
                        $('#list-petugas').html(html);
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
        $('#pilihternak').on('click', function() {
            $('#tambahData').slideUp(1000, function() {
                $('#tambahData').hide();
                $('#btl').show();
                $('#btl1').hide();
                $('#Modalternak').modal('show');
            });
        });
        $('#editpilihan').on('click', function() {
            $('#btl').hide();
            $('#Modalternak').modal('show');
        });
        $('#btl').on('click', function() {
            $('#tambahData').slideDown(1000, function() {
                $('#tambahData').show();
            });
        });
        $('#btl1').on('click', function() {
            $('#EditData').slideDown(1000, function() {
                $('#EditData').show();
            });
        });
        //  sweet alert
        const flashData = $('.flashdata').data('flashdata');
        if (flashData) {
            Swal.fire({
                title: 'Data Kelahiran',
                text: flashData,
                type: 'success'
            });
        }

        function submit_data() {
            var data = {
                tanggal: $('[name="tanggal"]').val(),
                idsapi: $('[name="idsapi"]').val(),
                xlaktasi: $('[name="xlaktasi"]').val(),
                petugas: $('[name="idpetugas"]').val()
            };
            $.ajax({
                url: "<?= site_url('/Kelahiran/tambah_data') ?>",
                method: 'post',
                data: data,
                async: true,
                dataType: 'json',
                cache: false,
                success: function(respon) {
                    if (respon.success == true) {
                        load_data();
                    } else {
                        alert('error');
                    }
                }
            });
        }
        $('#tblkelahiran').on('click', '.btn-edit', function() {
            var idkelahiran = $(this).data('idkelahiran');
            var tanggal = $(this).data('tanggal');
            var nmsapi = $(this).data('namsapi');
            var keterangan = $(this).data('keterangan');
            var idsapi = $(this).data('idsapi');
            var xlaktasi = $(this).data('xlaktasi');
            var statuslahir = $(this).data('statuslahir');
            var idfarm = $(this).data('idfarm');
            var idpetugas = $(this).data('idpetugas');
            $('#EditData').modal('show');
            $('[name="idkelahiranedit"]').val(idkelahiran);
            $('[name="tanggaledit"]').val(tanggal);
            $('[name="namasapiedit"]').val(nmsapi);
            $('[name="keteranganedit"]').val(keterangan);
            $('[name="xlaktasiedit"]').val(xlaktasi);
            $('[name="statuslahiredit"]').val(statuslahir);
            $('[name="idfarm"]').val(idfarm);
            $('[name="idpetugasedit"]').val(idpetugas);
            // $('[name="namapetugasedit"]').val(nmpetugas);
        });
    });
</script>
</body>

</html>