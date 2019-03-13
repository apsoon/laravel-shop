(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/BrandEdit.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/BrandEdit.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "BrandEdit",
  data: function data() {
    return {
      brandForm: {
        name: "",
        describe: "",
        region: "",
        logo: "",
        state: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }]
      },
      uploadHeader: {},
      imageList: [],
      uploadData: {
        type: "logo",
        position: "brand"
      },
      brandId: "",
      type: "create" // logoUrl:""

    };
  },
  mounted: function mounted() {
    var that = this;
    that.uploadHeader = {
      'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
    };
    var type = that.$route.query.type;

    if (type === "modify") {
      var brandId = that.$route.query.brandId;
      that.brandId = brandId;
      that.type = "modify";
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/brand/detail?brandId=" + brandId).then(function (res) {
        if (res.data.code === 2000) {
          var data = res.data.data;
          that.brandForm = {
            id: data.id,
            name: data.name,
            describe: data.describe,
            region: data.region,
            logo: data.logo,
            state: "" + data.state
          };
        }
      }).catch(function (err) {});
    }
  },
  methods: {
    onCreate: function onCreate() {
      var that = this;
      that.$refs.brandForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("brand/create", that.brandForm).then(function (res) {
            if (res.data.code === 2000) {
              that.$message({
                type: 'success',
                message: '添加成功!'
              });
              setTimeout(function () {
                that.$router.push("brand-list");
              }, 1000);
            }
          });
        } else {
          return false;
        }
      });
    },
    onUpdate: function onUpdate() {
      var that = this;
      that.$refs.brandForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/brand/update", that.brandForm).then(function (res) {
            if (res.data.code === 2000) {
              that.$message({
                type: 'success',
                message: '更新成功!'
              });
              setTimeout(function () {
                that.$router.push("brand-list");
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
        var brandForm = that.brandForm;
        brandForm.logo = response.data.filePath;
        that.brandForm = brandForm;
      }
    },
    onUploadFailed: function onUploadFailed(err, file, fileList) {// TODO 上传失败
    },
    onUploadFileRemoved: function onUploadFileRemoved(file, fileList) {
      var that = this; // TODO 删除文件

      var brandForm = that.brandForm;
      brandForm.logo = "";
      that.brandForm = brandForm;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/BrandEdit.vue?vue&type=template&id=c41af744&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/BrandEdit.vue?vue&type=template&id=c41af744&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("品牌")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "brandForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.brandForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "品牌名称", prop: "name" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.brandForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.brandForm, "name", $$v)
                  },
                  expression: "brandForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "品牌描述", prop: "describe" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.brandForm.describe,
                  callback: function($$v) {
                    _vm.$set(_vm.brandForm, "describe", $$v)
                  },
                  expression: "brandForm.describe"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "所属地区", prop: "region" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.brandForm.region,
                  callback: function($$v) {
                    _vm.$set(_vm.brandForm, "region", $$v)
                  },
                  expression: "brandForm.region"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "品牌LOGO" } },
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
            { attrs: { label: "是否启用", prop: "state" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.brandForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.brandForm, "state", $$v)
                    },
                    expression: "brandForm.state"
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
                    value: _vm.brandForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.brandForm, "state", $$v)
                    },
                    expression: "brandForm.state"
                  }
                },
                [_vm._v("启用")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.type === "create"
            ? _c(
                "el-button",
                { attrs: { type: "primary" }, on: { click: _vm.onCreate } },
                [_vm._v("立即创建")]
              )
            : _c(
                "el-button",
                { attrs: { type: "primary" }, on: { click: _vm.onUpdate } },
                [_vm._v("修改")]
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

/***/ "./resources/js/views/pages/goods/BrandEdit.vue":
/*!******************************************************!*\
  !*** ./resources/js/views/pages/goods/BrandEdit.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BrandEdit_vue_vue_type_template_id_c41af744_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BrandEdit.vue?vue&type=template&id=c41af744&scoped=true& */ "./resources/js/views/pages/goods/BrandEdit.vue?vue&type=template&id=c41af744&scoped=true&");
/* harmony import */ var _BrandEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BrandEdit.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/goods/BrandEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BrandEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _BrandEdit_vue_vue_type_template_id_c41af744_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _BrandEdit_vue_vue_type_template_id_c41af744_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "c41af744",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/goods/BrandEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/goods/BrandEdit.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/views/pages/goods/BrandEdit.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./BrandEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/BrandEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/goods/BrandEdit.vue?vue&type=template&id=c41af744&scoped=true&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/views/pages/goods/BrandEdit.vue?vue&type=template&id=c41af744&scoped=true& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandEdit_vue_vue_type_template_id_c41af744_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./BrandEdit.vue?vue&type=template&id=c41af744&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/BrandEdit.vue?vue&type=template&id=c41af744&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandEdit_vue_vue_type_template_id_c41af744_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandEdit_vue_vue_type_template_id_c41af744_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);