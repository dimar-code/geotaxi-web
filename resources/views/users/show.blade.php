@extends('layout')

@section('contenido')
    <h1>{{ $user->nombre }}</h1>
    <table class="table">
        <tr>
            <th>Nombre:</th>
            <td>{{ $user->nombre }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Roles:</th>            
            <td>@foreach($user->roles as $role)
                {{ $role->display_name }}
            @endforeach</td>
        </tr>
    </table>
    @can('edit', $user)
        <a class="btn btn-info" href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
    @endcan
    @can('destroy', $user)
        <form style="display: inline" method="POST" action="{{ route('usuarios.destroy', $user->id) }}">
            {!! method_field('DELETE') !!}
            {!! csrf_field() !!}
            <button class="btn btn-danger" type="submit">Eliminar</button>
        </form>
    @endcan
@stop