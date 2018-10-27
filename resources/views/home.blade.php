@extends('layouts.app')

@section('content')
    <div id="app">
        @{{hello1}}
    </div>
    {{--<script src="{{ asset('/js/app.js') }}"></script>--}}

    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // bootstrap the demo
        var vapp = new Vue({
            el: '#app',
            data: {
                hello: 'im vue',
            },
            methods:{}
            ,
            created: function(){
            }
        });


    </script>

@endsection