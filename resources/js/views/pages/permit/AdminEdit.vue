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
                <el-input v-model="adminForm.email" placeholder="请输入管理员邮箱"/>
            </el-form-item>
            <el-form-item prop="phone" label="手机">
                <el-input v-model="adminForm.phone" placeholder="请输入管理员电话"/>
            </el-form-item>
            <el-form-item prop="password" label="密码">
                <el-input v-model="adminForm.password" placeholder="请输入管理员密码"/>
            </el-form-item>
            <el-form-item prop="confirm" label="确认密码">
                <el-input v-model="adminForm.confirm" placeholder="请再次输入管理员密码"/>
            </el-form-item>
        </el-form>
        <el-button type="primary" @click="onCreate" v-if="type === 'create'">立即创建</el-button>
        <el-button type="primary" @click="onUpdate" v-else>修改</el-button>
    </el-card>
</template>

<script>
    export default {
        name: "AdminEdit",
        data: function () {
            return {
                adminForm: {
                    name: "",
                    email: "",
                    phone: "",
                    password: ""
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
                        {required: true, message: '请再次输入管理员密码', trigger: 'blur'}
                    ],
                },
                pwd: "",
                confirm: "",
                type: "create"
            }
        },
        mounted: function () {
            let that = this,
                type = that.$route.query.type;
            that.type = type;
        },
        methods: function () {

        },
    }
</script>

<style scoped>

</style>