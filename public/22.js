(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=script&lang=js& ***!
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "SpuSpecAdd",
  data: function data() {
    return {
      spuId: 0,
      specForm: {
        spuId: "",
        specIds: []
      },
      rules: {},
      specList: [],
      transferProp: {
        key: 'id',
        label: 'name'
      }
    };
  },
  mounted: function mounted() {
    var that = this,
        spuId = that.$route.query.spuId;
    that.spuid = spuId;
    that.specForm.spuId = spuId;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("spec/list").then(function (res) {
      if (res.data.code === 2000) {
        that.specList = res.data.data;
      }
    }).catch(function (err) {});
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("spec/list-spu?spuId=" + spuId).then(function (res) {
      if (res.data.code === 2000) {
        that.existList = res.data.data;
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = that.existList[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var item = _step.value;
            that.specForm.specIds.push(item.id);
          }
        } catch (err) {
          _didIteratorError = true;
          _iteratorError = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion && _iterator.return != null) {
              _iterator.return();
            }
          } finally {
            if (_didIteratorError) {
              throw _iteratorError;
            }
          }
        }
      }
    }).catch(function (err) {});
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      console.info(that.specList);
      console.info(that.specForm.specIds);
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/pu/relateSpec", that.specForm).then(function (res) {
        if (res.data.code === 2000) {
          that.$router.push("spu/detail?spuId=" + that.spuId + "&active=" + "spec");
        } else {
          that.$message({
            type: 'error',
            message: '添加失败!'
          });
        }
      }).catch(function (err) {});
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true& ***!
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
        [_c("span", [_vm._v("添加规格及选项")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        { ref: "specForm", attrs: { model: _vm.specForm, rules: _vm.rules } },
        [
          _c(
            "el-form-item",
            { staticClass: "clearfix", attrs: { prop: "specId" } },
            [
              _c("el-transfer", {
                attrs: {
                  titles: ["所有规格", "当前商品已选"],
                  data: _vm.specList,
                  props: _vm.transferProp
                },
                model: {
                  value: _vm.specForm.specIds,
                  callback: function($$v) {
                    _vm.$set(_vm.specForm, "specIds", $$v)
                  },
                  expression: "specForm.specIds"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
            [_vm._v("添加规格")]
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

/***/ "./resources/js/views/pages/goods/SpuSpecEdit.vue":
/*!********************************************************!*\
  !*** ./resources/js/views/pages/goods/SpuSpecEdit.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SpuSpecEdit_vue_vue_type_template_id_5bbf492a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true& */ "./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true&");
/* harmony import */ var _SpuSpecEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SpuSpecEdit.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SpuSpecEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SpuSpecEdit_vue_vue_type_template_id_5bbf492a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SpuSpecEdit_vue_vue_type_template_id_5bbf492a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5bbf492a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/goods/SpuSpecEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuSpecEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecEdit_vue_vue_type_template_id_5bbf492a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuSpecEdit.vue?vue&type=template&id=5bbf492a&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecEdit_vue_vue_type_template_id_5bbf492a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuSpecEdit_vue_vue_type_template_id_5bbf492a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);