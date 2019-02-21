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
            component: resolve => void(require(['./components/pages/Index.vue'], resolve))
        },

        // =============================  商品管理  ===============================
        {
            name: "SpuList",
            path: "/spu-list",
            component: resolve => void (require(['./components/pages/goods/SpuList.vue'], resolve))
        },
        {
            name: "SpuDetail",
            path: "/spu-detail",
            component: resolve => void (require(['./components/pages/goods/SpuDetail.vue'], resolve))
        },
        {
            name: "SpuAdd",
            path: "/spu-add",
            component: resolve => void (require(['./components/pages/goods/SpuAdd.vue'], resolve))
        },
        {
            name: "SpuSpecAdd",
            path: "/spu-spec-add",
            component: resolve => void (require(['./components/pages/goods/SpuSpecAdd.vue'], resolve))
        },
        {
            name: "SpuSpecOption",
            path: "/spu-spec-option",
            component: resolve => void (require(['./components/pages/goods/SpuSpecOption.vue'], resolve))
        },
        // {
        //     name: "SkuDetail",
        //     path: "/sku-detail",
        //     component: resolve => void (require(['./components/pages/goods/SkuDetail.vue'], resolve))
        // },
        {
            name: "SkuAdd",
            path: "/sku-add",
            component: resolve => void (require(['./components/pages/goods/SkuAdd.vue'], resolve))
        },
        {
            name: "CategoryList",
            path: "/category-list",
            component: resolve => void (require(['./components/pages/goods/CategoryList.vue'], resolve))
        },
        {
            name: "CategoryAdd",
            path: "/category-add",
            component: resolve => void (require(['./components/pages/goods/CategoryAdd.vue'], resolve))
        },
        {
            name: "BrandList",
            path: "/brand-list",
            component: resolve => void (require(['./components/pages/goods/BrandList.vue'], resolve))
        },
        {
            name: "BrandAdd",
            path: "/brand-add",
            component: resolve => void (require(['./components/pages/goods/BrandAdd.vue'], resolve))
        },
        {
            name: "AttrList",
            path: "/attr-list",
            component: resolve => void (require(['./components/pages/goods/AttrList.vue'], resolve))
        },
        {
            name: "AttrGroupAdd",
            path: "/attr-group-add",
            component: resolve => void (require(['./components/pages/goods/AttrGroupAdd.vue'], resolve))
        },
        {
            name: "SpuAttrAdd",
            path: "/spu-attr-add",
            component: resolve => void (require(['./components/pages/goods/SpuAttrAdd.vue'], resolve))
        },
        {
            name: "AttrAdd",
            path: "/attr-add",
            component: resolve => void (require(['./components/pages/goods/AttrAdd.vue'], resolve))
        },
        {
            name: "SpecList",
            path: "/spec-list",
            component: resolve => void (require(['./components/pages/goods/SpecList.vue'], resolve))
        },

        // =============================  交易管理  ===============================
        {
            name: "OrderList",
            path: "/Order-list",
            component: resolve => void (require(['./components/pages/trade/OrderList.vue'], resolve))
        },

        // ================================================  营销管理  =================================================
        {
            name: "CouponList",
            path: "/coupon-list",
            component: resolve => void (require(['./components/pages/market/CouponList.vue'], resolve))
        },
        {
            name: "CouponAdd",
            path: "/coupon-add",
            component: resolve => void (require(['./components/pages/market/CouponAdd.vue'], resolve))
        },

        // ================================================  用户管理  =================================================
        {
            name: "UserList",
            path: "/user-list",
            component: resolve => void (require(['./components/pages/user/UserList.vue'], resolve))
        },
        {
            name: "AddrList",
            path: "/addr-list",
            component: resolve => void (require(['./components/pages/user/AddrList.vue'], resolve))
        },

        // =============================  广告  ===============================
        {
            name: "AdList",
            path: '/ad-list',
            component: resolve => void(require(['./components/pages/ad/AdList.vue'], resolve))
        },
        {
            name: "AdAdd",
            path: '/ad-add',
            component: resolve => void(require(['./components/pages/ad/AdAdd.vue'], resolve))
        }
    ]
})