@extends('layouts.app_original')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<example></example>
                        <router-view></router-view>
                        <router-link to="/home">Navigate to Page2</router-link>
                        <router-link to="/dialogs">Navigate to Dialogs</router-link>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
