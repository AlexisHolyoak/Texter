@extends('app')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>
                Titulo
            </th>
            <th>
                Acciones
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($notes as $note)
        <tr>
            <td>
                {{ $note->title }}
            </td>

            <td>
                <a href="{{ route('note.edit',$note) }}">Abrir</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
