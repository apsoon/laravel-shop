<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>编辑管理员</span>
        </div>
        <el-form ref="adminForm" :rules="rules" :model="adminForm" label-width="100px">
            <el-form-item prop="name" label="名称">
                <el-input v-model="adminForm.name" placeholder="请输入管理员名称"/>
            </el-form-item>
            <el-form-item prop="email" label="邮箱">
                <el-input v-model="adminForm.email" type="email" placeholder="请输入管理员邮箱"/>
            </el-form-item>
            <el-form-item prop="phone" label="手机">
                <el-input v-model="adminForm.phone" type="tel" placeholder="请输入管理员电话"/>
            </el-form-item>
            <el-form-item prop="password" label="密码">
                <el-input v-model="adminForm.password" type="password" placeholder="请输入管理员密码" show-password/>
            </el-form-item>
            <el-form-item prop="confirm" label="确认密码">
                <el-input v-model="adminForm.confirm" type="password" placeholder="请再次输入管理员密码" show-password/>
            </el-form-item>
        </el-form>
        <el-button type="primary" @click="onCreate" v-if="type === 'create'">立即创建</el-button>
        <el-button type="primary" @click="onUpdate" v-else>修改</el-button>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdminEdit",
        data: function () {
            let validatePasswordConfirm = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入管理员密码'));
                } else if (value !== this.adminForm.password) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return {
                adminForm: {
                    name: "",
                    email: "",
                    phone: "",
                    password: "",
                    confirm: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入管理员名称', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '请输入管理员邮箱', trigger: 'blur'}
                    ],
                    phone: [
                        {required: true, message: '请输入管理员电话', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入管理员密码', trigger: 'blur'}
                    ],
                    confirm: [
                        {validator: validatePasswordConfirm, trigger: 'blur'}
                    ],
                },
                password: "",
                confirm: "",
                type: "create"
            }
        },
        mounted: function () {
            let that = this,
                type = that.$route.query.type;
            that.type = type;
        },
        methods: {
            onCreate: function () {
                let that = this;
                axios.post("admin/create", that.adminForm)
                    .then(res => {
                        if (res.data.code === 2000) {
                            that.$router.push("/admin-list");
                        }
                    }).catch(err => {
                });
            },
            onUpdate: function () {

            }
        },
    }
</script>

<style scoped>

</style>