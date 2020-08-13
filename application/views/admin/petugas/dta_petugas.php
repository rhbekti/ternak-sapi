<!-- DataTables -->
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function(){
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
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
                var t = $("#tblpetugas").dataTable({
                    dom: '<"top"if>rt<"bottom"p>',
                    initComplete: function() {
                        var api = this.api();
                        $('#tblpetugas_filter input')
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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Petugas/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "idpetugas",
                            "orderable": false
                        },
                        {"data": "nama"},
                        {"data": "jabatan"},
                        {"data": "nip"},
                        {"data": "edit"},
                        {"data": "hapus"}
                        // {"data": "editpass"}
                    ],
                    order: [[1, 'asc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });

                // tombol hapus
                $('#tblpetugas').on('click','#hapusData',function(){
                    var id = $(this).data('idpetugas');
                    $('#Modalhapus').modal('show');
                    $('[name="id"]').val(id);
                });
                $('#tblpetugas').on('click','#editData',function(){
                    var id = $(this).data('idpetugas');
                    var nama = $(this).data('nama');
                    var jabatan = $(this).data('jabatan');
                    var nip = $(this).data('nip');
                    $('#ModalEdit').modal('show');
                    $('[name="id"]').val(id);
                    $('[name="nama"]').val(nama);
                    $('[name="nip"]').val(nip);
                    $('[name="jabatan"]').val(jabatan);
                });
                const flashData = $('.flashdata').data('flashdata');
                if(flashData){
                    Swal.fire({
                        title : 'Data Ternak',
                        text : flashData,
                        type: 'success'
                    });   
                }
    
    
    });

    
</script>
</body>
</html>