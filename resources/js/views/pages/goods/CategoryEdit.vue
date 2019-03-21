<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>分类编辑</span>
        </div>
        <el-form ref="categoryForm" :rules="rules" :model="categoryForm" label-width="100px">
            <el-form-item label="分类名称" prop="name">
                <el-input v-model="categoryForm.name"/>
            </el-form-item>
            <el-form-item label="上级分类">
                <label>{{parentName}}</label>
            </el-form-item>
            <el-form-item label="排序优先级" prop="sortOrder">
                <el-input v-model="categoryForm.sortOrder"/>
            </el-form-item>
            <el-form-item label="首页热推" prop="isRecom" v-if="parentId === '0'">
                <el-radio v-model="categoryForm.isRecom" label="0">否</el-radio>
                <el-radio v-model="categoryForm.isRecom" label="1">是</el-radio>
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
                        list-type="picture-card">
                    <i class="el-icon-plus"></i>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="添加分类" class="clearfix">
                <el-transfer
                        v-model="categoryForm.brandIds"
                        :titles="['所有品牌', '当前分类已选']"
                        :data="brandList"
                        :props="transferProp">
                </el-transfer>
            </el-form-item>
            <el-button type="primary" @click="onSubmit('create')" v-if="type==='create'">立即创建</el-button>
            <el-button type="primary" @click="onSubmit('update')" v-else>立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";
    import router from "../../../router";

    export default {
        name: "CategoryEdit",
        data: function () {
            return {
                categoryForm: {
                    id: "",
                    name: "",
                    parentId: 0,
                    sortOrder: 0,
                    imageUrl: "",
                    isRecom: "0",
                    brandIds: []
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
                    type: "logo",
                    position: "category"
                },
                type: "crate",
                categoryId: "",
                transferProp: {
                    key: 'id',
                    label: 'name'
                },
                brandList: [],
                existList: [],
                category: "",
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                type = that.$route.query.type,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.type = type;
            if (type === "create") {
                that.parentId = that.$route.query.parentId;
                that.parentName = that.$route.query.parentName;
            } else {
                let categoryId = that.$route.query.categoryId;
                that.categoryId = categoryId;
                axios.get("/category/detail?id=" + categoryId + "&admin_id=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        if (res.data.code === 2000) {
                            let data = res.data.data;
                            that.categoryForm = {
                                id: data.id,
                                name: data.name,
                                parentId: data.parent_id,
                                sortOrder: data.sort_order,
                                imageUrl: data.image_url,
                            };
                        }
                    }).catch(err => {
                });
            }
            axios.get("brand/list" + "?admin_id=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.brandList = res.data.data;
                    }
                }).catch(err => {
            });
            axios.get("brand/list-category?categoryId=" + that.categoryId + "&admin_id=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        // let brandIds = [];
                        let exists = res.data.data;
                        for (let exist of exists) {
                            that.categoryForm.brandIds.push(exist.id);
                        }
                        // that.categoryForm.brandIds = brandIds;
                    }
                }).catch(err => {
            });
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.categoryForm.validate((valid) => {
                    if (valid) {
                        that.categoryForm.token = that.token;
                        that.categoryForm.adminId = that.adminId;
                        if (that.type === "create") {
                            that.categoryForm.parentId = that.parentId;
                            axios.post("category/create", that.categoryForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        router.push("/category-list");
                                    }
                                }).catch(err => {
                            });
                        } else {
                            axios.post("/category/update", that.categoryForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        router.push("/category-list");
                                    }
                                }).catch(err => {
                            });
                        }
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