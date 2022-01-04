@extends('layouts.appLayout')


@section('content')

<!-- Start Status area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <br>

                        <h2>Crear Planificación</h2>
                    </div>
                    <div style="margin-left: 20px; padding-top: 10px">
                        <a href="{{ route('planificacion.create') }}">
                            <i class="notika-icon notika-calendar float-right" style="font-size: 30px"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ total_empleados() }}</span></h2>
                        <p>Empleados</p>
                    </div>
                    <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{$actividades}}</span></h2>
                        <p>Total de actividades</p>
                    </div>
                    <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{$realizada}}</span></h2>
                        <p>Actividades realizadas</p>
                    </div>
                    <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Status area-->


<!-- Start Sale Statistic area-->
<!-- <div class="sale-statistic-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                        <div class="curved-ctn">
                            <h2>Gráfica general de la semana en curso</h2>
                            <p>Gráfica sobre la cantidad de actividades y los tipos.</p>
                        </div>
                    </div>
                    <div class="line-chart-wp chart-display-nn">
                        <canvas height="140vh" width="180vw" id="basiclinechart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="sale-statistic-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                        <div class="curved-ctn">
                            <h2>Gráfica general de la semana en curso</h2>
                            <p>Gráfica sobre la cantidad de actividades y los tipos.</p>
                        </div>
                    </div>
                    <div style="width:100%;">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sale Statistic area-->
@endsection
