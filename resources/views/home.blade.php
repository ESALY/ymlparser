@extends('layouts.app')

@section('content')
    <div id="app">
    <el-container style="height: -webkit-fill-available;">
        <el-aside width="200px">Aside</el-aside>
        <el-container>
            <el-header>Header</el-header>
            <el-main>
                @{{hello}}
                <p>My BoundingClientRect is: @{{ pRect }}<p>
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
                pRect: 0,
                hello: 'im vue',
            },
            methods:{}
            ,
            created: function(){
            },
            mounted() {
                this.$nextTick(() => {
                    this.pRect = document.querySelector('body').getBoundingClientRect();
                })
            }
        });


    </script>

@endsection