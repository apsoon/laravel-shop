(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuAdd.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuAdd.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! wangeditor */ "./node_modules/wangeditor/release/wangEditor.js");
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(wangeditor__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
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
  name: "SpuAdd",
  data: function data() {
    return {
      spuForm: {
        name: "",
        brief: "",
        categoryId: "",
        brandId: "",
        cover: "",
        detailHtml: "",
        detailText: ""
      },
      rules: {
        name: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }],
        brief: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }],
        categoryId: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }]
      },
      categoryList: [],
      category: [],
      categoryProps: {
        value: 'id',
        children: 'children'
      },
      brandList: []
    };
  },
  mounted: function mounted() {
    var that = this;
    axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("category/treeList").then(function (res) {
      if (res.data.code === 2000) {
        that.categoryList = res.data.data;
      }
    }).catch(function (err) {});
    axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("brand/list").then(function (res) {
      if (res.data.code === 2000) {
        that.brandList = res.data.data;
      }
    }).catch(function (err) {});
    var editor = new wangeditor__WEBPACK_IMPORTED_MODULE_0___default.a(that.$refs.editor); //这个地方传入div元素的id 需要加#号

    editor.customConfig.onchange = function (html) {
      that.spuForm.detailHtml = html;
      that.spuForm.detailText = editor.txt.text();
    };

    editor.create(); // 生成编辑器
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.spuForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_1___default.a.post("spu/create", that.spuForm).then(function (res) {
            if (res.data.code === 2000) {
              that.$message({
                type: 'success',
                message: '添加成功!'
              });
              setTimeout(function () {
                that.$router.push("/spu-list");
              }, 1000);
            }
          }).catch(function (err) {});
        } else {
          return false;
        }
      });
    },
    onCategoryChange: function onCategoryChange() {
      var that = this;
      if (that.category) that.spuForm.categoryId = that.category[that.category.length - 1];
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true& ***!
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
    "div",
    [
      _c(
        "el-form",
        {
          ref: "spuForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.spuForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "商品名称", prop: "name" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入商品名称" },
                model: {
                  value: _vm.spuForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.spuForm, "name", $$v)
                  },
                  expression: "spuForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "简要描述", prop: "brief" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入简要描述" },
                model: {
                  value: _vm.spuForm.brief,
                  callback: function($$v) {
                    _vm.$set(_vm.spuForm, "brief", $$v)
                  },
                  expression: "spuForm.brief"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "选择分类", prop: "categoryId" } },
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
            "el-form-item",
            { attrs: { label: "选择品牌" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择" },
                  model: {
                    value: _vm.spuForm.brandId,
                    callback: function($$v) {
                      _vm.$set(_vm.spuForm, "brandId", $$v)
                    },
                    expression: "spuForm.brandId"
                  }
                },
                _vm._l(_vm.brandList, function(item) {
                  return _c("el-option", {
                    key: item.id,
                    attrs: { label: item.name, value: item.id }
                  })
                }),
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("el-form-item", { attrs: { label: "添加图片" } }),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "商品描述", prop: "detailHtml" } },
            [
              _c("div", {
                ref: "editor",
                staticStyle: { "text-align": "left", width: "100%" }
              })
            ]
          ),
          _vm._v(" "),
          _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
            [_vm._v("添加商品")]
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

/***/ "./resources/js/components/pages/goods/SpuAdd.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuAdd.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SpuAdd_vue_vue_type_template_id_8a89df90_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true& */ "./resources/js/components/pages/goods/SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true&");
/* harmony import */ var _SpuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SpuAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/goods/SpuAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SpuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SpuAdd_vue_vue_type_template_id_8a89df90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SpuAdd_vue_vue_type_template_id_8a89df90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "8a89df90",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/goods/SpuAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuAdd.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuAdd.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuAdd_vue_vue_type_template_id_8a89df90_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuAdd.vue?vue&type=template&id=8a89df90&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuAdd_vue_vue_type_template_id_8a89df90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuAdd_vue_vue_type_template_id_8a89df90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);