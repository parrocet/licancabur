<!doctype html>
<html class="no-js" lang="">

<head>
    @include('layouts.css')
    <style type="text/css">
         .callout{border-radius:3px;margin:0 0 20px 0;padding:15px 30px 15px 15px;border-left:5px solid #eee}.callout a{color:#fff;text-decoration:underline}.callout a:hover{color:#eee}.callout h4{margin-top:0;font-weight:600}.callout p:last-child{margin-bottom:0}.callout code,.callout .highlight{background-color:#fff}.callout.callout-danger{border-color:#c23321}.callout.callout-warning{border-color:#c87f0a}.callout.callout-info{border-color:#0097bc}.callout.callout-success{border-color:#00733e}

        .callout.callout-danger,.callout.callout-warning,.callout.callout-info,.callout.callout-success,.alert-success,.alert-danger,.alert-error,.alert-warning,.alert-info,.label-danger,.label-info,.label-warning,.label-primary,.label-success,.modal-primary .modal-body,.modal-primary .modal-header,.modal-primary .modal-footer,.modal-warning .modal-body,.modal-warning .modal-header,.modal-warning .modal-footer,.modal-info .modal-body,.modal-info .modal-header,.modal-info .modal-footer,.modal-success .modal-body,.modal-success .modal-header,.modal-success .modal-footer,.modal-danger .modal-body,.modal-danger .modal-header,.modal-danger .modal-footer{color:#fff !important}.bg-gray{color:#000;background-color:#d2d6de !important}.bg-gray-light{background-color:#f7f7f7}.bg-black{background-color:#111 !important}.bg-red,.callout.callout-danger,.alert-danger,.alert-error,.label-danger,.modal-danger .modal-body{background-color:#dd4b39 !important}.bg-yellow,.callout.callout-warning,.alert-warning,.label-warning,.modal-warning .modal-body{background-color:#f39c12 !important}.bg-aqua,.callout.callout-info,.alert-info,.label-info,.modal-info .modal-body{background-color:#00c0ef !important}.bg-blue{background-color:#0073b7 !important}.bg-light-blue,.label-primary,.modal-primary .modal-body{background-color:#3c8dbc !important}.bg-green,.callout.callout-success,.alert-success,.label-success,.modal-success .modal-body{background-color:#00a65a !important}
        .scrollbar {
            height: 500px;
            width: 100%;
            background: #fff;
            overflow-y: scroll;
            margin-bottom: 25px;
            }
            .force-overflow {
            min-height: 450px;
            }

            .scrollbar-primary::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5; }

            .scrollbar-primary::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #4285F4;

        }
        .container {
            width: 100% !important;
        }

        .botonAyuda{
            position: absolute !important;
        }
        .botonesLaterales{
              /*las imágenes usadas tienen width de 48px*/
              width:106px;
              position:fixed;
              top:500px;
              right:0;
            }
            /* Extra centrado vertical*/
            .botonesLaterales{
              /*border:1px solid #000;*/
              top:105%;
              height:205px;
              /*para poner height 192 deberíamos haber indicado en el reset de estilos font-size:0;*/
              margin-top:-100px;
              /*position: relative;*/
            }
    </style>

    

</head>

<body style="width: 100% !important; margin-top: 0px !important;">
        
    <!-- Start header Top -->

    @include("layouts.admin.header")

    <!-- End Header Top Area -->

    <!-- Mobile Menu start -->

    @include("layouts.admin.mobileMenu")

    <!-- Mobile Menu end -->

    <!-- Main Menu area start-->

    @include("layouts.admin.mainMenu")
    <!-- Main Menu area End-->

    <div class="card-body" style="position: relative !important; width: 100% !important;">
        
    <!-- <div class="content" style="padding-bottom: 100px !important;"> -->
        <div>
            @yield('statusarea')
            @yield('breadcomb')
            @yield('content')
        </div>
        <div class="botonAyuda">
            <div class="botonesLaterales">
                <div class="btn-group dropup">
                    <ul class="dropdown-menu pull-right">
                        <div class="card">
                            <div class="card-body">
                                <div style="margin-left: 5px;" class="overflow-auto">
                                    <!-- <div class="panel panel-collapse notika-accrodion-cus">
                                        <div class="panel-heading" role="tab">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordionGreen" href="#accordionGreen-one" aria-expanded="false" class="collapsed">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                        Actividades
                                                        </font>
                                                    </font>
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" role="tab">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordionGreen" href="#accordionGreen-one" aria-expanded="false" class="collapsed">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                        Usuarios
                                                        </font>
                                                    </font>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="accordionGreen-one" class="collapse" role="tabpanel" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                <p>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Anim pariatur cliché reprehenderit, enim eiusmod high life accusamus terry cry luego richardson ad squid. </font><font style="vertical-align: inherit;">3 wolf moon officia aute, brunch de dolor sin monopatín cupidatat. </font><font style="vertical-align: inherit;">Food truck quinua nesciunt laborum eiusmod. </font><font style="vertical-align: inherit;">Brunch 3 wolf msr ​​noontemporem, sunt aliqua le puso un pájaro calamar café de origen único nullassumendan shoreditch et.</font></font>
                                                </p>
                                            </div>
                                        </div>
                                    </div> -->
                                    ¡Muy Pronto!
                                </div>
                            </div>
                        </div>
                    </ul>
                    <a href="#botones" id="boton3" onclick="mostrarO(3)" class="btn btn-default mt-1 text-dark dropdown-toggle" data-toggle="dropdown" style="border-radius: 30px !important; font-size: 20px;">
                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Ayuda</font></font>
                        <i class="notika-icon notika-chat"></i>
                    </a>
                </div>
            </div>
        </div>
    <!-- </div> -->

    </div>

    @include('layouts.footer')
    @include('layouts.scripts')
</body>

</html>
