@extends('app')

@section('content')

<form action="{{ route('note.update',$note) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="">Write title</label>
            <input type="text" class="form-control" value="{{ $note->title }}" name="title" required>
            <br>
            <textarea class="ckeditor"  id="editor1" rows="10" cols="80" name="content" required>{{ $note->content }}</textarea>
            <br>
            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </div>
</form>


@endsection
