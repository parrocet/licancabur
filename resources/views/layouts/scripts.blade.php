<!-- jquery
		============================================ -->
    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    
    <!-- wow JS
		============================================ -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{ asset('assets/js/jquery-price-slider.js') }}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{ asset('assets/js/meanmenu/jquery.meanmenu.js') }}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{ asset('assets/js/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counterup/counterup-active.js') }}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{ asset('assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/sparkline/sparkline-active.js') }}"></script>
    <!-- flot JS
		============================================ -->
    <script src="{{ asset('assets/js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/js/flot/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/js/flot/flot-active.js') }}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{ asset('assets/js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('assets/js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/knob/knob-active.js') }}"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{ asset('assets/js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/wave/wave-active.js') }}"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{ asset('assets/js/todo/jquery.todo.js') }}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!--  Chat JS
		============================================ -->
   {{--  <script src="{{ asset('assets/js/chat/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/chat/jquery.chat.js') }}"></script> --}}
    <!-- main JS
		============================================ -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- Data Table JS
		============================================ -->
    <script src="{{ asset('assets/js/data-table/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-table/data-table-act.js') }}"></script>
    <script>

        
    $('#data-table-basic').DataTable({
        "pageLength": 30,
        language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando la página _PAGE_ de _PAGES_",
        "infoEmpty": "Mostrando 0 de 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
          }
        }

    });
    
    </script>
    <!-- tawk chat JS
		============================================ -->
    {{-- <script src="{{ asset('assets/js/tawk-chat.js') }}"></script> --}}

    <!--============================================
     ************** Formularios *******************
    ============================================ -->
        <!--  wizard JS
		============================================ -->
    <script src="{{ asset('assets/js/wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/wizard/wizard-active.js') }}"></script>
    <!-- Input Mask JS
    ============================================ -->
    <script src="{{ asset('assets/js/mask/mask.min.js') }}"></script>
    <script>
       $('.time').mask('00:00:00');
    </script>
    
    <script src="{{ asset('assets/js/jasny-bootstrap.min.js') }}"></script>
    <!-- icheck JS
		============================================ -->
    <script src="{{ asset('assets/js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/js/icheck/icheck-active.js') }}"></script>
    <!-- rangle-slider JS
		============================================ -->
    <script src="{{ asset('assets/js/rangle-slider/jquery-ui-1.10.4.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/rangle-slider/jquery-ui-touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/rangle-slider/rangle-active.js') }}"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="{{ asset('assets/js/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datapicker/datepicker-active.js') }}"></script>
    <!-- bootstrap select JS
		============================================ -->
    <script src="{{ asset('assets/js/bootstrap-select/bootstrap-select.js') }}"></script>
    <!--  color-picker JS
		============================================ -->
    <script src="{{ asset('assets/js/color-picker/farbtastic.min.js') }}"></script>
    <script src="{{ asset('assets/js/color-picker/color-picker.js') }}"></script>
    <!--  notification JS
		============================================ -->
    <script src="{{ asset('assets/js/notification/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('assets/js/notification/notification-active.js') }}"></script>
    <!--  summernote JS
		============================================ -->
    <script src="{{ asset('assets/js/summernote/summernote-updated.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote/summernote-active.js') }}"></script>
    <!-- dropzone JS
		============================================ -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
   
    <!--  chosen JS
		============================================ -->
    <script src="{{ asset('assets/js/chosen/chosen.jquery.js') }}"></script>

    <script>

    $("#adicional").on('click', function () {
        var nuevaFecha = `
        <div class="form-group nk-datapk-ctm form-elet-mg mb-4">
                <label>Fecha</label>
                <div class="input-group date nk-int-st">
                    <span class="input-group-addon"></span>
                    <input type="date" class="form-control">
                </div>
            </div>
        `;

        $("#fechas").append(nuevaFecha);

    });

    $("document").ready(function () {
        $("#agregarActividad").on('click', function () {
            $("#myModal").modal();
        })

        $("#verActividad").on('click', function () {
            $("#modalActividades").modal();
        })
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    })
    
</script>

    <!-- start chart js -->
    <script src="{{ asset('js/Chart.min.js') }}"></script>

    <script src="{{ asset('js/line-chart.js') }}"></script>

    <script src="{{ asset('plugins/parsleyjs/dist/parsley.js') }}"></script>
    <script src="{{ asset('plugins/parsleyjs/dist/i18n/es.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>
@yield('scripts')

    <script type="text/javascript">
        function ver_actividad(fecha_vencimiento_ver,duracion_pro_ver,cant_personas_ver) {
            alert('adsasd');
            
            // $("#task_ver").text(task_ver);
            $("#fecha_vencimiento_ver").text(fecha_vencimiento_ver);
            // $("#descripcion_ver").text(descripcion_ver);
            $("#duracion_pro_ver").text(duracion_pro_ver);
            $("#cant_personas_ver").text(cant_personas_ver);
            // $("#duracion_real_ver").text(duracion_real_ver);
            // $("#dia_ver").text(dia_ver);
            // $("#tipo_ver").text(tipo_ver);
            // $("#realizada_ver").text(realizada_ver);
            // $("#area1_ver").text(area1_ver);
            // $("#observacion2_ver").text(observacion2_ver);
            // $("#departamento_ver").text(departamento_ver);
        }
    </script>