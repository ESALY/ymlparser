@extends('layouts.app_mobile')

@section('content')
    <router-view></router-view>
    <router-link to="/mobile">Navigate to Home</router-link>
    <router-link to="/mobile/dialogs">Navigate to Dialogs</router-link>
@endsection
