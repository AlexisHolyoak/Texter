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
    @foreach ($note as $notes)
    <tr>
{{ $note->title }}
        </tr>
        <tr>
            <a href="{{ route('note.edit',$note) }}">Edit</a>
        </tr>
    @endforeach

</tbody>
</table>
@endsection
