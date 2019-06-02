@extends('app')

@section('content')

<form  method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <br>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="new_1-tab" data-toggle="tab" href="#new_1" role="tab" aria-controls="new_1" aria-selected="true">New 1</a>
            </li>        
        </ul>
        
        <div class="tab-content" id="myTabContent">            
            <div class="tab-pane fade show active" id="new_1" role="tabpanel" aria-labelledby="new_1-tab">                            
                <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80" required></textarea>                                           
            </div>
        </div>                
    </div>
</form>


@endsection
