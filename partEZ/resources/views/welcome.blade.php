@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.

                    Invite Email test: <button onclick="send()"><i class="fa fa-envelope"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function send(){
        alert("heyyyy");
    }
</script>

@endsection
