@extends('app')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>
                title
            </th>
            <th>
                Actions
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
                <a href="{{ route('note.edit',$note) }}">Edit</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
