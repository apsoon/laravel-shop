<template>
    <el-card>
        <div slot="header" class="clearfix">

        </div>
        <el-table ref="commentList" :data="commentList" tooltip-effect="dart" width="100%">
            <el-table-column>

            </el-table-column>
            <el-table-column
                    prop=""
                    width="300"
                    label="操作">
                <template slot-scope="scope">
                    <router-link :to="{path: '/brand-add',query :{type: 'modify', brandId:scope.row.id}}">
                        <el-button size="mini" type="info">修改</el-button>
                    </router-link>
                    <el-button v-if="scope.row.state"
                               size="mini"
                               type="warning"
                               @click="modifyState('disable', scope.$index, scope.row.id)">禁用
                    </el-button>
                    <el-button v-else
                               size="mini"
                               type="success"
                               @click="modifyState('enable', scope.$index, scope.row.id)">启用
                    </el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteBrand(scope.$index, scope.row.id)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "CommentList",
        data: function () {
            return {
                commentList: [],
                pageNo: 1
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/comment/list?pageNo=" + that.pageNo)
                .then(res => {
                    if (res.code === 2000) {
                        that.commentList = res.data.data;
                    }
                })
                .catch(err => {

                });
        },
        methods: {}

    }
</script>

<style scoped>

</style>