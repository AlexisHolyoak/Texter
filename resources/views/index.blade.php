@extends('app')

@section('content')

<form  method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <br>
        <div id="alertContainer"> </div>        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
                
        </ul>
        
        <div class="tab-content" id="myTabContent">            
            
        </div>                
    </div>
</form>


@endsection
