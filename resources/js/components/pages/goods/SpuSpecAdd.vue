<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>添加规格及选项</span>
        </div>
        <el-form ref="spuSForm" :model="spuSForm" :rules="rules">
            <el-form-item prop="specId" class="clearfix">
                <el-transfer
                        v-model="spuSForm.specIds"
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
                spuSForm: {
                    spuId: "",
                    specIds: [],
                },
                rules: {},
                specList: [],
                transferProp: {
                    key: 'id',
                    label: 'name'
                }
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId;
            that.spuid = spuId;
            that.spuSForm.spuId = spuId;
            axios.get("spec/list")
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data
                    }
                }).catch(err => {
            });
        },
        methods: {
            onSubmit: function () {
                let that = this;
                axios.post("/spu/relateSpec", that.spuSForm)
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