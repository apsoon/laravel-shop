<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>添加规格及选项</span>
        </div>
        <el-form ref="specForm" :model="specForm" :rules="rules">
            <el-form-item prop="specId" class="clearfix">
                <el-transfer
                        v-model="specForm.specIds"
                        :titles="['所有规格', '当前商品已选']"
                        :data="specList"
                        :props="transferProp">
                </el-transfer>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">添加规格</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuSpecAdd",
        data: function () {
            return {
                spuId: 0,
                specForm: {
                    spuId: "",
                    specIds: [],
                },
                rules: {},
                specList: [],
                transferProp: {
                    key: 'id',
                    label: 'name'
                },
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.spuid = spuId;
            that.specForm.spuId = spuId;
            axios.get("spec/list" + "?admin_id=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data
                    }
                }).catch(err => {
            });
            axios.get("spec/list-spu?spuId=" + spuId + "&admin_id=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.existList = res.data.data;
                        for (let item of that.existList) {
                            that.specForm.specIds.push(item.id);
                        }
                    }
                }).catch(err => {
            });
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.specForm.token = that.token;
                that.specForm.adminId = that.adminId;
                axios.post("/pu/relateSpec", that.specForm)
                    .then(res => {
                        if (res.data.code === 2000) {
                            that.$router.push("spu/detail?spuId=" + that.spuId + "&active=" + "spec")
                        } else {
                            that.$message({
                                type: 'error',
                                message: '添加失败!'
                            });
                        }
                    }).catch(err => {
                });
            },
        }
    }
</script>

<style scoped>

</style>