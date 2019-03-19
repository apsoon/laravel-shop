<template>
    <el-form :model="loginForm" :rules="rules2" ref="loginForm" label-position="left" label-width="0px"
             class="demo-ruleForm login-container">
        <h3 class="title">系统登录</h3>
        <el-form-item prop="name">
            <el-input type="text" v-model="loginForm.name" auto-complete="off" placeholder="账号"></el-input>
        </el-form-item>
        <el-form-item prop="password">
            <el-input type="password" v-model="loginForm.password" auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-form-item style="width:100%;">
            <el-button type="primary" style="width:100%;" @click.native.prevent="onLogin" :loading="logining">登录
            </el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import md5 from "md5";

    export default {
        name: "Login",
        data() {
            return {
                logining: false,
                loginForm: {
                    name: 'admin',
                    password: '123456'
                },
                rules2: {
                    name: [
                        {required: true, message: '请输入账号', trigger: 'blur'},
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                    ]
                },
                checked: true
            };
        },
        methods: {
            onLogin(ev) {
                let that = this;
                that.$refs.loginForm.validate((valid) => {
                    if (valid) {
                        that.logining = true;
                        let loginParams = {name: that.loginForm.name, password: md5(that.loginForm.password)};
                        this.requestLogin(loginParams).then(res => {
                            this.logining = false;
                            console.info(res);
                            if (res.code !== 2000) {
                                that.$message({
                                    message: res.message,
                                    type: 'error'
                                });
                            } else {
                                that.$message({
                                    message: "登录成功",
                                    type: 'success'
                                });
                                sessionStorage.setItem('user', JSON.stringify(res.data));
                                that.$router.push({path: '/index'});
                            }
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            requestLogin: function (params) {
                return axios.post('/admin/login', params).then(res => res.data);
            }
        }
    }
</script>

<style lang="scss" scoped>

    .login-container {
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        background-clip: padding-box;
        margin: 180px auto;
        width: 350px;
        padding: 35px 35px 15px 35px;
        background: #fff;
        border: 1px solid #eaeaea;
        box-shadow: 0 0 25px #cac6c6;
        .title {
            margin: 0px auto 40px auto;
            text-align: center;
            color: #505458;
        }
        .remember {
            margin: 0px 0px 35px 0px;
        }
    }
</style>