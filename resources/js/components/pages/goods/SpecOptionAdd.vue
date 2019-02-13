<template>
    <div>

    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpecOptionAdd",
        data: function () {
            return {
                spuId: 0,
                activeName: "info"
            }
        },
        mounted: function () {
            let that = this;
            console.info(that.$route.query);
            that.spuid = that.$route.query.spuId;
            axios.get("spec/list")
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data
                    }
                }).catch(err => {
            });
        }
    }
</script>

<style scoped>

</style>