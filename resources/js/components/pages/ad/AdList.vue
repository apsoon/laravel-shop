<template>
    <div>
        <router-link to="/ad-add">
            <el-button>添加广告</el-button>
        </router-link>
        <el-table
                ref="multipleTable"
                :data="adList"
                tooltip-effect="dark"
                style="width: 100%">
            <el-table-column
                    type="selection"
                    width="55">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="名称"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="position"
                    label="位置"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="sort_order"
                    label="排序"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="状态"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop=""
                    label="操作">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="">修改
                    </el-button>
                    <el-button v-if="scope.row.state"
                               size="mini"
                               type="warning"
                               @click="">禁用
                    </el-button>
                    <el-button v-else
                               size="mini"
                               type="success"
                               @click="">启用
                    </el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdList",
        data() {
            return {
                adList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get('ad/list').then(res => {
                that.adList = res.data.data;
            });
        },
        methods: {}
    }
</script>

<style scoped>

</style>