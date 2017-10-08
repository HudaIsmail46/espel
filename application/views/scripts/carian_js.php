<script>
(function(){
    var options = {
        page: 0,
        filter: {
            nama: '',
            nokp: '',
            jabatan_id: 6792,
            sub_jabatan: 1,
            kump_id: 0,
            skim_id: 0,
            gred_id: 0,
            status: 'Y'
        },
        url: base_url+'pengguna/data_grid/0'
   };

    $('#frmFilter').hide();

    $('#cmdFilter').click(function(e){
        e.preventDefault();
        $('#frmFilter').toggle('fast');
    });

    $("#comKelas").change(function(){
        $.ajax({
            url:"<?=base_url("api/get_laporan_skim/")?>" + $(this).val(),
            success: function(gred,textStatus,jqXHR)
            {
                $('#comSkim').html('<option value="0">Pilih Semua</option>');
                for(var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                    $('#comSkim').append(option);
                }
            }
        });
    });

    $("#comSkim").change(function(){
        $.ajax({
            url:"<?=base_url("api/get_laporan_gred/")?>" + $(this).val(),
            success: function(gred,textStatus,jqXHR)
            {
                $('#comGred').html('<option value="0">Pilih Semua</option>');
                for(var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                    $('#comGred').append(option);
                }
            }
        });
    });

    load_datagrid(options);

    function load_datagrid(params){
        $.ajax({
            method: 'post',
            url: options.url,
            data: params.filter,
            success: function(data,textStatus,jqXHR){
                $('#datagrid').html(data);
                console.log(data);
                $('ul.pagination li a').click(function(e){
                    e.preventDefault();
                    params.url = $(this).attr('href');
                    load_datagrid(params);
                });
            }
        });
    }

    $('#cmdDoTapis').click(function(e){
        e.preventDefault();

        options.filter.nama = $('#txtNama').val();
        options.filter.nokp = $('#txtNoKP').val();
        options.filter.jabatan_id = $('#comJabatan').val();
        options.filter.kump_id = $('#comKelas').val();
        options.filter.skim_id = $('#comSkim').val();
        options.filter.gred_id = $('#comGred').val();
        options.filter.status = $('#comStatus').val();
        options.url = base_url+'pengguna/data_grid/0';
        
        console.log(options);
        load_datagrid(options);
    });
})();
</script>