<template>
    <div>
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
                            @click="handleDelete(scope.$index, scope.row)">修改
                    </el-button>
                    <el-button
                            size="mini"
                            type="success"
                            @click="handleDelete(scope.$index, scope.row)">启用
                    </el-button>
                    <el-button
                            size="mini"
                            type="warning"
                            @click="handleDelete(scope.$index, scope.row)">禁用
                    </el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
    export default {
        name: "AdList",
        data() {
            return {
                adList: [
                    {
                        name: "123",
                        position: "123"
                    },
                    {}
                ]
            }
        },
        mounted:{

        }
    }
</script>

<style scoped>

</style>