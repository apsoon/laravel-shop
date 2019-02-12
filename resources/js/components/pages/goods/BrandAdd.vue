<template>
    <div>
        <el-form ref="brandForm" :rules="rules" :model="brandForm" label-width="100px">
            <el-form-item label="品牌名称" prop="name">
                <el-input v-model="brandForm.name"></el-input>
            </el-form-item>
            <el-form-item label="品牌描述" prop="describe">
                <el-input v-model="brandForm.describe"></el-input>
            </el-form-item>
            <el-form-item label="所属地区" prop="region">
                <el-input v-model="brandForm.region"></el-input>
            </el-form-item>
            <el-form-item label="品牌LOGO">
                <el-upload
                        class="upload-demo"
                        action=""
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :before-remove="beforeRemove"
                        :limit="1"
                        :file-list="fileList">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="是否启用" prop="state">
                <el-radio v-model="brandForm.state" label="0">禁用</el-radio>
                <el-radio v-model="brandForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "BrandAdd",
        data: function () {
            return {
                brandForm: {
                    name: "",
                    describe: "",
                    region: "",
                    logo: "",
                    state: "0"
                },
                rules: {
                    name: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.brandForm.validate((valid) => {
                    if (valid) {
                        axios.post("brand/create", that.brandForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$message({
                                        type: 'success',
                                        message: '添加成功!'
                                    });
                                    setTimeout(() => {
                                        that.$router.push("brand-list");
                                    }, 1000);
                                }
                            });

                    } else {
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>