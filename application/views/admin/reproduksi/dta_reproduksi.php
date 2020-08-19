<!-- DataTables -->
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url(); ?>assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url().'assets/jqueryUi/jquery-ui.js'?>" type="text/javascript"></script>
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
                        {"data" : "kelamin"},
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
                    var jt = $("#tblsapijantan").dataTable({
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
                        {"data" : "kelamin"},
                        {"data" : "tambahjantan"}
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
                var t = $("#tblsemen").dataTable({
                    dom: '<"top"if>rt<"bottom"p>',
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
                    orderable : false,
                    ajax: { "url": "<?php echo base_url().'index.php/Semen/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "kodesemen",
                            "orderable": false
                        },
                        {"data": "kodesemen"},
                        {"data": "namasemen"},
                        {"data": "pilih_semen"}
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
                $('#tblsemen').on('click','#btnsemen',function(){
                    var kodesemen = $(this).data('kodesemen');
                    var namasemen = $(this).data('namasemen');
                    $('#view_semen').modal('hide');
                    $('[name="kodesemen"]').val(kodesemen);
                    $('[name="namasemen"]').val(namasemen);
                });
         // tombol pilih
                $('#tblsapi').on('click','#pilihternak',function(){
                   var idsapi = $(this).data('idsapi');
                   var nmsapi = $(this).data('nmsapi');
                   $('#view_ternak').modal('hide');
                   $('[name="idsapi"]').val(idsapi);
                   $('[name="namasapi"]').val(nmsapi);
                });
                $('#tblsapijantan').on('click','#pilihternakjantan',function(){
                   var idsapi = $(this).data('idsapi');
                   var nmsapi = $(this).data('nmsapi');
                   $('#view_ternak_jantan').modal('hide');
                   $('[name="idsapijantan"]').val(idsapi);
                   $('[name="namasapijantan"]').val(nmsapi);
                });
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
                $('#jenisreproduksi').on('change',function(){
                    var nilai = $('#jenisreproduksi').val();
                    if(nilai == 'IB'){
                        $('#kodejantan').html(`<div class="form-group">
                      <label for="kodesemen">Kode Semen</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="kodesemen" name="kodesemen" autocomplete="off">
                        <div class="input-group-append">
                          <span type="button" data-toggle="modal" data-target="#view_semen" class="input-group-text bg-primary" id="cari-semen"><i class="fas fa-search"></i></span>
                        </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <label for="namasemen">Nama Semen</label>
                      <input type="text" name="namasemen" id="namasemen" class="form-control" readonly>
                    </div>`);
                    $('#ibsapi').html(`<div class="form-group">
                      <label for="intensitas">Intensitas Birahi</label>
                      <input type="number" name="intensitas" id="intensitas" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="ibke">IB ke</label>
                      <input type="number" name="ibke" id="ibke" class="form-control">
                    </div>`);
                    }else{
                        $('#kodejantan').html(`<div class="form-group">
                        <label for="kodesemen">Nama Sapi Jantan</label>
                        <div class="input-group">
                            <input type="hidden" name="idsapijantan">
                            <input type="text" class="form-control" id="namasapijantan" name="namasapijantan" autocomplete="off">
                            <div class="input-group-append">
                            <span type="button" data-toggle="modal" data-target="#view_ternak_jantan" class="input-group-text bg-primary" id="cari-semen"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                        `);
                        $('#ibsapi').html('');
                    }
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
                        type: 'error'
                    });  
                }
    });
</script>
</body>
</html>