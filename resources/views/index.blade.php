@extends('app')

@section('content')

<form action="{{ route() }}">
    <div class="form-group">
        <label for="">Write title</label>
            <input type="text" class="form-control" name="title">
            <br>
            <textarea class="ckeditor"  name="content" id="editor1" rows="10" cols="80"></textarea>
            <br>
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
</form>


@endsection
