<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>商品属性</span>
        </div>
        <el-form ref="attrForm" :model="attrList" label-width="100px">
            <template v-for="group in attrList">
                <span>{{group.name}}</span>
                <template v-for="attr in group.attrs">
                    <el-form-item :label="attr.name">
                        <el-input :model="attr.value"></el-input>
                    </el-form-item>
                </template>
            </template>
            <br/>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuAttrAdd",
        data: function () {
            return {
                attrList: [],
                categoryId: "",
                spuId: ""
            }
        },
        mounted: function () {
            let that = this,
                categoryId = that.$route.query.categoryId,
                spuId = that.$route.query.spuId;
            that.categoryId = categoryId;
            that.spuId = spuId;
            axios.get("/attr/list-category?categoryId=" + categoryId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.attrList = res.data.data;
                        console.info(that.attrList);
                    }
                })
                .catch(err => {

                });
        },
        methods: {
            onSubmit: function () {
                let that = this;
                console.info(that.attrList);
            }
        }
    }
</script>

<style scoped>

</style>