@extends('layouts.app')

@section('content')
    <div id="app">
        <el-container  :style="{ height: window.height + 'px' }">
            <el-aside width="300px">
                {{--Aside--}}
            </el-aside>
            <el-container>
                <el-header>Header</el-header>
                <el-main>
                    <div  class="product">

                    </div>
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
        var app = new Vue({
            el: '#app',
            data: {
                products: [],
                window: {
                    width: 0,
                    height: 0
                },
                searchForm: {
                    labelPosition: 'top',
                    name: '',
                    region: '',
                    type: ''
                },
                hello: 'im vue',
            },
            methods: {
                init: function () {
                    this.getItems();
                },
                showProduct: function () {
                    console.log(12);
                },
                getItems: function () {

                    var name = '';

                    if(this.searchForm.name !== undefined){
                        name = this.searchForm.name;
                    }

                    axios.post('https://tranquil-spire-73723.herokuapp.com/items/get', {
                        name: name
                    })
                        .then(function (response) {
                            console.log(response.data);
                            app.products = response.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                handleResize() {
                    this.window.width = window.innerWidth;
                    this.window.height = window.innerHeight;
                }
            },
            mounted() {

            },
            created() {
                window.addEventListener('resize', this.handleResize)
                this.handleResize();
                this.init();
            },
            destroyed() {
                window.removeEventListener('resize', this.handleResize)
            }
        });


    </script>

@endsection