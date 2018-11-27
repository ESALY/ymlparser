<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <el-row>
                            <el-button>Default</el-button>
                            <el-button type="primary">Primary</el-button>
                            <el-button type="success">Success</el-button>
                            <el-button type="info">Info</el-button>
                            <el-button type="warning">Warning</el-button>
                            <el-button type="danger">Danger</el-button>
                        </el-row>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                count: 0,
            }
        },
        mounted() {
            this.count = 1;
            console.log('Component mounted.');
            this.update();
        },
        methods: {
            update: function(){
                axios.get('/get-json').then((response)=> {
                    console.log(response.data);
                });
            }
        }
    }
</script>
