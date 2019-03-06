/* jshint esversion: 6 */

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    saveScrollPosition: true,
    routes: [

        // =============================  首页  ===============================
        {
            name: "index",
            path: '/',
            component: resolve => void(require(['./views/pages/Index.vue'], resolve))
        },

        // =============================  商品管理  ===============================
        {
            name: "SpuList",
            path: "/spu-list",
            component: resolve => void (require(['./views/pages/goods/SpuList.vue'], resolve))
        },
        {
            name: "SpuDetail",
            path: "/spu-detail",
            component: resolve => void (require(['./views/pages/goods/SpuDetail.vue'], resolve))
        },
        {
            name: "SpuEdit",
            path: "/spu-Edit",
            component: resolve => void (require(['./views/pages/goods/SpuEdit.vue'], resolve))
        },
        {
            name: "SpuSpecEdit",
            path: "/spu-spec-Edit",
            component: resolve => void (require(['./views/pages/goods/SpuSpecEdit.vue'], resolve))
        },
        {
            name: "SpuBannerAdd",
            path: "/spu-banner-add",
            component: resolve => void (require(['./views/pages/goods/SpuBannerAdd.vue'], resolve))
        },
        {
            name: "SpuSpecOption",
            path: "/spu-spec-option",
            component: resolve => void (require(['./views/pages/goods/SpuSpecOption.vue'], resolve))
        },
        {
            name: "SkuEdit",
            path: "/sku-edit",
            component: resolve => void (require(['./views/pages/goods/SkuEdit.vue'], resolve))
        },
        {
            name: "CategoryList",
            path: "/category-list",
            component: resolve => void (require(['./views/pages/goods/CategoryList.vue'], resolve))
        },
        {
            name: "CategoryEdit",
            path: "/category-edit",
            component: resolve => void (require(['./views/pages/goods/CategoryEdit.vue'], resolve))
        },
        {
            name: "BrandList",
            path: "/brand-list",
            component: resolve => void (require(['./views/pages/goods/BrandList.vue'], resolve))
        },
        {
            name: "BrandAdd",
            path: "/brand-add",
            component: resolve => void (require(['./views/pages/goods/BrandAdd.vue'], resolve))
        },
        {
            name: "AttrList",
            path: "/attr-list",
            component: resolve => void (require(['./views/pages/goods/AttrList.vue'], resolve))
        },
        {
            name: "AttrGroupAdd",
            path: "/attr-group-add",
            component: resolve => void (require(['./views/pages/goods/AttrGroupAdd.vue'], resolve))
        },
        {
            name: "SpuAttrEdit",
            path: "/spu-attr-edit",
            component: resolve => void (require(['./views/pages/goods/SpuAttrEdit.vue'], resolve))
        },
        {
            name: "AttrAdd",
            path: "/attr-add",
            component: resolve => void (require(['./views/pages/goods/AttrAdd.vue'], resolve))
        },
        {
            name: "SpecList",
            path: "/spec-list",
            component: resolve => void (require(['./views/pages/goods/SpecList.vue'], resolve))
        },

        // =============================  交易管理  ===============================
        {
            name: "OrderList",
            path: "/order-list",
            component: resolve => void (require(['./views/pages/trade/OrderList.vue'], resolve))
        },
        {
            name: "OrderDetail",
            path: "/order-detail",
            component: resolve => void (require(['./views/pages/trade/OrderDetail.vue'], resolve))
        },
        {
            name: "CommentList",
            path: "/comment-list",
            component: resolve => void (require(['./views/pages/trade/CommentList.vue'], resolve))
        },
        {
            name: "PostModelList",
            path: "/post-model-list",
            component: resolve => void (require(['./views/pages/trade/PostModelList.vue'], resolve))
        },
        {
            name: "PostModelEdit",
            path: "/post-model-edit",
            component: resolve => void (require(['./views/pages/trade/PostModelEdit.vue'], resolve))
        },

        // ================================================  营销管理  =================================================
        {
            name: "CouponList",
            path: "/coupon-list",
            component: resolve => void (require(['./views/pages/market/CouponList.vue'], resolve))
        },
        {
            name: "CouponAdd",
            path: "/coupon-add",
            component: resolve => void (require(['./views/pages/market/CouponAdd.vue'], resolve))
        },

        // ================================================  用户管理  =================================================
        {
            name: "UserList",
            path: "/user-list",
            component: resolve => void (require(['./views/pages/user/UserList.vue'], resolve))
        },
        {
            name: "AddrList",
            path: "/addr-list",
            component: resolve => void (require(['./views/pages/user/AddrList.vue'], resolve))
        },

        // =============================  广告管理  ===============================
        {
            name: "AdList",
            path: '/ad-list',
            component: resolve => void(require(['./views/pages/ad/AdList.vue'], resolve))
        },
        {
            name: "AdEdit",
            path: '/ad-edit',
            component: resolve => void(require(['./views/pages/ad/AdEdit.vue'], resolve))
        },

        // =================================================  权限管理  ==================================================
        {
            name: "AdminList",
            path: "/admin-list",
            component: resolve => void(require(['./views/pages/permit/AdminList.vue'], resolve))
        },

        // =================================================== 设置  ====================================================
        {
            name: "ShopSet",
            path: "/shop-set",
            component: resolve => void (require(['./views/pages/settings/ShopSet.vue'], resolve))
        },
    ]
})