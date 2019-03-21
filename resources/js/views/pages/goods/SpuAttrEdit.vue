<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>商品属性编辑</span>
        </div>
        <el-form ref="attrForm" :rules="rules" :model="attrForm" label-width="100px">
            <div v-for="group in attrList">
                <span>{{group.name}}</span>
                <el-form :model="group" label-width="100px">
                    <div v-for="attr in group.attrs">
                        <el-form-item :label="attr.name">
                            <el-input v-model="attr.value"/>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
            <br/>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuAttrEdit",
        data: function () {
            return {
                attrList: [],
                categoryId: "",
                spuId: "",
                attrForm: {},
                rules: {},
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                categoryId = that.$route.query.categoryId,
                spuId = that.$route.query.spuId,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.categoryId = categoryId;
            that.spuId = spuId;
            that.attrForm.spuId = spuId;
            let cateAttr = axios.get("/attr/list-category?categoryId=" + categoryId + "&admin_id=" + that.adminId + "&token=" + that.token);
            let spuAttr = axios.get("/attrValue/list?spuId=" + spuId + "&admin_id=" + that.adminId + "&token=" + that.token);
            Promise.all([cateAttr, spuAttr])
                .then(values => {
                        let careAttrList = values[0].data.data,
                            spuAttrList = values[1].data.data;
                        for (let spu of spuAttrList) {
                            for (let cate of careAttrList) {
                                if (cate.id === spu.attr_group_id) {
                                    for (let option of cate.options) {
                                        // if (option->attr_id)
                                    }
                                }
                            }
                        }
                    }
                ).catch(err => {

            })
        },
        methods: {
            onSubmit: function () {
                let that = this,
                    attrList = that.attrList,
                    spuAttrList = [];
                for (let group of attrList) {
                    for (let attr of group.attrs) {
                        let spuAttr = {
                            attrGroupId: group.id,
                            attrId: attr.id,
                            value: attr.value
                        };
                        spuAttrList.push(spuAttr);
                    }
                }
                that.attrForm.spuAttrList = spuAttrList;
                axios.post("/attrValue/create", that.attrForm)
                    .then(res => {
                        if (res.data.code === 2000) {
                            that.$router.push("/spu/detail?spuId=", that.spuId + "&active=" + "attr");
                        }
                    }).catch(err => {
                });
            }
        }
    }
</script>

<style scoped>

</style>