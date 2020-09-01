<!-- DataTables -->
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url().'assets/jqueryUi/jquery-ui.js'?>" type="text/javascript"></script>
<!-- <script>
    // $('#tblpkb').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": true,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // });
    let dataResult = '';
    $.ajax({
        url : "<?php echo base_url().'index.php/Pkb/get_data'?>",
        method : 'post',
        dataType : 'json',
        success : function(respon)
        {
            var data = respon.data;
           $.each(data,function(i,item){
               $('#tbltampil').append(`
               <tr>
               <td>`+item.idpkb+`</td>
               <td>`+item.tanggal+`</td>
               <td>`+item.namasapi+`</td>         
               <td>`+item.hasil+`</td>
               <td>`+item.st+`</td>
               <td>`+item.keterangan+`</td>
               <td>`+item.petugas+`</td>`);         
           });
        }
    });
</script> -->
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
                    var rh = $("#tblpkb").dataTable({
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
                    ajax: { "url": "<?php echo base_url().'index.php/Pkb/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "idpkb",
                            "orderable": false
                        },
                        {"data" : "tanggal"},
                        {"data" : "namasapi"},
                        {"data" : "hasil"},
                        {"data" : "st"},
                        {"data" : "keterangan"},
                        {"data" : "petugas"},
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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Reproduksi_IB/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "idib",
                            "orderable": false
                        },
                        {"data": "namasapi"},
                        {"data": "namasemen"},
                        {"data": "ibke"},
                        {"data": "tambah"}
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
                $('#tblpkb').on('click','.btn-hapus',function(){
                    var id = $(this).data('idpkb');
                    $('#hapusData').modal('show');
                    $('[name="idpkb"]').val(id);
                });
                $('#tblrepib').on('click','.btn-tambah',function(){
                    var idib = $(this).data('idib');
                    var id = $(this).data('idsapi');
                    var namasapi = $(this).data('namasapi');
                    $('[name="idsapi"]').val(id);
                    $('[name="namasapi"]').val(namasapi);
                    $('[name="idib"]').val(idib);
                    $('#view_ternak').modal('hide');
                });
                const flashData = $('.flashdata').data('flashdata');
                const errorData = $('.flashdata').data('pesan');
                if(flashData){
                    Swal.fire({
                        title : 'Data Ternak',
                        text : flashData,
                        type: 'success'
                    });   
                }
                if(errorData){
                    Swal.fire({
                        title : 'Data Ternak',
                        text : errorData,
                        type: 'error',
                        showConfirmButton: false,
                        timer : 3000
                    });  
                }
                $('#tglform').datetimepicker({
                    icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                    },
                    format : "DD-MM-YYYY",
                    useCurrent : false
                });
                 // fungsi autocomplete petugas
                 $('#petugas').autocomplete({
                  source: "<?php echo site_url('petugas/get_auto');?>",
                  select: function (event, ui) {
                    $('#petugas').val(ui.item.label);
                    $('[name="idpetugas"]').val(ui.item.kode); 
                     }
                });
                   
    });
</script>
</body>
</html>