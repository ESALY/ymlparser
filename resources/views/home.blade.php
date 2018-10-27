@extends('layouts.app')

@section('content')
    <div id="app">
    <el-container style="height: -webkit-fill-available;">
        <el-aside width="200px">Aside</el-aside>
        <el-container>
            <el-header>Header</el-header>
            <el-main>
                @{{hello}}
            </el-main>
            <el-footer>
                {{--Footer--}}
                Width: @{{ window.width }},
                Height: @{{ window.height }}
            </el-footer>
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
                window: {
                    width: 0,
                    height: 0
                },
                hello: 'im vue',
            },
            methods: {
                handleResize() {
                    this.window.width = window.innerWidth;
                    this.window.height = window.innerHeight;
                }
            },
            mounted() {
                this.$nextTick(() => {

                })
            },
            created() {
                window.addEventListener('resize', this.handleResize)
                this.handleResize();
            },
            destroyed() {
                window.removeEventListener('resize', this.handleResize)
            }
        });


    </script>

@endsection