@extends('app')

@section('content')

<form action="{{ route('note.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="">Nombre de documento:</label>
            <input type="text" class="form-control" name="title" required>
            <br>
            <textarea class="ckeditor"  name="content" id="editor1" rows="10" cols="80" required></textarea>
            <br>
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
</form>


@endsection
