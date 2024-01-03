@extends('adminlte::page')
@section('title', 'RHOMB FILES | ' . trans('general.documentos'))

@section('css')

@stop

@section('content_header')
    <div class="card card card-navy bg-navy">
        <h1 class="p-4">{{ trans('general.gestionDocumentos') }}</h1>
    </div>
@stop

@section('content')

    <div class="card card-outline card-dark p-3">

        <document-index-component />

    </div>
@stop

@section('footer')
    @include('layouts.footer')
@stop

@section('js')

@stop
