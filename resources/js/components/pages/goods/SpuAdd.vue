<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>添加商品</span>
        </div>
        <el-form ref="spuForm" :rules="rules" :model="spuForm" label-width="100px">
            <el-form-item label="商品名称" prop="name">
                <el-input v-model="spuForm.name" placeholder="请输入商品名称"/>
            </el-form-item>
            <el-form-item label="简要描述" prop="brief">
                <el-input v-model="spuForm.brief" placeholder="请输入简要描述"/>
            </el-form-item>
            <el-form-item label="选择分类" prop="categoryId">
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
            <el-form-item label="商品列表价" prop="listPrice">
                <el-col :span="5">
                    <el-input v-model="spuForm.listPrice" placeholder="请输入商品列表价"/>
                </el-col>
            </el-form-item>
            <el-form-item label="添加图片">
            </el-form-item>
            <el-form-item label="商品描述" prop="detailHtml">
                <div ref="editor" style="text-align:left; width: 100%"></div>
            </el-form-item>
            <el-form-item label="是否上架" prop="state">
                <el-radio v-model="spuForm.state" label="0">暂不上架</el-radio>
                <el-radio v-model="spuForm.state" label="1">立即上架</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">添加商品</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import WangEditor from "wangeditor";
    import axios from "axios";

    export default {
        name: "SpuAdd",
        data: function () {
            return {
                spuForm: {
                    name: "",
                    brief: "",
                    categoryId: "",
                    listPrice: "",
                    brandId: "",
                    cover: "",
                    detailHtml: "",
                    detailText: "",
                    state: "0"
                },
                rules: {
                    name: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'}
                    ],
                    brief: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'}
                    ],
                    categoryId: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'}
                    ],
                },
                categoryList: [],
                category: [],
                categoryProps: {
                    value: 'id',
                    children: 'children'
                },
                brandList: [],
            }

        },
        mounted: function () {
            let that = this;
            axios.get("category/treeList").then(res => {
                if (res.data.code === 2000) {
                    that.categoryList = res.data.data;
                }
            }).catch(err => {
            });
            axios.get("brand/list").then(res => {
                if (res.data.code === 2000) {
                    that.brandList = res.data.data;
                }
            }).catch(err => {
            });
            let editor = new WangEditor(that.$refs.editor); //这个地方传入div元素的id 需要加#号
            editor.customConfig.onchange = (html) => {
                that.spuForm.detailHtml = html;
                that.spuForm.detailText = editor.txt.text();
            };
            editor.create();    // 生成编辑器
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.spuForm.validate((valid) => {
                    if (valid) {
                        axios.post("spu/create", that.spuForm).then(res => {
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