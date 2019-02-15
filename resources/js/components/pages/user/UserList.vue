<template>
    <el-card>
        <span>用户列表</span>
        <el-table
                ref="userList"
                :data="userList"
                tooltip-effect="dark"
                width="100%">
            <el-table-column
                    prop="nickname"
                    label="昵称"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="avatar_url"
                    label="头像"
                    width="150">
                <template slot-scope="scope">
                    <img class="avatar" :src="scope.row.avatar_url"/>
                </template>
            </el-table-column>
            <el-table-column
                    prop="phone"
                    label="电话"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="注册时间"
                    min-width="1">
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "UserList",
        data: function () {
            return {
                userList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get("user/list-page?pageNo=" + 1)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.userList = res.data.data;
                    }
                })
                .catch(err => {

                });
        },
        methods: {}
    }
</script>

<style scoped>
    .avatar {
        width: 48px;
        height: 48px;
    }
</style>