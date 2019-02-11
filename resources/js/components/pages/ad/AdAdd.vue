<template>
    <div>
        <el-form ref="adForm" :rules="rules" :model="adForm" label-width="100px">
            <el-form-item label="广告名称" prop="name">
                <el-input v-model="adForm.name"></el-input>
            </el-form-item>
            <el-form-item label="广告描述">
                <el-input v-model="adForm.desc"></el-input>
            </el-form-item>
            <el-form-item label="广告位置">
                <el-dropdown>
                    <el-button type="primary" size="small">
                        请选择<i class="el-icon-arrow-down el-icon--right"></i>
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item v-model="adForm.position">黄金糕</el-dropdown-item>
                        <el-dropdown-item>狮子头</el-dropdown-item>
                        <el-dropdown-item>螺蛳粉</el-dropdown-item>
                        <el-dropdown-item>双皮奶</el-dropdown-item>
                        <el-dropdown-item>蚵仔煎</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-form-item>
            <el-form-item label="排序">
                <el-input v-model="adForm.sort_order"></el-input>
            </el-form-item>
            <el-form-item label="添加图片">
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
            <el-form-item label="是否启用">
                <el-radio v-model="adForm.state" label="0">禁用</el-radio>
                <el-radio v-model="adForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdAdd",
        data() {
            return {
                adForm: {
                    name: '',
                    desc: '',
                    sort_order: 1,
                    state: "0",
                    position:"",
                },
                rules: {
                    name: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'},
                        {min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                }
            }
        },
        mounted: function () {
            axios.get("adPosition/list").then(res => {

            });
        },
        methods: {
            onSubmit() {
                this.$refs["adForm"].validate((valid) => {
                    if (valid) {
                        console.info(this.adForm);
                        axios.post("ad/create")
                            .then(res => {
                                console.info(res);
                            });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>