<template>
    <div>
        <el-form ref="categoryForm" :rules="rules" :model="categoryForm" label-width="100px;">
            <el-form-item label="分类名称" prop="name">
                <el-input v-model="categoryForm.name"></el-input>
            </el-form-item>
            <el-form-item label="上级分类" prop="pid">

            </el-form-item>
            <el-form-item label="排序优先级" prop="sort_order">
                <el-input v-model="categoryForm.name"></el-input>
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
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "CategoryAdd",
        data: function () {
            return {
                categoryForm: {
                    name: "",
                    pid: 0,
                    sort_order: 0
                },
                rules: {},
                categoryList: []
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
        }
    }
</script>

<style scoped>

</style>