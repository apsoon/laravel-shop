(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[24],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "AfterSaleList",
  data: function data() {
    return {
      afSaleList: [],
      active: "all",
      pageNo: 1
    };
  },
  mounted: function mounted() {
    var that = this;
    that.getAfterSaleList();
  },
  methods: {
    changeActive: function changeActive(tab, event) {
      var that = this;
      that.getAfterSaleList(tab.name);
    },
    getAfterSaleList: function getAfterSaleList() {
      var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'all';
      var pageNo = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
      var that = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/after/list?type=" + type + "&pageNo=" + pageNo).then(function (res) {
        if (res.data.code === 2000) {
          that.afSaleList = res.data.data;
        }
      }).catch(function (err) {});
    },
    modifyState: function modifyState(type, index, id) {
      var _this = this;

      var that = this,
          state = 1,
          message = "确认";

      if (type === "complete") {
        state = 4;
        message = "完成";
      }

      that.$confirm("是否" + message + "该售后订单?", '提示', {
        confirmButtonText: "确认",
        cancelButtonText: '取消',
        type: 'warning'
      }).then(function () {
        axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("after/modify-state", {
          state: state,
          id: id
        }).then(function (res) {
          if (res.data.code === 2000) that.commentList[index].state = state;
        });
      }).catch(function () {
        _this.$message({
          type: 'info',
          message: '已取消' + message
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("售后订单")])]
      ),
      _vm._v(" "),
      _c(
        "el-tabs",
        {
          on: { "tab-click": _vm.changeActive },
          model: {
            value: _vm.active,
            callback: function($$v) {
              _vm.active = $$v
            },
            expression: "active"
          }
        },
        [
          _c("el-tab-pane", { attrs: { label: "全部", name: "all" } }),
          _vm._v(" "),
          _c("el-tab-pane", { attrs: { label: "待确认", name: "accept" } }),
          _vm._v(" "),
          _c("el-tab-pane", { attrs: { label: "处理中", name: "ing" } }),
          _vm._v(" "),
          _c("el-tab-pane", { attrs: { label: "已完成", name: "complete" } }),
          _vm._v(" "),
          _c("el-tab-pane", { attrs: { label: "已取消", name: "cancel" } })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-table",
        {
          ref: "afSaleList",
          attrs: {
            "tooltip-effect": "dark",
            width: "100%",
            data: _vm.afSaleList,
            stripe: ""
          }
        },
        [
          _c("el-table-column", { attrs: { type: "selection", width: "55" } }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "订单号", prop: "order_sn", width: "250" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "用户", prop: "user_id", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "商品", prop: "sku_id", width: "100" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "售后原因", prop: "reason", width: "150" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "描述", prop: "describe", "min-width": "1" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "售后状态", prop: "state", width: "100" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    scope.row.state === 0
                      ? _c("span", [_vm._v("待确定")])
                      : scope.row.state === 1
                        ? _c("span", [_vm._v("处理中")])
                        : scope.row.state === 4
                          ? _c("span", [_vm._v("已完成")])
                          : scope.row.state === 7
                            ? _c("span", [_vm._v("已取消")])
                            : _vm._e()
                  ]
                }
              }
            ])
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "操作", width: "150" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    scope.row.state === 0
                      ? _c(
                          "el-button",
                          {
                            attrs: { size: "mini", type: "primary" },
                            on: {
                              click: function($event) {
                                _vm.modifyState(
                                  "accept",
                                  scope.$index,
                                  scope.row.id
                                )
                              }
                            }
                          },
                          [_vm._v("确认\n                ")]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    scope.row.state === 1
                      ? _c(
                          "el-button",
                          {
                            attrs: { size: "mini", type: "primary" },
                            on: {
                              click: function($event) {
                                _vm.modifyState(
                                  "complete",
                                  scope.$index,
                                  scope.row.id
                                )
                              }
                            }
                          },
                          [_vm._v("完成\n                ")]
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

/***/ "./resources/js/views/pages/trade/AfterSaleList.vue":
/*!**********************************************************!*\
  !*** ./resources/js/views/pages/trade/AfterSaleList.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AfterSaleList_vue_vue_type_template_id_3ce0a1bc_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true& */ "./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true&");
/* harmony import */ var _AfterSaleList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AfterSaleList.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AfterSaleList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AfterSaleList_vue_vue_type_template_id_3ce0a1bc_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AfterSaleList_vue_vue_type_template_id_3ce0a1bc_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3ce0a1bc",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/trade/AfterSaleList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AfterSaleList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AfterSaleList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AfterSaleList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AfterSaleList_vue_vue_type_template_id_3ce0a1bc_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/AfterSaleList.vue?vue&type=template&id=3ce0a1bc&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AfterSaleList_vue_vue_type_template_id_3ce0a1bc_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AfterSaleList_vue_vue_type_template_id_3ce0a1bc_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);