<template>
    <div>
        <el-form id="goods-form" ref="spuForm" v-model="spuForm">
            <el-form-item label="商品名称" prop="name">
                <el-input class="form-control" id="goods-name" name="name" placeholder="请输入商品名称"/>
            </el-form-item>
            <el-form-item label="简要描述" prop="brief">
                <el-input class="form-control" id="goods-brief" name="brief" placeholder="请输入简要描述"/>
            </el-form-item>
            <el-form-item label="选择分类">
                <el-cascader
                        :show-all-levels="false"
                        expand-trigger="hover"
                        :options="categoryList"
                        :props="categoryProps"
                        :change-on-select="true"
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
            <el-form-item label="添加图片">
            </el-form-item>
            <el-form-item label="商品描述" prop="spuFrom.detailHtml">
                <div ref="editor" style="text-align:left; width: 100%"></div>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">添加商品</el-button>
        </el-form>
    </div>
</template>

<script>
    import WangEditor from "wangeditor";

    export default {
        name: "SpuAdd",
        data: function () {
            return {
                spuForm: {
                    name: "",
                    brief: "",
                    categoryId: "",
                    brandId: "",
                    cover: "",
                    detailHtml: "",
                    detailText: ""
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
                    console.info(that.brandList);
                }
            }).catch(err => {
            });
            let editor = new WangEditor(that.$refs.editor); //这个地方传入div元素的id 需要加#号
            editor.customConfig.onchange = (html) => {
                that.spuForm.detailHtml = html;
                that.spuForm.detailText = editor.txt.text();
            }
            editor.create();    // 生成编辑器
        },
        methods: {
            onSubmit: function () {
                let that = this;
                console.info(that.spuForm);
            }
        }
    }
</script>

<style scoped>

</style>