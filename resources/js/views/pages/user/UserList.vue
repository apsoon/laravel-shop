<template>
    <el-card shadow=" never">
        <div slot="header" class="clearfix">
            <span>用户列表</span>
        </div>
        <el-table ref="userList" :data="userList" tooltip-effect="dark" width="100%" v-loading="loading">
            <el-table-column prop="nickname" label="昵称" width="150"/>
            <el-table-column prop="avatar_url" label="头像" width="150">
                <template slot-scope="scope">
                    <img class="avatar" :src="scope.row.avatar_url"/>
                </template>
            </el-table-column>
            <el-table-column prop="phone" label="电话" width="150"/>
            <el-table-column prop="created_at" label="注册时间" min-width="1"/>
        </el-table>
        <el-pagination background layout="total, sizes, prev, pager, next, jumper"
                       :total="1000"
                       :page-sizes="[20, 50, 100]"
                       :page-size="20"
                       @current-change="onPageNoChanged"
                       :current-page.sync="pageNo"
                       style="margin-top: 20px; margin-bottom: 20px; float: right;"/>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "UserList",
        data: function () {
            return {
                userList: [],
                pageNo: 1,
                loading: true
            }
        },
        mounted: function () {
            let that = this;
            axios.get("user/list-page?pageNo=" + 1)
                .then(res => {
                    that.loading = false;
                    if (res.data.code === 2000) {
                        that.userList = res.data.data;
                    }
                }).catch(err => {
            });
        },
        methods: {
            onPageNoChanged: function () {
            }
        }
    }
</script>

<style scoped>
    .avatar {
        width: 48px;
        height: 48px;
    }
</style>