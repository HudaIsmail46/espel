<script>
    $(function(){

        var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        var url = '';
        var modalHeader = '';
        var modalUrl = '';
        var postData = {};

        // modal proses
        $('#myModal').on('show.bs.modal',function(e){
            var vData = $(this).find(".modal-body");
            vData.html(loader);
            load_content_modal(modalUrl,postData,vData);
        })

        $('#myModal').on('hidden.bs.modal',function(e){
            var vData = $(this).find(".modal-body");
            vData.html(loader);
        })

        function load_content_modal(url,data,placeholder){
            $.ajax({
                url: url,
                success: function(data, textStatus, jqXHR){
                    placeholder.html(data);
                    $('#comPenganjur').combotree();
                }
            });
        }
        // tamat modal proses

        function viewPanelKursus(latihan,pembelajaran1,pembelajaran2,kendiri)
        {
            $('.espel_latihan').hide();
            $('.espel_pembelajaran1').hide();
            $('.espel_pembelajaran2').hide();
            $('.espel_kendiri').hide();

            if(latihan)
                $('.espel_latihan').show();

            if(pembelajaran1)
                $('.espel_pembelajaran1').show();

            if(pembelajaran2)
                $('.espel_pembelajaran2').show();

            if(kendiri)
                $('.espel_kendiri').show();
        }

        $('#linkDaftarKursus').on('click', function(e){
            e.preventDefault();
            modalHeader = 'Daftar Kursus Anjuran Luar';
            modalUrl = base_url + 'kursus/daftar_luar';
            $('#myLargeModalLabel').html(modalHeader);
            $('#myModal').modal();
        });

        $('#myModal').on('change','.espel_program', function(e){
            e.preventDefault();
            var nilai = $(this).val();
            $('.hddProgram').val(nilai);

            if(nilai == 1 || nilai == 2){
                viewPanelKursus(true,false,false,false);

                $("#txtTkhMula").datetimepicker({
                    format: "DD-MM-YYYY h:mm A"
                });
                $("#txtTkhTamat").datetimepicker({
                    format: "DD-MM-YYYY h:mm A"
                });
                $("#txtTkhMula").on("dp.hide", function (e) {
                    $('#txtTkhTamat').data("DateTimePicker").minDate(e.date);
                });
                $("#txtTkhTamat").on("dp.hide", function (e) {
                    $('#txtTkhMula').data("DateTimePicker").maxDate(e.date);
                });
            }
            if(nilai == 3){
                viewPanelKursus(false,true,false,false);
            }
            if(nilai == 4){
                viewPanelKursus(false,false,true,false);
            }
            if(nilai == 5){
                viewPanelKursus(false,false,false,true);
            }
            if (nilai == 0) {
                viewPanelKursus(false,false,false,false);
            }
        });

        $('#myModal').on('change','#comAnjuran', function(e){
            console.log($(this).val());
            if($(this).val() == 'L')
            {
                $("#input-txt-penganjur").show();
                $("#input-com-penganjur").hide();
            }

            if($(this).val() == 'D')
            {
                $("#input-txt-penganjur").hide();
                $("#input-com-penganjur").show();
            }
        });
    });

    $('#myModal').on('submit','.frm-daftar-kursus',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var formCsrf = {};

        $.ajax({
            url: base_url + 'api/csrf',
            success: function(data, textStatus, jqXHR ) {
                formCsrf = data;
                formData.append(data.csrfTokenName, data.csrfHash);
                $.ajax({
                    method: 'post',
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    url: base_url + 'kursus/ajax_do_daftar_luar',
                    success: function() {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        });
                        $('#myModal').modal('hide');
                    },
                    error: function(jqXHR, textStatus,errorThrown)
                    {
                        swal('Ralat!',errorThrown,'error');
                    }
                });
            }
        });
    });
</script>