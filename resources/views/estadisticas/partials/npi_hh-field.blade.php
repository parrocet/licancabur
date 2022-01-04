<form action="{{ route('pdf_npi_hh') }}" method="POST" target="_blank">
@csrf
<div class="card-box">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('estadisticasHH') }}" class="btn btn-primary"><i class="fa fa-undo"></i> Regresar</a>
            <button value="submit" class="btn btn-danger" target="_blank" ><i class="fa fa-undo"></i> Imprimir</button>
        </div>
        <div class="col-md-10">
            <h4>Resultado de la búsquedas</h4>
        </div>
    </div>
</div>
<hr>
<div class="card-box">
    <div class="row ajl">
        <h4>EWS </h4>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px" style="height: 40px;">
                <tr>
                    <td colspan="2" style=" background: #F7C55F; color: black;">PM01</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm01_ews[0] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[0] !!}" name="ews_pm01_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm01_ews[1] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[1] !!}" name="ews_pm01_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm01_ews[2] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[2] !!}" name="ews_pm01_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm01_ews[3] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[3] !!}" name="ews_pm01_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm01_ews[4] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[4] !!}" name="ews_pm01_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm01_ews[5] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[5] !!}" name="ews_pm01_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm01_ews[6] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[6] !!}" name="ews_pm01_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm01_ews[7] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[7] !!}" name="ews_pm01_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm01_ews[8] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[8] !!}" name="ews_pm01_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm01_ews[9] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[9] !!}" name="ews_pm01_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm01_ews[10] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[10] !!}" name="ews_pm01_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm01_ews[11] !!}
                        <input type="hidden" value="{!! $hh_pm01_ews[11] !!}" name="ews_pm01_diciembre">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px">
                <tr>
                    <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm02_ews[0] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[0] !!}" name="ews_pm02_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm02_ews[1] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[1] !!}" name="ews_pm02_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm02_ews[2] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[2] !!}" name="ews_pm02_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm02_ews[3] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[3] !!}" name="ews_pm02_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm02_ews[4] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[4] !!}" name="ews_pm02_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm02_ews[5] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[5] !!}" name="ews_pm02_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm02_ews[6] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[6] !!}" name="ews_pm02_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm02_ews[7] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[7] !!}" name="ews_pm02_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm02_ews[8] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[8] !!}" name="ews_pm02_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm02_ews[9] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[9] !!}" name="ews_pm02_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm02_ews[10] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[10] !!}" name="ews_pm02_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm02_ews[11] !!}
                        <input type="hidden" value="{!! $hh_pm02_ews[11] !!}" name="ews_pm02_diciembre">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px">
                <tr>
                    <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm03_ews[0] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[0] !!}" name="ews_pm03_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm03_ews[1] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[1] !!}" name="ews_pm03_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm03_ews[2] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[2] !!}" name="ews_pm03_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm03_ews[3] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[3] !!}" name="ews_pm03_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm03_ews[4] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[4] !!}" name="ews_pm03_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm03_ews[5] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[5] !!}" name="ews_pm03_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm03_ews[6] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[6] !!}" name="ews_pm03_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm03_ews[7] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[7] !!}" name="ews_pm03_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm03_ews[8] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[8] !!}" name="ews_pm03_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm03_ews[9] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[9] !!}" name="ews_pm03_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm03_ews[10] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[10] !!}" name="ews_pm03_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm03_ews[11] !!}
                        <input type="hidden" value="{!! $hh_pm03_ews[11] !!}" name="ews_pm03_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_ews_3->render() !!}
                </div>
            </div> --}}
        </div>
        <div class="col-lg-12 col-md-12 table-responsive" style="background: white; padding: 20px; border-radius: 10px;">
            <div class="grafica">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica HH por tipo del año 
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_ews_1->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 table-responsive mt-3" style="background: white; padding: 20px; border-radius: 10px;">
            <div class="grafica">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica por tipo PM01 vs PM02 del año 
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_ews_2->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="card-box">
    <div class="row ajl">
        <h4>Planta Cero/Desaladora & Acueducto </h4>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px" style="height: 40px;">
                <tr>
                    <td colspan="2" style=" background: #F7C55F; color: black;">PM01</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm01_planta[0] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[0] !!}" name="planta_pm01_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm01_planta[1] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[1] !!}" name="planta_pm01_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm01_planta[2] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[2] !!}" name="planta_pm01_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm01_planta[3] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[3] !!}" name="planta_pm01_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm01_planta[4] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[4] !!}" name="planta_pm01_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm01_planta[5] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[5] !!}" name="planta_pm01_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm01_planta[6] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[6] !!}" name="planta_pm01_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm01_planta[7] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[7] !!}" name="planta_pm01_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm01_planta[8] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[8] !!}" name="planta_pm01_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm01_planta[9] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[9] !!}" name="planta_pm01_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm01_planta[10] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[10] !!}" name="planta_pm01_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm01_planta[11] !!}
                        <input type="hidden" value="{!! $hh_pm01_planta[11] !!}" name="planta_pm01_diciembre">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px">
                <tr>
                    <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm02_planta[0] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[0] !!}" name="planta_pm02_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm02_planta[1] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[1] !!}" name="planta_pm02_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm02_planta[2] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[2] !!}" name="planta_pm02_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm02_planta[3] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[3] !!}" name="planta_pm02_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm02_planta[4] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[4] !!}" name="planta_pm02_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm02_planta[5] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[5] !!}" name="planta_pm02_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm02_planta[6] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[6] !!}" name="planta_pm02_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm02_planta[7] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[7] !!}" name="planta_pm02_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm02_planta[8] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[8] !!}" name="planta_pm02_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm02_planta[9] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[9] !!}" name="planta_pm02_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm02_planta[10] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[10] !!}" name="planta_pm02_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm02_planta[11] !!}
                        <input type="hidden" value="{!! $hh_pm02_planta[11] !!}" name="planta_pm02_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_planta_2->render() !!}
                </div>
            </div>
            --}}
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px">
                <tr>
                    <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm03_planta[0] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[0] !!}" name="planta_pm03_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm03_planta[1] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[1] !!}" name="planta_pm03_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm03_planta[2] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[2] !!}" name="planta_pm03_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm03_planta[3] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[3] !!}" name="planta_pm03_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm03_planta[4] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[4] !!}" name="planta_pm03_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm03_planta[5] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[5] !!}" name="planta_pm03_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm03_planta[6] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[6] !!}" name="planta_pm03_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm03_planta[7] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[7] !!}" name="planta_pm03_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm03_planta[8] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[8] !!}" name="planta_pm03_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm03_planta[9] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[9] !!}" name="planta_pm03_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm03_planta[10] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[10] !!}" name="planta_pm03_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm03_planta[11] !!}
                        <input type="hidden" value="{!! $hh_pm03_planta[11] !!}" name="planta_pm03_diciembre">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12 col-md-12 table-responsive" style="background: white; padding: 20px; border-radius: 10px;">
            <div class="grafica">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica HH por tipo del año 
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_planta_1->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 table-responsive mt-3" style="background: white; padding: 20px; border-radius: 10px;">
            <div class="grafica">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica por tipo PM01 vs PM02 del año 
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_planta_2->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="card-box">
    <div class="row ajl">
        <h4>Agua y Tranque </h4>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px" style="height: 40px;">
                <tr>
                    <td colspan="2" style=" background: #F7C55F; color: black;">PM01</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm01_agua[0] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[0] !!}" name="agua_pm01_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm01_agua[1] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[1] !!}" name="agua_pm01_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm01_agua[2] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[2] !!}" name="agua_pm01_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm01_agua[3] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[3] !!}" name="agua_pm01_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm01_agua[4] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[4] !!}" name="agua_pm01_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm01_agua[5] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[5] !!}" name="agua_pm01_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm01_agua[6] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[6] !!}" name="agua_pm01_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm01_agua[7] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[7] !!}" name="agua_pm01_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm01_agua[8] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[8] !!}" name="agua_pm01_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm01_agua[9] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[9] !!}" name="agua_pm01_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm01_agua[10] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[10] !!}" name="agua_pm01_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm01_agua[11] !!}
                        <input type="hidden" value="{!! $hh_pm01_agua[11] !!}" name="agua_pm01_diciembre">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px">
                <tr>
                    <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm02_agua[0] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[0] !!}" name="agua_pm02_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm02_agua[1] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[1] !!}" name="agua_pm02_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm02_agua[2] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[2] !!}" name="agua_pm02_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm02_agua[3] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[3] !!}" name="agua_pm02_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm02_agua[4] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[4] !!}" name="agua_pm02_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm02_agua[5] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[5] !!}" name="agua_pm02_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm02_agua[6] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[6] !!}" name="agua_pm02_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm02_agua[7] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[7] !!}" name="agua_pm02_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm02_agua[8] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[8] !!}" name="agua_pm02_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm02_agua[9] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[9] !!}" name="agua_pm02_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm02_agua[10] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[10] !!}" name="agua_pm02_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm02_agua[11] !!}
                        <input type="hidden" value="{!! $hh_pm02_agua[11] !!}" name="agua_pm02_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_agua_2->render() !!}
                </div>
            </div>
            --}}
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table table-striped table-bordered" border="2px">
                <tr>
                    <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                    <td>HH Realizadas</td>
                </tr>
                <tr>
                    <th rowspan="13" style=" padding-top: 80%;">
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </th>
                </tr>
                <tr>
                    <td>Enero</td>
                    <td>
                        {!! $hh_pm03_agua[0] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[0] !!}" name="agua_pm03_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm03_agua[1] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[1] !!}" name="agua_pm03_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm03_agua[2] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[2] !!}" name="agua_pm03_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm03_agua[3] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[3] !!}" name="agua_pm03_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm03_agua[4] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[4] !!}" name="agua_pm03_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm03_agua[5] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[5] !!}" name="agua_pm03_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm03_agua[6] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[6] !!}" name="agua_pm03_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm03_agua[7] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[7] !!}" name="agua_pm03_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm03_agua[8] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[8] !!}" name="agua_pm03_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm03_agua[9] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[9] !!}" name="agua_pm03_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm03_agua[10] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[10] !!}" name="agua_pm03_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm03_agua[11] !!}
                        <input type="hidden" value="{!! $hh_pm03_agua[11] !!}" name="agua_pm03_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_agua_3->render() !!}
                </div>
            </div>
            --}}
        </div>
        <div class="col-lg-12 col-md-12 table-responsive" style="background: white; padding: 20px; border-radius: 10px;">
            <div class="grafica">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica HH por tipo del año 
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_agua_1->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 table-responsive mt-3" style="background: white; padding: 20px; border-radius: 10px;">
            <div class="grafica">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica por tipo PM01 vs PM02 del año 
                        @if(session('fecha_actual'))
                            @php $anio=session('fecha_actual'); @endphp
                        @else
                            @php $anio=date('Y');
                                session('fecha_actual',$anio);
                             @endphp
                            
                        @endif
                        {{ $anio }}
                    </h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_agua_2->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
</form>