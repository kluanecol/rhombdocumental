@extends('adminlte::page')
@section('title', 'RHOMB FILES | Home')

@section('css')

@stop

@section('content_header')
    <div class="card card card-navy bg-navy">
        <h1 class="p-4">Gestión Documental</h1>
    </div>
@stop

@section('content')

    <div class="card card-outline card-dark">
        <p>El módulo de gestión documental implementado en Kluane Drilling revoluciona la eficiencia operativa al
            digitalizar y organizar de manera jerárquica los documentos clave de la empresa. Con funciones avanzadas de
            búsqueda y controles de acceso, el sistema agiliza la recuperación de información y garantiza la seguridad de
            datos sensibles. Facilitando la colaboración entre equipos, este módulo se erige como una herramienta integral
            que no solo mejora la productividad, sino que también posiciona a Kluane Drilling a la vanguardia en la gestión
            documental en un entorno empresarial competitivo.</p>
        {{--<example-component :users="{{ json_encode($users) }}" />--}}
    </div>
@stop

@section('footer')
    @include('layouts.footer')
@stop

@section('js')

@stop
