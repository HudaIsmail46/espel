<script>
    $(function(){

        var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        var url = '';
        var modalHeader = '';
        var modalUrl = '';
        var postData = {};
        
        load_data_grid();
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

        function load_data_grid()
        {
            $('#senKursusLuar').html(loader);
            $.ajax({
                url: base_url + 'kursus/ajax_senarai_luar',
                success: function(data, textStatus, jqXHR) {
                    $('#senKursusLuar').html(data);
                    $('.datatable').dataTable();
                }
            });
        }

        function load_content_modal(url,data,placeholder){
            $.ajax({
                url: url,
                success: function(data, textStatus, jqXHR){
                    placeholder.html(data);
                    $(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' )-5);
                    $('#comPenganjurLatihan').combotree();
                    $('#comPenganjurPemb').combotree();
                    $('#comPenganjurPemb2').combotree();
                    $('#comPenganjurKend').combotree();
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
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhTamat").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhMula").on("dp.hide", function (e) {
                    $('#txtTkhTamat').data("DateTimePicker").minDate(e.date);
                });
                $("#txtTkhTamat").on("dp.hide", function (e) {
                    $('#txtTkhMula').data("DateTimePicker").maxDate(e.date);
                });

                var masaMula = $('#txtMasaMula').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });

                var masaTamat = $('#txtMasaTamat').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });
            }
            if(nilai == 3){
                viewPanelKursus(false,true,false,false);
                $("#txtTkhMulaPemb").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhTamatPemb").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhMulaPemb").on("dp.hide", function (e) {
                    $('#txtTkhTamatPemb').data("DateTimePicker").minDate(e.date);
                });
                $("#txtTkhTamatPemb").on("dp.hide", function (e) {
                    $('#txtTkhMulaPemb').data("DateTimePicker").maxDate(e.date);
                });

                var masaMula = $('#txtMasaMulaPemb').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });

                var masaTamat = $('#txtMasaTamatPemb').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });
            }
            if(nilai == 4){
                viewPanelKursus(false,false,true,false);
                $("#txtTkhMulaPemb2").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhTamatPemb2").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhMulaPemb2").on("dp.hide", function (e) {
                    $('#txtTkhTamatPemb2').data("DateTimePicker").minDate(e.date);
                });
                $("#txtTkhTamatPemb2").on("dp.hide", function (e) {
                    $('#txtTkhMulaPemb2').data("DateTimePicker").maxDate(e.date);
                });

                var masaMula = $('#txtMasaMulaPemb2').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });

                var masaTamat = $('#txtMasaTamatPemb2').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });
            }
            if(nilai == 5){
                viewPanelKursus(false,false,false,true);
                $("#txtTkhMulaKend").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhTamatKend").datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $("#txtTkhMulaKend").on("dp.hide", function (e) {
                    $('#txtTkhTamatKend').data("DateTimePicker").minDate(e.date);
                });
                $("#txtTkhTamatKend").on("dp.hide", function (e) {
                    $('#txtTkhMulaKend').data("DateTimePicker").maxDate(e.date);
                });

                var masaMula = $('#txtMasaMulaKend').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });

                var masaTamat = $('#txtMasaTamatKend').timepicker({
                    template: false,
                    minuteStep: 15,
                    showInputs: false,
                    disableFocus: true,
                    defaultTime: false
                });
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
                $("#txtPenganjurLatihan").prop('required',true);
                $("#input-com-penganjur").hide();
                $("#comPenganjurLatihan").prop('required',false);
            }

            if($(this).val() == 'D')
            {
                $("#input-txt-penganjur").hide();
                $("#txtPenganjurLatihan").prop('required',false);
                $("#input-com-penganjur").show();
                $("#comPenganjurLatihan").prop('required',true);
            }
        });

        $('#myModal').on('change','#comAnjuranPemb', function(e){
            console.log($(this).val());
            if($(this).val() == 'L')
            {
                $("#input-txt-penganjur-pemb").show();
                $("#txtPenganjurPemb").prop('required',true);
                $("#input-com-penganjur-pemb").hide();
                $("#comPenganjurPemb").prop('required',false);
            }

            if($(this).val() == 'D')
            {
                $("#input-txt-penganjur-pemb").hide();
                $("#txtPenganjurPemb").prop('required',false);
                $("#input-com-penganjur-pemb").show();
                $("#comPenganjurPemb").prop('required',true);
            }
        });

        $('#myModal').on('change','#comAnjuranPemb2', function(e){
            console.log($(this).val());
            if($(this).val() == 'L')
            {
                $("#input-txt-penganjur-pemb2").show();
                $("#txtPenganjurPemb2").prop('required',true);
                $("#input-com-penganjur-pemb2").hide();
                $("#comPenganjurPemb2").prop('required',false);
            }

            if($(this).val() == 'D')
            {
                $("#input-txt-penganjur-pemb2").hide();
                $("#txtPenganjurPemb2").prop('required',false);
                $("#input-com-penganjur-pemb2").show();
                $("#comPenganjurPemb2").prop('required',true);
            }
        });

        $('#myModal').on('change','#comAnjuranKend', function(e){
            console.log($(this).val());
            if($(this).val() == 'L')
            {
                $("#input-txt-penganjur-kend").show();
                $("#txtPenganjurKend").prop('required',true);
                $("#input-com-penganjur-kend").hide();
                $("#comPenganjurKend").prop('required',false);
            }

            if($(this).val() == 'D')
            {
                $("#input-txt-penganjur-kend").hide();
                $("#txtPenganjurKend").prop('required',false);
                $("#input-com-penganjur-kend").show();
                $("#comPenganjurKend").prop('required',true);
            }
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
                            console.log('load data');
                            load_data_grid();
                        },
                        error: function(jqXHR, textStatus,errorThrown)
                        {
                            swal('Ralat!',errorThrown,'error');
                        }
                    });
                }
            });
        });
    });
</script>