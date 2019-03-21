<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>添加属性组</span>
        </div>
        <el-form ref="attrGroupForm" :rules="rules" :model="attrGroupForm" label-width="100px">
            <el-form-item label="属性组名称" prop="name">
                <el-input v-model="attrGroupForm.name"></el-input>
            </el-form-item>
            <el-form-item label="所属分类" prop="categoryId">
                <el-cascader
                        :show-all-levels="false"
                        expand-trigger="hover"
                        :options="categoryList"
                        :props="categoryProps"
                        :change-on-select="true"
                        :change="onCategoryChange()"
                        filterable
                        v-model="category">
                </el-cascader>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AttrGroupAdd",
        data: function () {
            return {
                attrGroupForm: {
                    name: "",
                    categoryId: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入属性组名称', trigger: "blur"}
                    ],
                    categoryId: [
                        {required: true, message: '请输入属性组名称', trigger: "blur"}
                    ]
                },
                categoryProps: {
                    value: 'id',
                    children: 'children',
                    label: 'name'
                },
                categoryList: [],
                category: [],
                token: "",
                adminId: "",
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            axios.get("category/treeList" + "?adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.categoryList = res.data.data;
                    }
                }).catch(err => {
            });
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.attrGroupForm.validate((valid) => {
                    if (valid) {
                        that.attrGroupForm.token = that.token;
                        that.attrGroupForm.adminId = that.adminId;
                        axios.post("/attrGroup/create", that.attrGroupForm)
                            .then(res => {
                                if (res.data.code === 2000) {

                                }
                            }).catch(err => {

                        });
                    }
                });
            },
            onCategoryChange: function () {
                let that = this;
                if (that.category) that.attrGroupForm.categoryId = that.category[that.category.length - 1];
            }
        }
    }
</script>

<style scoped>

</style>