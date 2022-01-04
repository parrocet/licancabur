<form action="{{ route('pdf_cho_hh') }}" method="POST" target="_blank">
    @csrf
<div class="card-box">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('estadisticasHH') }}" class="btn btn-primary"><i class="fa fa-undo"></i> Regresar</a>
            <button value="submit" class="btn btn-danger" target="_blank" ><i class="fa fa-undo"></i> Imprimir</button>
        </div>
        <div class="col-md-8">
            <h4>Resultado de la búsquedas</h4>
        </div>
    </div>
</div>
<hr>
<div class="card-box">
    <div class="row ajl">
        <h4>Filtro-Puerto </h4>
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
                        {!! $hh_pm01_filtro[0] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[0] !!}" name="filtro_pm01_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm01_filtro[1] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[1] !!}" name="filtro_pm01_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm01_filtro[2] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[2] !!}" name="filtro_pm01_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm01_filtro[3] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[3] !!}" name="filtro_pm01_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm01_filtro[4] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[4] !!}" name="filtro_pm01_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm01_filtro[5] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[5] !!}" name="filtro_pm01_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm01_filtro[6] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[6] !!}" name="filtro_pm01_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm01_filtro[7] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[7] !!}" name="filtro_pm01_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm01_filtro[8] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[8] !!}" name="filtro_pm01_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm01_filtro[9] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[9] !!}" name="filtro_pm01_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm01_filtro[10] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[10] !!}" name="filtro_pm01_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm01_filtro[11] !!}
                        <input type="hidden" value="{!! $hh_pm01_filtro[11] !!}" name="filtro_pm01_diciembre">
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
                        {!! $hh_pm02_filtro[0] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[0] !!}" name="filtro_pm02_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm02_filtro[1] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[1] !!}" name="filtro_pm02_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm02_filtro[2] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[2] !!}" name="filtro_pm02_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm02_filtro[3] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[3] !!}" name="filtro_pm02_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm02_filtro[4] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[4] !!}" name="filtro_pm02_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm02_filtro[5] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[5] !!}" name="filtro_pm02_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm02_filtro[6] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[6] !!}" name="filtro_pm02_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm02_filtro[7] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[7] !!}" name="filtro_pm02_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm02_filtro[8] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[8] !!}" name="filtro_pm02_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm02_filtro[9] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[9] !!}" name="filtro_pm02_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm02_filtro[10] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[10] !!}" name="filtro_pm02_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm02_filtro[11] !!}
                        <input type="hidden" value="{!! $hh_pm02_filtro[11] !!}" name="filtro_pm02_diciembre">
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
                        {!! $hh_pm03_filtro[0] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[0] !!}" name="filtro_pm03_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm03_filtro[1] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[1] !!}" name="filtro_pm03_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm03_filtro[2] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[2] !!}" name="filtro_pm03_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm03_filtro[3] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[3] !!}" name="filtro_pm03_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm03_filtro[4] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[4] !!}" name="filtro_pm03_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm03_filtro[5] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[5] !!}" name="filtro_pm03_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm03_filtro[6] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[6] !!}" name="filtro_pm03_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm03_filtro[7] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[7] !!}" name="filtro_pm03_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm03_filtro[8] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[8] !!}" name="filtro_pm03_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm03_filtro[9] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[9] !!}" name="filtro_pm03_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm03_filtro[10] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[10] !!}" name="filtro_pm03_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm03_filtro[11] !!}
                        <input type="hidden" value="{!! $hh_pm03_filtro[11] !!}" name="filtro_pm03_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_filtro_3->render() !!}
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
                    {!! $graf_hh_filtro_1->render() !!}
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
                    {!! $graf_hh_filtro_2->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="card-box">
    <div class="row ajl">
        <h4>ECT </h4>
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
                        {!! $hh_pm01_ect[0] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[0] !!}" name="ect_pm01_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm01_ect[1] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[1] !!}" name="ect_pm01_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm01_ect[2] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[2] !!}" name="ect_pm01_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm01_ect[3] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[3] !!}" name="ect_pm01_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm01_ect[4] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[4] !!}" name="ect_pm01_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm01_ect[5] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[5] !!}" name="ect_pm01_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm01_ect[6] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[6] !!}" name="ect_pm01_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm01_ect[7] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[7] !!}" name="ect_pm01_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm01_ect[8] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[8] !!}" name="ect_pm01_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm01_ect[9] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[9] !!}" name="ect_pm01_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm01_ect[10] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[10] !!}" name="ect_pm01_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm01_ect[11] !!}
                        <input type="hidden" value="{!! $hh_pm01_ect[11] !!}" name="ect_pm01_diciembre">
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
                        {!! $hh_pm02_ect[0] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[0] !!}" name="ect_pm02_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm02_ect[1] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[1] !!}" name="ect_pm02_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm02_ect[2] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[2] !!}" name="ect_pm02_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm02_ect[3] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[3] !!}" name="ect_pm02_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm02_ect[4] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[4] !!}" name="ect_pm02_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm02_ect[5] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[5] !!}" name="ect_pm02_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm02_ect[6] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[6] !!}" name="ect_pm02_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm02_ect[7] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[7] !!}" name="ect_pm02_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm02_ect[8] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[8] !!}" name="ect_pm02_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm02_ect[9] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[9] !!}" name="ect_pm02_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm02_ect[10] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[10] !!}" name="ect_pm02_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm02_ect[11] !!}
                        <input type="hidden" value="{!! $hh_pm02_ect[11] !!}" name="ect_pm02_diciembre">
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
                        {!! $hh_pm03_ect[0] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[0] !!}" name="ect_pm03_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm03_ect[1] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[1] !!}" name="ect_pm03_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm03_ect[2] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[2] !!}" name="ect_pm03_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm03_ect[3] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[3] !!}" name="ect_pm03_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm03_ect[4] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[4] !!}" name="ect_pm03_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm03_ect[5] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[5] !!}" name="ect_pm03_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm03_ect[6] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[6] !!}" name="ect_pm03_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm03_ect[7] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[7] !!}" name="ect_pm03_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm03_ect[8] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[8] !!}" name="ect_pm03_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm03_ect[9] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[9] !!}" name="ect_pm03_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm03_ect[10] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[10] !!}" name="ect_pm03_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm03_ect[11] !!}
                        <input type="hidden" value="{!! $hh_pm03_ect[11] !!}" name="ect_pm03_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <div class="row">
                    <h4 style="text-align: center;">Gráfica</h4>
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_ect_3->render() !!}
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
                    {!! $graf_hh_ect_1->render() !!}
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
                    {!! $graf_hh_ect_2->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="card-box">
    <div class="row ajl">
        <h4>Los Colorados </h4>
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
                        {!! $hh_pm01_colorados[0] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[0] !!}" name="colorados_pm01_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm01_colorados[1] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[1] !!}" name="colorados_pm01_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm01_colorados[2] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[2] !!}" name="colorados_pm01_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm01_colorados[3] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[3] !!}" name="colorados_pm01_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm01_colorados[4] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[4] !!}" name="colorados_pm01_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm01_colorados[5] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[5] !!}" name="colorados_pm01_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm01_colorados[6] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[6] !!}" name="colorados_pm01_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm01_colorados[7] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[7] !!}" name="colorados_pm01_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm01_colorados[8] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[8] !!}" name="colorados_pm01_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm01_colorados[9] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[9] !!}" name="colorados_pm01_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm01_colorados[10] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[10] !!}" name="colorados_pm01_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm01_colorados[11] !!}
                        <input type="hidden" value="{!! $hh_pm01_colorados[11] !!}" name="colorados_pm01_diciembre">
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
                        {!! $hh_pm02_colorados[0] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[0] !!}" name="colorados_pm02_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm02_colorados[1] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[1] !!}" name="colorados_pm02_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm02_colorados[2] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[2] !!}" name="colorados_pm02_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm02_colorados[3] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[3] !!}" name="colorados_pm02_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm02_colorados[4] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[4] !!}" name="colorados_pm02_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm02_colorados[5] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[5] !!}" name="colorados_pm02_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm02_colorados[6] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[6] !!}" name="colorados_pm02_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm02_colorados[7] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[7] !!}" name="colorados_pm02_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm02_colorados[8] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[8] !!}" name="colorados_pm02_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm02_colorados[9] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[9] !!}" name="colorados_pm02_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm02_colorados[10] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[10] !!}" name="colorados_pm02_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm02_colorados[11] !!}
                        <input type="hidden" value="{!! $hh_pm02_colorados[11] !!}" name="colorados_pm02_diciembre">
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
                        {!! $hh_pm03_colorados[0] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[0] !!}" name="colorados_pm03_enero">
                    </td>
                </tr>
                <tr>
                    <td>Febrero</td>
                    <td>
                        {!! $hh_pm03_colorados[1] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[1] !!}" name="colorados_pm03_febrero">
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td>
                        {!! $hh_pm03_colorados[2] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[2] !!}" name="colorados_pm03_marzo">
                    </td>
                </tr>
                <tr>
                    <td>Abril</td>
                    <td>
                        {!! $hh_pm03_colorados[3] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[3] !!}" name="colorados_pm03_abril">
                    </td>
                </tr>
                <tr>
                    <td>Mayo</td>
                    <td>
                        {!! $hh_pm03_colorados[4] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[4] !!}" name="colorados_pm03_mayo">
                    </td>
                </tr>
                <tr>
                    <td>Junio</td>
                    <td>
                        {!! $hh_pm03_colorados[5] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[5] !!}" name="colorados_pm03_junio">
                    </td>
                </tr>
                <tr>
                    <td>Julio</td>
                    <td>
                        {!! $hh_pm03_colorados[6] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[6] !!}" name="colorados_pm03_julio">
                    </td>
                </tr>
                <tr>
                    <td>Agosto</td>
                    <td>
                        {!! $hh_pm03_colorados[7] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[7] !!}" name="colorados_pm03_agosto">
                    </td>
                </tr>
                <tr>
                    <td>Septiembre</td>
                    <td>
                        {!! $hh_pm03_colorados[8] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[8] !!}" name="colorados_pm03_septiembre">
                    </td>
                </tr>
                <tr>
                    <td>Octubre</td>
                    <td>
                        {!! $hh_pm03_colorados[9] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[9] !!}" name="colorados_pm03_octubre">
                    </td>
                </tr>
                <tr>
                    <td>Noviembre</td>
                    <td>
                        {!! $hh_pm03_colorados[10] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[10] !!}" name="colorados_pm03_noviembre">
                    </td>
                </tr>
                <tr>
                    <td>Diciembre</td>
                    <td>
                        {!! $hh_pm03_colorados[11] !!}
                        <input type="hidden" value="{!! $hh_pm03_colorados[11] !!}" name="colorados_pm03_diciembre">
                    </td>
                </tr>
            </table>
            {{--
            <div style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_hh_colorados_3->render() !!}
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
                    {!! $graf_hh_colorados_1->render() !!}
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
                    {!! $graf_hh_colorados_2->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
</form>