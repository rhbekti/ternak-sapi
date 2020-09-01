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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Reproduksi_IB/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "idib",
                            "orderable": false
                        },
                        {"data": "tanggal"},
                        {"data": "namasapi"},
                        {"data": "namasemen"},
                        {"data": "ibke"},
                        {"data": "intensitas"},
                        {"data": "keterangan"},
                        {"data": "namapetugas"},
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
                $('#tblrepib').on('click','#btnHapus',function(){
                    var idib = $(this).data('idib');
                    $('#hapusData').modal('show');
                    $('[name="idib"]').val(idib);
                });
                const flashData = $('.flashdata').data('flashdata');
                const errorData = $('.flashdata').data('pesan');
                if(flashData){
                    Swal.fire({
                        title : 'Data Ternak',
                        text : flashData,
                        type: 'success',
                        timer : 3000
                    });   
                }
                if(errorData){
                    Swal.fire({
                        title : 'Data Ternak',
                        text : errorData,
                        type: 'error',
                        timer : 3000
                    });  
                }
    });
</script>
</body>
</html>