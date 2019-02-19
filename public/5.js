(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "SpuSpecOption",
  data: function data() {
    return {
      optionList: [],
      inputVisible: false,
      inputValue: '',
      spuId: "",
      specId: ""
    };
  },
  mounted: function mounted() {
    var that = this,
        spuId = that.$route.query.spuId,
        specId = that.$route.query.specId;
    that.spuId = spuId;
    that.specId = specId;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/spu/optionList?spuId=" + spuId + "&specId=" + specId).then(function (res) {
      if (res.data.code === 2000) {
        that.optionList = res.data.data;
      }
    }).catch(function (err) {});
  },
  methods: {
    showInput: function showInput() {
      var _this = this;

      this.inputVisible = true;
      this.$nextTick(function (_) {
        _this.$refs.optionInput.$refs.input.focus();
      });
    },
    addOption: function addOption() {
      var that = this,
          inputValue = that.inputValue;

      if (inputValue) {
        var data = {
          name: inputValue,
          spuId: that.spuId,
          specId: that.specId
        };
        axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/spu/createOption", data).then(function (res) {
          if (res.data.code === 2000) {
            that.optionList.push({
              name: inputValue
            });
          } else {
            that.$message({
              type: 'error',
              message: '添加失败!'
            });
          }
        }).catch(function (err) {});
      }

      this.inputVisible = false;
      this.inputValue = '';
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.el-tag[data-v-1937b76e] {\n    margin-right: 10px;\n    margin-bottom: 10px;\n}\n.button-new-tag[data-v-1937b76e] {\n    height: 32px;\n    line-height: 30px;\n    padding-top: 0;\n    padding-bottom: 0;\n}\n.input-new-tag[data-v-1937b76e] {\n    margin-bottom: 10px;\n    width: 90px;\n    vertical-align: bottom;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************/
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
  return _c("el-card", { staticClass: "box-card" }, [
    _c(
      "div",
      { staticClass: "clearfix", attrs: { slot: "header" }, slot: "header" },
      [_c("span", [_vm._v("规格列表")])]
    ),
    _vm._v(" "),
    _c(
      "div",
      [
        _vm._l(_vm.optionList, function(option) {
          return _c(
            "el-tag",
            {
              key: option,
              attrs: { type: _vm.primary, "disable-transitions": "true" }
            },
            [_vm._v("\n            " + _vm._s(option.name) + "\n        ")]
          )
        }),
        _vm._v(" "),
        _vm.inputVisible
          ? _c("el-input", {
              ref: "optionInput",
              staticClass: "input-new-tag",
              attrs: { size: "small" },
              on: { blur: _vm.addOption },
              nativeOn: {
                keyup: function($event) {
                  if (
                    !("button" in $event) &&
                    _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                  ) {
                    return null
                  }
                  return _vm.addOption($event)
                }
              },
              model: {
                value: _vm.inputValue,
                callback: function($$v) {
                  _vm.inputValue = $$v
                },
                expression: "inputValue"
              }
            })
          : _c(
              "el-button",
              {
                staticClass: "button-new-tag",
                attrs: { size: "small" },
                on: { click: _vm.showInput }
              },
              [_vm._v("+ 添加规格")]
            )
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/pages/goods/SpuSpecOption.vue":
/*!***************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuSpecOption.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SpuSpecOption_vue_vue_type_template_id_1937b76e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true& */ "./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true&");
/* harmony import */ var _SpuSpecOption_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SpuSpecOption.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css& */ "./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _SpuSpecOption_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SpuSpecOption_vue_vue_type_template_id_1937b76e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SpuSpecOption_vue_vue_type_template_id_1937b76e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1937b76e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/goods/SpuSpecOption.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuSpecOption.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css&":
/*!************************************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css& ***!
  \************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=style&index=0&id=1937b76e&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_style_index_0_id_1937b76e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true&":
/*!**********************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true& ***!
  \**********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_template_id_1937b76e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SpuSpecOption.vue?vue&type=template&id=1937b76e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_template_id_1937b76e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecOption_vue_vue_type_template_id_1937b76e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);