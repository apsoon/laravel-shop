(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[18],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "SpuBannerAdd",
  data: function data() {
    return {
      spuBannerForm: {
        spuId: "",
        sortOrder: 0,
        imageUrl: "",
        state: "0"
      },
      rules: {},
      spuId: "",
      uploadHeader: {},
      imageList: [],
      uploadData: {
        type: "spu",
        position: "banner"
      }
    };
  },
  mounted: function mounted() {
    var that = this,
        spuId = that.$route.query.spuId;
    that.spuBannerForm.spuId = spuId;
    that.spuId = spuId;
    that.uploadHeader = {
      'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
    };
  },
  methods: {
    onCreate: function onCreate() {
      var that = this;
      that.$refs.spuBannerForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("spu/create-banner", that.spuBannerForm).then(function (res) {
            if (res.data.code === 2000) {
              that.$message({
                type: 'success',
                message: '添加成功!'
              });
              setTimeout(function () {
                that.$router.push("/spu/detail?spuId=" + that.spuId + "&active=" + "banner");
              }, 1000);
            }
          });
        } else {
          return false;
        }
      });
    },
    onUploadSuccess: function onUploadSuccess(response, file, fileList) {
      var that = this;

      if (response.code === 2000) {
        that.spuBannerForm.imageUrl = response.data.filePath;
      }
    },
    onUploadFailed: function onUploadFailed(err, file, fileList) {// TODO 上传失败
    },
    onUploadFileRemoved: function onUploadFileRemoved(file, fileList) {
      var that = this; // TODO 删除文件

      that.spuBannerForm.imageUrl = "";
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("Banner编辑")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "spuBannerForm",
          attrs: { model: _vm.spuBannerForm, "label-width": "100px" }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "图片" } },
            [
              _c(
                "el-upload",
                {
                  staticClass: "upload-demo",
                  attrs: {
                    action: "/upload/image",
                    headers: _vm.uploadHeader,
                    "on-success": _vm.onUploadSuccess,
                    "on-error": _vm.onUploadFailed,
                    "on-remove": _vm.onUploadFileRemoved,
                    limit: 1,
                    data: _vm.uploadData,
                    "file-list": _vm.imageList,
                    "list-type": "picture-card"
                  }
                },
                [
                  _c("i", { staticClass: "el-icon-plus" }),
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
                ]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "排序优先级", prop: "sortOrder" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.spuBannerForm.sortOrder,
                  callback: function($$v) {
                    _vm.$set(_vm.spuBannerForm, "sortOrder", $$v)
                  },
                  expression: "spuBannerForm.sortOrder"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "是否启用", prop: "state" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.spuBannerForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.spuBannerForm, "state", $$v)
                    },
                    expression: "spuBannerForm.state"
                  }
                },
                [_vm._v("禁用")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.spuBannerForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.spuBannerForm, "state", $$v)
                    },
                    expression: "spuBannerForm.state"
                  }
                },
                [_vm._v("启用")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onCreate } },
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

/***/ "./resources/js/components/pages/goods/SpuBannerAdd.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuBannerAdd.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SpuBannerAdd_vue_vue_type_template_id_62f2a42c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true& */ "./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true&");
/* harmony import */ var _SpuBannerAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SpuBannerAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SpuBannerAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SpuBannerAdd_vue_vue_type_template_id_62f2a42c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SpuBannerAdd_vue_vue_type_template_id_62f2a42c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "62f2a42c",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/goods/SpuBannerAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuBannerAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuBannerAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuBannerAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuBannerAdd_vue_vue_type_template_id_62f2a42c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuBannerAdd.vue?vue&type=template&id=62f2a42c&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuBannerAdd_vue_vue_type_template_id_62f2a42c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuBannerAdd_vue_vue_type_template_id_62f2a42c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);