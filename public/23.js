(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[23],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/OrderList.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/trade/OrderList.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "OrderList",
  data: function data() {
    return {
      pageNo: 1,
      orderList: []
    };
  },
  mounted: function mounted() {
    var that = this;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/order/list?pageNo=" + that.pageNo).then(function (res) {
      if (res.data.code === 2000) {
        that.orderList = res.data.data;
      }
    }).catch(function (err) {});
  },
  methods: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/OrderList.vue?vue&type=template&id=5c80150a&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/trade/OrderList.vue?vue&type=template&id=5c80150a&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "el-card",
    [
      _c(
        "div",
        { staticClass: "clearfix", attrs: { slot: "header" }, slot: "header" },
        [_c("span", [_vm._v("订单列表")])]
      ),
      _vm._v(" "),
      _c(
        "el-table",
        {
          ref: "couponList",
          attrs: {
            "tooltip-effect": "dark",
            width: "100%",
            data: _vm.orderList
          }
        },
        [
          _c("el-table-column", {
            attrs: { label: "订单号", prop: "sn", width: "250" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "下单时间", prop: "create_time", width: "250" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "订单总额", prop: "price", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "收货人", prop: "consignee", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "订单状态", prop: "state", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "操作", "min-width": "1" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    scope.row.state === 0
                      ? _c(
                          "el-button",
                          {
                            attrs: { size: "mini", type: "warning" },
                            on: {
                              click: function($event) {
                                _vm.modifyState(
                                  "disable",
                                  scope.$index,
                                  scope.row.id
                                )
                              }
                            }
                          },
                          [_vm._v("发货\n                ")]
                        )
                      : _vm._e()
                  ]
                }
              }
            ])
          })
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/pages/trade/OrderList.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/pages/trade/OrderList.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderList_vue_vue_type_template_id_5c80150a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderList.vue?vue&type=template&id=5c80150a&scoped=true& */ "./resources/js/components/pages/trade/OrderList.vue?vue&type=template&id=5c80150a&scoped=true&");
/* harmony import */ var _OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderList.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/trade/OrderList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OrderList_vue_vue_type_template_id_5c80150a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _OrderList_vue_vue_type_template_id_5c80150a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5c80150a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/trade/OrderList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/trade/OrderList.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/pages/trade/OrderList.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/OrderList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/trade/OrderList.vue?vue&type=template&id=5c80150a&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/pages/trade/OrderList.vue?vue&type=template&id=5c80150a&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_template_id_5c80150a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderList.vue?vue&type=template&id=5c80150a&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/OrderList.vue?vue&type=template&id=5c80150a&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_template_id_5c80150a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_template_id_5c80150a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);