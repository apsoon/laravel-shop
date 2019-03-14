<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link :to="{path: '/admin-edit', query: {type: 'create'}}">
                <el-button type="primary" size="medium">添加管理员</el-button>
            </router-link>
        </div>
        <el-table ref="adminList" :data="adminList" tooltip-effect="dark" width="100%">
            <el-table-column label="编号" prop="id" width="150"/>
            <el-table-column label="名称" prop="name" width="150"/>
            <el-table-column label="电话" prop="phone" width="150"/>
            <el-table-column label="邮箱" prop="email" width="200"/>
            <el-table-column label="注册时间" prop="created_at" width="200"/>
            <el-table-column label="操作" min-width="1">
                <template slot-scope="scope">
                    <el-button type="primary" size="medium" @click="modifyPassword(scope.$index, scope.row.id)">修改密码
                    </el-button>
                    <el-button type="warning" size="medium" @click="modifyPassword(scope.$index, scope.row.id)">禁用
                    </el-button>
                    <el-button type="danger" size="medium" @click="modifyPassword(scope.$index, scope.row.id)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdminList",
        data: function () {
            return {
                adminList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/admin/list")
                .then(res => {
                    if (res.data.code === 2000) {
                        that.adminList = res.data.data;
                    }
                }).catch(err => {
            });
        },
        methods: {
            modifyPassword: function () {
                let that = this;
            }
        }
    }
</script>

<style scoped>

</style>