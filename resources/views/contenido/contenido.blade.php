@extends('principal')
@section('contenido')

    <template v-if="menu==1">
    <producto :ruta="ruta"></producto>
    </template>
    <template v-if="menu==2">
    <proveedor :ruta="ruta"></proveedor>
    </template>
    <template v-if="menu==3">
    <usuario :ruta="ruta"></usuario>
    </template>
    <template v-if="menu==4">
    <factura :ruta="ruta"></factrua>
    </template>
@endsection