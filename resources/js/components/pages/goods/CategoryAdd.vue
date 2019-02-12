<template>
    <div>
        <el-form ref="categoryForm" :rules="rules" :model="categoryForm" label-width="100px;">
            <el-form-item label="分类名称" prop="name">
                <el-input v-model="categoryForm.name"></el-input>
            </el-form-item>
            <el-form-item label="上级分类">
                <el-tree :data="categoryList"
                         label="234"
                         empty-text="没有其他分类"
                         check-strictly
                         node-key="id"
                         @check-change="handleTreeClick"
                         ref="treeCategory"
                         show-checkbox style="margin-left: 100px;">

                </el-tree>
            </el-form-item>
            <el-form-item label="排序优先级" prop="sort_order">
                <el-input v-model="categoryForm.sort_order"></el-input>
            </el-form-item>
            <el-form-item label="添加图片">
                <el-upload
                        class="upload-demo"
                        :limit="1"
                        :file-list="fileList"
                        action=""
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :before-remove="beforeRemove">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
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
                    parent_id: 0,
                    sort_order: 0,
                    image_url: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入商品名称', trigger: 'blur'}
                    ]
                },
                categoryList: [],
            }
        },
        mounted: function () {
            let that = this;
            axios.get("category/treeList").then(res => {
                if (res.data.code === 2000) {
                    that.categoryList = res.data.data;
                    console.info(that.categoryList);
                }
            }).catch(err => {
            });
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.categoryForm.validate((valid) => {
                    if (valid) {
                        let key = that.$refs.treeCategory.getCheckedKeys();
                        if (key.length) that.categoryForm.parent_id = key[0];
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
            }
        }
    }
</script>

<style scoped>


</style>