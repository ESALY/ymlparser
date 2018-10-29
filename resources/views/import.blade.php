@extends('layouts.app')

@section('content')
    <div id="app">
    <el-container  :style="{ height: window.height + 'px' }">
        <el-aside width="300px">
            {{--Aside--}}
        </el-aside>
        <el-container>
            <el-header>
                {{--Header--}}
                <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
                    <el-menu-item index="1"><a href="{{URL::to('/')}}" target="_blank">Products</a></el-menu-item>
                    <el-menu-item index="2"><a href="{{URL::to('/import')}}" target="_blank">Import</a></el-menu-item>
                </el-menu>
            </el-header>
            <el-main>
                <el-row>
                    <el-col :span="12">
                        <el-form :label-position="importForm.labelPosition" label-width="100px" :model="importForm">
                            <el-form-item label="Импорт товаров">
                                <el-input v-model="importForm.name" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="importProducts()">Импортировать</el-button>
                            </el-form-item>
                        </el-form>
                    </el-col>
                </el-row>


            </el-main>
            <el-footer>
                {{--Footer--}}
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
                activeIndex: 1,
                window: {
                    width: 0,
                    height: 0
                },
                importForm: {
                    labelPosition: 'top',
                    name: ''
                }
            },
            methods: {
                init: function () {
                    this.getItems();
                },
                showProduct: function () {
                   console.log(12);
                },
                importProducts: function () {

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