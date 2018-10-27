@extends('layouts.app')

@section('content')
    <div id="app">
    <el-container  :style="{ height: window.height + 'px' }">
        <el-aside width="300px">
            {{--Aside--}}
            <div class="search-wrapper">
                <el-form :label-position="searchForm.labelPosition" label-width="100px" :model="searchForm">
                    <el-form-item label="Поиск">
                        <el-input v-model="searchForm.name"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="submitForm('searchForm')">Искать</el-button>
                        <el-button @click="resetForm('ruleForm')">Сбросить</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </el-aside>
        <el-container>
            <el-header>Header</el-header>
            <el-main>
                <div  class="products">
                    <template>
                        <el-table
                                :data="products"
                                style="width: 100%">
                            <el-table-column
                                    prop="name"
                                    label="Name"
                                    width="180">
                            </el-table-column>
                        </el-table>
                    </template>
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
                    axios.get('/items/get')
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
                this.init();
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