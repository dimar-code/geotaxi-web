@extends('layouts.app')

@section('contenido')
    <h1>Usuarios</h1>
    @if (auth()->user()->hasRoles(['admin']))
        <a class="btn btn-primary float-right" href="{{ route('register') }}">Crear nuevo usuario</a>
    @endif
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Role</th>
            <th>Notas</th>
            @if (auth()->user()->hasRoles(['admin']) )
                <th>Acciones</th>
            @endif
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{!! $user->present()->link() !!}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->present()->roles() }}</td>
                    <td>{{ $user->present()->notes() }}</td>
                    @if (auth()->user()->hasRoles(['admin']) )
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('usuarios.edit', $user->id) }}">Editar</a>

                        <form style="display: inline" method="POST" action="{{ route('usuarios.destroy', $user->id) }}">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
            {!! $users->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </tbody>
    </table>
@stop