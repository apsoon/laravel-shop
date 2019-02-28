(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[12],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "AttrGroupAdd",
  data: function data() {
    return {
      attrGroupForm: {
        name: "",
        categoryId: ""
      },
      rules: {
        name: [{
          required: true,
          message: '请输入属性组名称',
          trigger: "blur"
        }],
        categoryId: [{
          required: true,
          message: '请输入属性组名称',
          trigger: "blur"
        }]
      },
      categoryProps: {
        value: 'id',
        children: 'children',
        label: 'name'
      },
      categoryList: [],
      category: []
    };
  },
  mounted: function mounted() {
    var that = this;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("category/treeList").then(function (res) {
      if (res.data.code === 2000) {
        that.categoryList = res.data.data;
      }
    }).catch(function (err) {});
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.attrGroupForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/attrGroup/create", that.attrGroupForm).then(function (res) {
            if (res.data.code === 2000) {}
          }).catch(function (err) {});
        }
      });
    },
    onCategoryChange: function onCategoryChange() {
      var that = this;
      if (that.category) that.attrGroupForm.categoryId = that.category[that.category.length - 1];
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("添加属性组")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "attrGroupForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.attrGroupForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "属性组名称", prop: "name" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.attrGroupForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.attrGroupForm, "name", $$v)
                  },
                  expression: "attrGroupForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "所属分类", prop: "categoryId" } },
            [
              _c("el-cascader", {
                attrs: {
                  "show-all-levels": false,
                  "expand-trigger": "hover",
                  options: _vm.categoryList,
                  props: _vm.categoryProps,
                  "change-on-select": true,
                  change: _vm.onCategoryChange(),
                  filterable: ""
                },
                model: {
                  value: _vm.category,
                  callback: function($$v) {
                    _vm.category = $$v
                  },
                  expression: "category"
                }
              })
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

/***/ "./resources/js/views/pages/goods/AttrGroupAdd.vue":
/*!*********************************************************!*\
  !*** ./resources/js/views/pages/goods/AttrGroupAdd.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AttrGroupAdd_vue_vue_type_template_id_8435a0d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true& */ "./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true&");
/* harmony import */ var _AttrGroupAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AttrGroupAdd.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AttrGroupAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AttrGroupAdd_vue_vue_type_template_id_8435a0d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AttrGroupAdd_vue_vue_type_template_id_8435a0d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "8435a0d4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/goods/AttrGroupAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AttrGroupAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AttrGroupAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AttrGroupAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AttrGroupAdd_vue_vue_type_template_id_8435a0d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/AttrGroupAdd.vue?vue&type=template&id=8435a0d4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AttrGroupAdd_vue_vue_type_template_id_8435a0d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AttrGroupAdd_vue_vue_type_template_id_8435a0d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);