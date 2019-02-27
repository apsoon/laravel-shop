(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/CommentList.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/trade/CommentList.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
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
  name: "CommentList",
  data: function data() {
    return {
      commentList: [],
      pageNo: 1
    };
  },
  mounted: function mounted() {
    var that = this;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/comment/list?pageNo=" + that.pageNo).then(function (res) {
      if (res.code === 2000) {
        that.commentList = res.data.data;
      }
    }).catch(function (err) {});
  },
  methods: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/CommentList.vue?vue&type=template&id=7979bc68&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/trade/CommentList.vue?vue&type=template&id=7979bc68&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************/
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
      _c("div", {
        staticClass: "clearfix",
        attrs: { slot: "header" },
        slot: "header"
      }),
      _vm._v(" "),
      _c(
        "el-table",
        {
          ref: "commentList",
          attrs: {
            data: _vm.commentList,
            "tooltip-effect": "dart",
            width: "100%"
          }
        },
        [
          _c("el-table-column", { attrs: { type: "selection", width: "55" } }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "商品", prop: "sku_id", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "订单编号", prop: "order_sn", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "用户", prop: "user_id", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "内容", prop: "content", "min-width": "1" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "评论时间", prop: "create_at", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "排序", prop: "sort_order", width: "100" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "状态", prop: "state", width: "100" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    scope.row.state === 0
                      ? _c("span", [_vm._v("待审核")])
                      : scope.row.state === 1
                        ? _c("span", [_vm._v("前台显示")])
                        : _c("span", [_vm._v("前台不显示")])
                  ]
                }
              }
            ])
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { width: "300", label: "操作" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    _c(
                      "router-link",
                      {
                        attrs: {
                          to: {
                            path: "/brand-add",
                            query: { type: "modify", brandId: scope.row.id }
                          }
                        }
                      },
                      [
                        _c(
                          "el-button",
                          { attrs: { size: "mini", type: "info" } },
                          [_vm._v("修改")]
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    scope.row.state === 1
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
                          [_vm._v("禁用\n                ")]
                        )
                      : _c(
                          "el-button",
                          {
                            attrs: { size: "mini", type: "success" },
                            on: {
                              click: function($event) {
                                _vm.modifyState(
                                  "enable",
                                  scope.$index,
                                  scope.row.id
                                )
                              }
                            }
                          },
                          [_vm._v("启用\n                ")]
                        ),
                    _vm._v(" "),
                    _c(
                      "el-button",
                      {
                        attrs: { size: "mini", type: "danger" },
                        on: {
                          click: function($event) {
                            _vm.deleteBrand(scope.$index, scope.row.id)
                          }
                        }
                      },
                      [_vm._v("删除\n                ")]
                    )
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

/***/ "./resources/js/components/pages/trade/CommentList.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/pages/trade/CommentList.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CommentList_vue_vue_type_template_id_7979bc68_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CommentList.vue?vue&type=template&id=7979bc68&scoped=true& */ "./resources/js/components/pages/trade/CommentList.vue?vue&type=template&id=7979bc68&scoped=true&");
/* harmony import */ var _CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CommentList.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/trade/CommentList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CommentList_vue_vue_type_template_id_7979bc68_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CommentList_vue_vue_type_template_id_7979bc68_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7979bc68",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/trade/CommentList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/trade/CommentList.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/pages/trade/CommentList.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/CommentList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/trade/CommentList.vue?vue&type=template&id=7979bc68&scoped=true&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/pages/trade/CommentList.vue?vue&type=template&id=7979bc68&scoped=true& ***!
  \********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_template_id_7979bc68_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentList.vue?vue&type=template&id=7979bc68&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/trade/CommentList.vue?vue&type=template&id=7979bc68&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_template_id_7979bc68_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_template_id_7979bc68_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);