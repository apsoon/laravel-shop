<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>编辑商品</span>
        </div>
        <el-form ref="spuForm" :rules="rules" :model="spuForm" label-width="100px">
            <el-form-item label="商品名称" prop="name">
                <el-input v-model="spuForm.name" placeholder="请输入商品名称"/>
            </el-form-item>
            <el-form-item label="选择分类" prop="categoryId">
                <el-cascader
                        :show-all-levels="false"
                        expand-trigger="hover"
                        :options="categoryList"
                        :props="categoryProps"
                        :change-on-select="false"
                        :change="onCategoryChange()"
                        filterable
                        v-model="category">
                </el-cascader>
            </el-form-item>
            <el-form-item label="选择品牌">
                <el-select placeholder="请选择" v-model="spuForm.brandId">
                    <el-option
                            v-for="item in brandList"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="商品描述" prop="detailHtml">
                <div ref="editor" style="text-align:left; width: 100%"></div>
            </el-form-item>
            <el-form-item label="是否生效" prop="state">
                <el-radio v-model="spuForm.state" label="0">暂不生效</el-radio>
                <el-radio v-model="spuForm.state" label="1">立即生效</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">添加商品</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import WangEditor from "wangeditor";
    import axios from "axios";

    export default {
        name: "SpuEdit",
        data: function () {
            return {
                spuForm: {
                    spuId: "",
                    name: "",
                    categoryId: "",
                    brandId: "",
                    detailHtml: "",
                    detailText: "",
                    state: "0"
                },
                rules: {
                    name: [
                        {required: true, message: '请输入商品名称', trigger: 'blur'}
                    ],
                    categoryId: [
                        {required: true, message: '请选择分类', trigger: 'blur'}
                    ],
                },
                categoryList: [],
                category: [],
                categoryProps: {
                    value: 'id',
                    children: 'children',
                    label: 'name'
                },
                brandList: [],
                spuId: "",
                type: "create",
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            // wangEditor
            let editor = new WangEditor(that.$refs.editor); //这个地方传入div元素的id 需要加#号
            editor.customConfig.onchange = (html) => {
                that.spuForm.detailHtml = html;
                that.spuForm.detailText = editor.txt.text();
            };
            editor.customConfig.zIndex = 100; // 设置 z-index
            editor.create();    // 生成编辑器
            //
            let type = that.$route.query.type;
            that.type = type;
            if (type === 'modify') {
                let spuId = that.$route.query.spuId;
                that.spuId = spuId;
                axios.get("/spu/detail?spuId=" + spuId + "&adminId=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        if (res.data.code === 2000) {
                            let data = res.data.data;
                            that.spuForm = {
                                spuId: data.spu.id,
                                name: data.spu.name,
                                categoryId: data.spu.category_id,
                                brandId: data.spu.brand_id,
                                detailHtml: data.detail.html,
                                detailText: data.detail.text,
                                state: "" + data.spu.state
                            };
                            editor.txt.html(data.detail.html);
                        }
                    }).catch(err => {
                });
            }
            axios.get("category/treeList" + "?adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.categoryList = res.data.data;
                    }
                }).catch(err => {
            });
            axios.get("brand/list" + "?adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.brandList = res.data.data;
                    }
                }).catch(err => {
            });
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.spuForm.validate((valid) => {
                    if (valid) {
                        that.spuForm.token = that.token;
                        that.spuForm.adminId = that.adminId;
                        if (that.type === 'modify') {
                            axios.post("/spu/update", that.spuForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        that.$message({
                                            type: 'success',
                                            message: '修改成功'
                                        });
                                        setTimeout(() => {
                                            that.$router.push("/spu-list");
                                        }, 1000);
                                    }
                                }).catch(err => {
                            });
                        } else {
                            axios.post("spu/create", that.spuForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        that.$message({
                                            type: 'success',
                                            message: '添加成功!'
                                        });
                                        setTimeout(() => {
                                            that.$router.push("/spu-list");
                                        }, 1000);
                                    }
                                }).catch(err => {
                            });
                        }
                    } else {
                        return false;
                    }
                });
            },
            onCategoryChange: function () {
                let that = this;
                if (that.category) that.spuForm.categoryId = that.category[that.category.length - 1];
            }
        }
    }
</script>

<style scoped>

</style>