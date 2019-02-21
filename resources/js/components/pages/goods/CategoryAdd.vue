<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>添加分类</span>
        </div>
        <el-form ref="categoryForm" :rules="rules" :model="categoryForm" label-width="100px;">
            <el-form-item label="分类名称" prop="name">
                <el-input v-model="categoryForm.name"></el-input>
            </el-form-item>
            <el-form-item label="上级分类">
                <label>{{parentName}}</label>
            </el-form-item>
            <el-form-item label="排序优先级" prop="sortOrder">
                <el-input v-model="categoryForm.sortOrder"></el-input>
            </el-form-item>
            <el-form-item label="添加图片">
                <el-upload
                        class="upload-demo"
                        action="/upload/image"
                        :headers="uploadHeader"
                        :on-success="onUploadSuccess"
                        :on-error="onUploadFailed"
                        :on-remove="onUploadFileRemoved"
                        :limit="1"
                        :data="uploadData"
                        :file-list="imageList"
                        list-type="picture">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";
    import router from "../../../router";

    export default {
        name: "CategoryAdd",
        data: function () {
            return {
                categoryForm: {
                    name: "",
                    parentId: 0,
                    sortOrder: 0,
                    imageUrl: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入商品名称', trigger: 'blur'}
                    ]
                },
                parentId: 0,
                parentName: "",
                uploadHeader: {},
                imageList: [],
                uploadData: {
                    type: "ad",
                    position: "banner"
                }
            }
        },
        mounted: function () {
            let that = this;
            that.parentId = that.$route.query.parentId;
            that.parentName = that.$route.query.parentName;
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.categoryForm.validate((valid) => {
                    if (valid) {
                        that.categoryForm.parentId = that.parentId;
                        axios.post("category/create", that.categoryForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    router.push("/category-list");
                                }
                            })
                            .catch(err => {

                            })

                    }
                });
            },
            handleTreeClick: function (data, checked, node) {
                let that = this;
                console.info("data = ", data, ", checked = ", checked, ", node = ", node);
                if (checked) {
                    this.$refs.treeCategory.setCheckedNodes([]);
                    this.$refs.treeCategory.setCheckedNodes([data]);
                }
            },
            onUploadSuccess: function (response, file, fileList) {
                let that = this;
                if (response.code === 2000) {
                    let categoryForm = that.categoryForm;
                    categoryForm.imageUrl = response.data.filePath;
                    that.categoryForm = categoryForm;
                }
            },
            onUploadFailed: function (err, file, fileList) {
                // TODO 上传失败
            },
            onUploadFileRemoved: function (file, fileList) {
                let that = this;
                // TODO 删除文件
                let categoryForm = that.categoryForm;
                categoryForm.imageUrl = "";
                that.categoryForm = categoryForm;
            },
        }
    }
</script>

<style scoped>


</style>