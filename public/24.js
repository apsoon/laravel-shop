(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[24],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/CommentList.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/trade/CommentList.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
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
      pageNo: 1,
      active: "all"
    };
  },
  mounted: function mounted() {
    var that = this;
    that.getCommentList();
  },
  methods: {
    modifyState: function modifyState(type, index, id) {
      var _this = this;

      var that = this,
          state = 1;
      if (type === "disable") state = 4;
      var message = state ? "展示" : "不展示";
      that.$confirm("确认前台" + message + "该评论?", '提示', {
        confirmButtonText: "确认",
        cancelButtonText: '取消',
        type: 'warning'
      }).then(function () {
        axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("comment/modify-state", {
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
    },
    getCommentList: function getCommentList() {
      var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'all';
      var pageNo = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
      var that = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/comment/list?type=" + type + "&pageNo=" + pageNo).then(function (res) {
        if (res.data.code === 2000) {
          that.commentList = res.data.data;
        }
      }).catch(function (err) {});
    },
    changeActive: function changeActive(tab, event) {
      var that = this;
      that.getCommentList(tab.name);
    },
    onPageNoChanged: function onPageNoChanged() {},
    onPageSizeChanged: function onPageSizeChanged() {}
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/CommentList.vue?vue&type=template&id=479f16d0&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/trade/CommentList.vue?vue&type=template&id=479f16d0&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("评论列表")])]
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
          _c("el-tab-pane", { attrs: { label: "待审核", name: "audit" } }),
          _vm._v(" "),
          _c("el-tab-pane", { attrs: { label: "审核通过", name: "valid" } }),
          _vm._v(" "),
          _c("el-tab-pane", { attrs: { label: "审核不通过", name: "invalid" } })
        ],
        1
      ),
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
            attrs: {
              label: "商品",
              prop: "sku_name",
              width: "150",
              align: "center"
            }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: {
              label: "订单编号",
              prop: "order_sn",
              width: "220",
              align: "center"
            }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: {
              label: "用户",
              prop: "nickname",
              width: "150",
              align: "center"
            }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "内容", prop: "content", "min-width": "1" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: {
              label: "评论时间",
              prop: "created_at",
              width: "200",
              align: "center"
            }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: {
              label: "排序",
              prop: "sort_order",
              width: "50",
              align: "center"
            }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: {
              label: "状态",
              prop: "state",
              width: "100",
              align: "center"
            },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    scope.row.state === 0
                      ? _c("span", [_vm._v("待审核")])
                      : scope.row.state === 1
                        ? _c("span", [_vm._v("审核通过")])
                        : _c("span", [_vm._v("审核不通过")])
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
                            _vm.deleteComment(scope.$index, scope.row.id)
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
      ),
      _vm._v(" "),
      _c("el-pagination", {
        staticStyle: {
          "margin-top": "20px",
          "margin-bottom": "20px",
          float: "right"
        },
        attrs: {
          background: "",
          layout: "total, sizes, prev, pager, next, jumper",
          total: 1000,
          "page-sizes": [20, 50, 100],
          "page-size": 20,
          "current-page": _vm.pageNo
        },
        on: {
          "current-change": _vm.onPageNoChanged,
          "update:currentPage": function($event) {
            _vm.pageNo = $event
          },
          "size-change": _vm.onPageSizeChanged
        }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/pages/trade/CommentList.vue":
/*!********************************************************!*\
  !*** ./resources/js/views/pages/trade/CommentList.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CommentList_vue_vue_type_template_id_479f16d0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CommentList.vue?vue&type=template&id=479f16d0&scoped=true& */ "./resources/js/views/pages/trade/CommentList.vue?vue&type=template&id=479f16d0&scoped=true&");
/* harmony import */ var _CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CommentList.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/trade/CommentList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CommentList_vue_vue_type_template_id_479f16d0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CommentList_vue_vue_type_template_id_479f16d0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "479f16d0",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/trade/CommentList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/trade/CommentList.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/pages/trade/CommentList.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/CommentList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/trade/CommentList.vue?vue&type=template&id=479f16d0&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/views/pages/trade/CommentList.vue?vue&type=template&id=479f16d0&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_template_id_479f16d0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentList.vue?vue&type=template&id=479f16d0&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/trade/CommentList.vue?vue&type=template&id=479f16d0&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_template_id_479f16d0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentList_vue_vue_type_template_id_479f16d0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);