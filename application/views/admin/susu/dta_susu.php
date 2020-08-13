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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Susu/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "id_susu",
                            "orderable": false
                        },
                        {"data":"tgl_produksi"},
                        {"data":"namapeternakan"},
                        {"data": "namasapi"},
                        {"data":"namakandang"},
                        {"data" : "pagi"},
                        {"data" : "sore"},
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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Sapi/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "idsapi",
                            "orderable": false
                        },
                        {"data" : "namasapi"},
                        {"data" : "namapeternakan"},
                        {"data" : "namakandang"},
                        {"data" : "tambah"}
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
                  $('#tblsusu').on('click','#btnhapus',function(){
                    var id = $(this).data('idsusu');
                    $('#Modalhapus').modal('show');
                    $('[name="idsusu"]').val(id);
                });
                  // tombol edit
                  $('#tblsusu').on('click','#btnedit',function(){
                    var id = $(this).data('idsusu');
                    $('#Modalhapus').modal('show');
                    $('[name="idsusu"]').val(id);
                });
                // tombol pilih
                $('#tblsapi').on('click','#pilihternak',function(){
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
                const flashData = $('.flashdata').data('flashdata');
                if(flashData){
                    Swal.fire({
                        title : 'Data Produksi',
                        text : flashData,
                        type: 'success'
                    });   
                }
               
     });
</script>
</body>
</html>