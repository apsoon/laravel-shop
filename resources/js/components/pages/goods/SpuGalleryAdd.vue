<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>编辑</span>
        </div>
        <el-form>

        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuGalleryAdd",
        data: function () {
            return {
                spuGalleryForm: {
                    spuId: "",
                    sortOrder: 0,
                    imageUrl: "",
                    state: "0"
                },
                rules: {},
                spuId: "",
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId;
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.spuGalleryForm.validate((valid) => {
                    if (valid) {

                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>