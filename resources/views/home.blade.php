@extends('layouts.app')

@section('content')
    <div id="app">
    <el-container  :style="{ height: window.height + 'px' }">
        <el-aside width="300px">
            {{--Aside--}}
            <div class="search">
                <el-form :label-position="top" label-width="100px" :model="searchForm">
                    <el-form-item label="Name">
                        <el-input v-model="searchForm.name"></el-input>
                    </el-form-item>
                    <el-form-item label="Activity zone">
                        <el-input v-model="searchForm.region"></el-input>
                    </el-form-item>
                    <el-form-item label="Activity form">
                        <el-input v-model="searchForm.type"></el-input>
                    </el-form-item>
                </el-form>
            </div>
        </el-aside>
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
                searchForm: {
                    name: '',
                    region: '',
                    type: ''
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