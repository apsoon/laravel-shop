<template>

</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuDetail",
        data: function () {
            return {
                spuId: 0,
            }
        },
        mounted: function () {
            let that = this;
            console.info(that.$route.query);
            that.spuid = that.$route.query.spuId;
            axios.get("spu/detail?spuId=" + that.spuid)
                .then(res => {
                    if (res.data.code === 2000) {
                        console.info(res);
                    }
                }).catch(err => {
            });
        }
    }
</script>

<style scoped>

</style>