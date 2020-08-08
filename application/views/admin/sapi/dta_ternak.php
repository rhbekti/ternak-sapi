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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Sapi/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "idsapi",
                            "orderable": false
                        },
                        {"data" : "tagsapi"},
                        {"data" : "namasapi"},
                        {"data" : "kelamin"},
                        {"data" : "nama_bangsa"},
                        {"data" : "idfarm"},
                        {"data" : "status"},
                        {"data" : "edit"},
                        {"data" : "hapus"}
                    ],
                    order: [[0, 'asc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
                  // tombol hapus
                  $('#tblsapi').on('click','#btnHapus',function(){
                    var id = $(this).data('idsapi');
                    $('#Modalhapus').modal('show');
                    $('[name="idsapi"]').val(id);
                });
    });
</script>
</body>
</html>