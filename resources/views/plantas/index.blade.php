@extends('layouts.appLayout')

@section('breadcomb')
    <!-- Breadcomb area Start-->

    <div class="row">
    	<div class="col-ms-3">
    		

    	</div>
    	<div class="col-ms-6">
		    <div class="breadcomb-area">
		        <div class="container">
		            <div class="row">
		                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    <div class="breadcomb-list">
		                        <div class="row">
		                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                <div class="breadcomb-wp">
		                                    <div class="breadcomb-ctn">
		                                        <h2>Planta</h2>
		                                        <p>Gráfica para el status general de las plantas</p>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="breadcomb-area">
		        <div class="container">
		            <div class="row">
		                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    <div class="breadcomb-list">
		                        <div class="row">
		                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                <div class="breadcomb-wp">
		                                    <div class="breadcomb-ctn">
		                                        <h2>Planta</h2>
		                                        <p>Gráfica para el status general de las plantas</p>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <!-- Breadcomb area End-->
    	</div>
    	<div class="col-ms-3">
    		
    		
    	</div>
    </div>

@endsection

@section('content')
    <!-- Form Element area Start-->
<div class="form-element-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        @if(count($errors))
                        <div class="alert-list m-4">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>
                                        {{$error}}
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="width:100%;">
                                {!! $chartjs_a1->render() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="width:100%;">
                                {!! $chartjs_a1->render() !!}
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a class="btn btn-md btn-success" href="{{ route('graficas.index') }}">Regresar</a>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection