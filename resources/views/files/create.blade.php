@extends('adminlte::page')
@section('title', 'RHOMB FILES | ' . trans('general.crearDocumentos'))

@section('css')

@stop

@section('content_header')

    <div class="card card card-navy bg-navy">
        <div class="row">
            <div class="col-1">
                <a href="{{ route('docs.index') }}" type="button" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="col-11 text-center">
                <h4 class="p-3">{{ strtoupper(trans('general.crearDocumentos'))}}</h4>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-outline card-dark p-3">
        <document-create-form-component></document-create-form-component>
    </div>

@stop

@section('footer')
    @include('layouts.footer')
@stop

@section('js')

@stop
