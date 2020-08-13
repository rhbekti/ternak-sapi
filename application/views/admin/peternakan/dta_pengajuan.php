<script src="<?php echo base_url().'assets/jqueryUi/jquery-ui.js'?>" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#listkelompok").hide();
                //fungsi select berhubung
                $('#propinsi').change(function(){
                    var id = $(this).val();
                    $.ajax({
                        url : '<?= site_url('/Wilayah/get_kab'); ?>',
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
                        url : '<?= site_url('/Wilayah/get_kec'); ?>',
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
                        url : '<?= site_url('/Wilayah/get_kechange');?>',
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

                
                // fungsi autocomplete kelompok
                $( "#kelompok" ).autocomplete({
                  source: "<?php echo site_url('pengajuan/get_auto');?>",
                  select: function (event, ui) {
                    $('#kelompok').val(ui.item.label);
                    $('[name="kodekelompok"]').val(ui.item.kode); 
                     }
                });
                // fungsi autocomplete kelompok
                $( "#koperasi" ).autocomplete({
                  source: "<?php echo site_url('pengajuan/get_koperasi');?>",
                  select: function (event, ui) {
                    $('#koperasi').val(ui.item.label);
                    $('[name="kodekoperasi"]').val(ui.item.kode); 
                     }
                });
                $('#tgllahirform').datetimepicker({
                    icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                    },
                    format : "DD-MM-YYYY",
                    useCurrent : false
                });
   
    
    });

    
</script>
</body>
</html>