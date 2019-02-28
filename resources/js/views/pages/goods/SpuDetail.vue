<template>
    <div>
        <el-tabs v-model="active" type="border-card" @tab-click="onTabClicked">
            <el-tab-pane label="商品信息" name="info">
                <el-row>商品名称: {{spu.name}}</el-row>
                <el-row>品牌: {{spu.brand_id}}</el-row>
                <el-row>分类: {{spu.category_id}}</el-row>
                <el-row>状态: {{spu.state}}</el-row>
            </el-tab-pane>
            <el-tab-pane label="商品属性" name="attr">
                <router-link :to="{path: '/spu-attr-add', query:{spuId:spuId,categoryId:spu.category_id}}">
                    <el-button type="primary" size="medium">
                        添加属性
                    </el-button>
                </router-link>
                <el-table ref="attrList" :data="attrList" tooltip-effect="dark" width="100%">
                    <el-table-column label="属性名称">
                    </el-table-column>
                    <el-table-column label="值">
                    </el-table-column>
                    <el-table-column label="操作">
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="商品规格" name="spec">
                <router-link :to="{path: '/spu-spec-edit', query: {spuId: spuId}}">
                    <el-button type="primary" size="medium">编辑规格</el-button>
                </router-link>
                <el-table ref="specList" tooltip-effect="dark" :data="specList" width="100%">
                    <el-table-column prop="name" label="名称" width="150px">
                    </el-table-column>
                    <el-table-column label="选项" min-width="1">
                        <template slot-scope="scope">
                            <el-tag
                                    v-for="option in scope.row.options"
                                    :key="option.id"
                                    type="primary"
                                    :disable-transitions="true">
                                {{option.name}}
                            </el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="操作" width="200px">
                        <template slot-scope="scope">
                            <router-link
                                    :to="{path: '/spu-spec-option', query: {spuId: spuId, specId: scope.row.id}}">
                                <el-button size="mini" type="info" @click="">修改选项
                                </el-button>
                            </router-link>
                            <el-button size="mini" type="danger" @click="deleteSpec(scope.$index, scope.row.id)">删除
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="产品列表" name="sku">
                <router-link :to="{path: '/sku-edit',query: {type:'create', spuId: spuId}}">
                    <el-button type="primary" size="medium">添加产品</el-button>
                </router-link>
                <el-table ref="skuList" :data="skuList" tooltip-effect="dark" width="100%">
                    <el-table-column prop="name" label="名称" width="150px" align="center"/>
                    <el-table-column prop="origin_price" label="原价" width="150px" align="center"/>
                    <el-table-column prop="price" label="价格" width="150px" align="center"/>
                    <el-table-column prop="number" label="数量" width="150px" align="center"/>
                    <el-table-column prop="value" label="规格" min-width="1"/>
                    <el-table-column prop="state" label="状态" width="100px" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.state===1">已上架</span>
                            <span v-else>已下架</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="is_recom" label="是否热销" width="100px" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.is_recom === 1">是</span>
                            <span v-else>否</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="操作" width="350px">
                        <template slot-scope="scope">
                            <router-link
                                    :to="{path: '/sku-edit', query: {type: 'modify', spuId: spuId, skuId: scope.row.id}}">
                                <el-button size="mini" type="info">修改</el-button>
                            </router-link>
                            <el-button v-if="scope.row.state" size="mini" type="warning"
                                       @click="modifySkuState('disable', scope.$index, scope.row.id)">下架
                            </el-button>
                            <el-button v-else size="mini" type="success"
                                       @click="modifySkuState('enable', scope.$index, scope.row.id)">上架
                            </el-button>
                            <el-button size="mini" type="danger" @click="deleteAd(scope.$index, scope.row.id)">删除
                            </el-button>
                            <el-button type="primary" size="mini" @click="modifySkuRecom('add', scope)"
                                       v-if="scope.row.is_recom === 0">设置推荐
                            </el-button>
                            <el-button type="primary" size="mini" @click="modifySkuRecom('remove', scope)"
                                       v-else>取消热推
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="Banner" name="banner">
                <router-link :to="{path: '/spu-banner-add',query: {spuId: spuId}}">
                    <el-button type="primary" size="medium">添加Banner</el-button>
                </router-link>
                <el-button type="danger" size="medium" @click="deleteBanners()">批量删除</el-button>
                <el-table ref="multipleTable" :data="bannerList" tooltip-effect="dark" style="width: 100%">
                    <el-table-column type="selection" width="55"/>
                    <el-table-column label="图片" prop="imageUrl" width="150">
                        <template slot-scope="scope">
                            <el-popover placement="right" title="图片预览" trigger="hover">
                                <img :src="scope.row.image_url"/>
                                <img slot="reference" :src="scope.row.image_url" :alt="scope.row.image_url"
                                     style="max-height: 50px;max-width: 130px"/>
                            </el-popover>
                        </template>
                    </el-table-column>
                    <el-table-column label="排序" prop="sort_order" width="150"/>
                    <el-table-column label="状态" prop="state" width="150">
                        <template slot-scope="scope">
                            <span v-if="scope.row.state===0">已禁用</span>
                            <span v-else>已启用</span>
                        </template>
                    </el-table-column>
                    <el-table-column width="300" label="操作">
                        <template slot-scope="scope">
                            <el-button v-if="scope.row.state" size="mini" type="warning"
                                       @click="modifyBannerState('disable', scope.$index, scope.row.id)">禁用
                            </el-button>
                            <el-button v-else size="mini" type="success"
                                       @click="modifyBannerState('enable', scope.$index, scope.row.id)">启用
                            </el-button>
                            <el-button size="mini" type="danger"
                                       @click="deleteBanner(scope.$index, scope.row.id)">删除
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuDetail",
        data: function () {
            return {
                spuId: 0,
                active: "info",
                spu: {},
                skuList: [],
                specList: [],
                attrList: [],
                bannerList: []
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId;
            let active = that.$route.query.active;
            console.info(active);
            if (active) that.active = active;
            that.spuId = spuId;
            axios.get("spu/detail?spuId=" + spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.spu = res.data.data.spu;
                    }
                })
                .catch(err => {
                });
            axios.get("spu/specOptionList?spuId=" + spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data;
                    }
                });
            axios.get("sku/listBySpu?spuId=" + that.spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.skuList = res.data.data;
                    }
                })
                .catch(err => {

                });
            axios.get("/attr/list-spu?spuId=" + that.spuId + "&categoryId=" + that.spu.category_id)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.attrList = res.data.data;
                    }
                });
            axios.get("/spu/banner-list?spuId=" + that.spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.bannerList = res.data.data;
                    }
                });
        },
        methods: {
            modifyBannerState: function (type, index, id) {
                let that = this,
                    state = 1;
                if (type === "disable") state = 0;
                let message = state ? "启用" : "禁用";
                that.$confirm("确认" + message + "Banner?", '提示', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post("spu/modify-banner-state", {
                        state: state,
                        id: id
                    }).then(res => {
                        if (res.data.code === 2000) that.bannerList[index].state = state;
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消' + message
                    });
                });
            },
            deleteBanner: function (index, id) {
                let that = this,
                    ids = [];
                ids.push(id);
                axios.post("brand/delete", {
                    ids: ids
                })
                    .then(res => {
                        if (res.data.code === 2000) {
                            that.brandList.splice(index, 1);
                            that.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                        }
                    });
            },
            deleteBanners: function () {
                let that = this,
                    selections = that.$refs.multipleTable.selection;
                if (selections.length) {
                    let ids = [];
                    for (let section of selections) {
                        ids.push(section.id);
                    }
                    axios.post("brand/delete", {
                        ids: ids
                    })
                        .then(res => {
                            if (res.data.code === 2000) {
                                that.$message({
                                    type: 'success',
                                    message: '删除成功!'
                                });
                                that.$router.reload();
                            }
                        });
                }
            },
            onTabClicked: function (tab, event) {
                let that = this;
                that.active = tab.name;
            },
            modifySkuRecom: function (type, node) {
                let that = this,
                    message = "设置为";
                if (type === 0) message = "取消";
                that.$confirm("是否" + message + "首页推荐商品", '警告', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let isRecom = type === 'add' ? 1 : 0,
                        param = {
                            id: node.row.id,
                            isRecom: isRecom
                        };
                    axios.post("/sku/recom", param)
                        .then(res => {
                            if (res.data.code === 2000) {
                                console.info(node);
                                node.row.is_recom = isRecom
                            }
                        })
                }).catch(() => {
                    that.$message({
                        type: 'info',
                        message: '已取消设置'
                    });
                });
            },
            modifySkuState: function (type, index, id) {
                let that = this,
                    state = 1;
                if (type === "disable") state = 0;
                let message = state ? "上架" : "下架";
                that.$confirm("确认" + message + "该产品?", '提示', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post("sku/modify-state", {
                        state: state,
                        id: id
                    }).then(res => {
                        if (res.data.code === 2000) that.skuList[index].state = state;
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消' + message
                    });
                });
            }
        }
    }
</script>

<style scoped>
    .el-tag + .el-tag {
        margin-left: 10px;
    }

    .image {
        width: 48px;
        height: 48px;
    }
</style>