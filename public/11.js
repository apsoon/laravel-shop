(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../router */ "./resources/js/router.js");
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
  name: "CategoryAdd",
  data: function data() {
    return {
      categoryForm: {
        name: "",
        parent_id: 0,
        sort_order: 0,
        image_url: ""
      },
      rules: {
        name: [{
          required: true,
          message: '请输入商品名称',
          trigger: 'blur'
        }]
      },
      parentId: 0,
      parentName: ""
    };
  },
  mounted: function mounted() {
    var that = this;
    that.parentId = that.$route.query.parentId;
    that.parentName = that.$route.query.parentName;
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.categoryForm.validate(function (valid) {
        if (valid) {
          that.categoryForm.parent_id = that.parentId;
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("category/create", that.categoryForm).then(function (res) {
            if (res.data.code === 2000) {
              _router__WEBPACK_IMPORTED_MODULE_1__["default"].push("/category-list");
            }
          }).catch(function (err) {});
        }
      });
    },
    handleTreeClick: function handleTreeClick(data, checked, node) {
      var that = this;
      console.info("data = ", data, ", checked = ", checked, ", node = ", node);

      if (checked) {
        this.$refs.treeCategory.setCheckedNodes([]);
        this.$refs.treeCategory.setCheckedNodes([data]);
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true& ***!
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
    "div",
    [
      _c(
        "el-form",
        {
          ref: "categoryForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.categoryForm,
            "label-width": "100px;"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "分类名称", prop: "name" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.categoryForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.categoryForm, "name", $$v)
                  },
                  expression: "categoryForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c("el-form-item", { attrs: { label: "上级分类" } }, [
            _c("label", [_vm._v(_vm._s(_vm.parentName))])
          ]),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "排序优先级", prop: "sort_order" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.categoryForm.sort_order,
                  callback: function($$v) {
                    _vm.$set(_vm.categoryForm, "sort_order", $$v)
                  },
                  expression: "categoryForm.sort_order"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "添加图片" } },
            [
              _c(
                "el-upload",
                {
                  staticClass: "upload-demo",
                  attrs: {
                    limit: 1,
                    "file-list": _vm.fileList,
                    action: "",
                    "on-preview": _vm.handlePreview,
                    "on-remove": _vm.handleRemove,
                    "before-remove": _vm.beforeRemove
                  }
                },
                [
                  _c(
                    "el-button",
                    { attrs: { size: "small", type: "primary" } },
                    [_vm._v("点击上传")]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "el-upload__tip",
                      attrs: { slot: "tip" },
                      slot: "tip"
                    },
                    [_vm._v("只能上传jpg/png文件，且不超过500kb")]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
            [_vm._v("立即创建")]
          )
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

/***/ "./resources/js/components/pages/goods/CategoryAdd.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/pages/goods/CategoryAdd.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CategoryAdd_vue_vue_type_template_id_4e71e038_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true& */ "./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true&");
/* harmony import */ var _CategoryAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CategoryAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CategoryAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CategoryAdd_vue_vue_type_template_id_4e71e038_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CategoryAdd_vue_vue_type_template_id_4e71e038_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "4e71e038",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/goods/CategoryAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true& ***!
  \********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryAdd_vue_vue_type_template_id_4e71e038_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/CategoryAdd.vue?vue&type=template&id=4e71e038&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryAdd_vue_vue_type_template_id_4e71e038_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryAdd_vue_vue_type_template_id_4e71e038_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);