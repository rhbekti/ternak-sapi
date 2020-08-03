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
                var t = $("#tblkelompok").dataTable({
                    dom: '<"top"if>rt<"bottom"p>',
                    initComplete: function() {
                        var api = this.api();
                        $('#tblkelompok_filter input')
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
                    ajax: { "url": "<?php echo base_url().'index.php/Kelompok/get_data'?>", 
                            "type": "POST"},
                    columns: [
                        {
                            "data": "kodekelompok",
                            "orderable": false
                        },
                        {"data": "namakelompok"},
                        {"data": "alamatkelompok"},
                        {"data": "notelp"},
                        {"data": "kec"},
                        {"data": "kab"},
                        {"data": "propinsi"},
                        {"data": "edit"},
                        {"data": "hapus"}
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
                  $('#tblkelompok').on('click','#hapusdata',function(){
                    var id = $(this).data('kodekelompok');
                    $('#Modalhapus').modal('show');
                    $('[name="kodekelompok"]').val(id);
                });


                //fungsi select berhubung
                $('#propinsi').change(function(){
                    var id = $(this).val();
                    $.ajax({
                        url : '<?= site_url('/Kelompok/get_kab'); ?>',
                        method : 'post',
                        data : {id : id},
                        async : false,
                        dataType : 'json',
                        success : function(data){
                            var html = '';
                            var i;
                            for(i = 0;i < data.length;i++){
                                html += '<option value="'+data[i].kodekabupaten+'">'+data[i].namakabupaten+'</option>';
                            }
                            $('#kabupaten').html(html);
                        }
                    });
                    var pro = $('#propinsi').val();
                    $.ajax({
                        url : '<?= site_url('/Kelompok/get_kec'); ?>',
                        method : 'post',
                        data : {pro : pro},
                        async : false,
                        dataType : 'json',
                        success : function(data){
                            var html = '';
                            var i;
                            for(i = 0;i < data.length;i++){
                                html += '<option value="'+data[i].kodekecamatan+'">'+data[i].namakecamatan+'</option>';
                            }
                            $('#kecamatan').html(html);
                        }
                    });
                });
                //fungsi select berhubung
                $('#kabupaten').change(function(){
                    var pro = $('#propinsi').val();
                    var kab = $(this).val();
                    $.ajax({
                        url : '<?= site_url('/Kelompok/get_kechange');?>',
                        method : 'post',
                        data : {pro,kab : pro,kab},
                        async : false,
                        dataType : 'json',
                        success : function(data){
                            var html = '';
                            var i;
                            for(i = 0;i < data.length;i++){
                                html += '<option value="'+data[i].kodekecamatan+'">'+data[i].namakecamatan+'</option>';
                            }
                            $('#kecamatan').html(html);
                        }
                    });
                });
               
    
    });

    
</script>
</body>
</html>