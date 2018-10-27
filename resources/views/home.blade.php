@extends('layouts.app')

@section('content')
    <div id="app">
    <el-container>
        <el-aside width="200px">Aside</el-aside>
        <el-container>
            <el-header>Header</el-header>
            <el-main>
                @{{hello}}
            </el-main>
            <el-footer>Footer</el-footer>
        </el-container>
    </el-container>
    </div>
    </div>
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