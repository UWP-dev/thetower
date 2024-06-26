"use strict";function _classCallCheck(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var _createClass=function(){function t(t,e){for(var a=0;a<e.length;a++){var r=e[a];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,a,r){return a&&t(e.prototype,a),r&&t(e,r),e}}();!function(t){new(function(){function e(){_classCallCheck(this,e),this.initSlideProduct()}return _createClass(e,[{key:"initSlideProduct",value:function(){t(".single-product.woocommerce-single-style-4 div.product .images").removeClass(function(t,e){return(e.match(/(^|\s)woocommerce-product-gallery--columns-\S+/g)||[]).join(" ")}).flexslider({selector:".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image",animation:"slide",controlNav:!0,directionNav:!0,slideshow:!1,smoothHeight:!1,itemMargin:0,touch:!0})}},{key:"productTogerther",value:function(){var e=t(".opal-frequently-bought");if(!(e.length<=0)){var a=e.find(".otf-total-price .woocommerce-Price-amount"),r=e.find(".otf_add_to_cart_button"),c=parseFloat(e.find("#otf-data_price").data("price"));e.data("currency"),e.data("thousand"),e.data("decimal"),e.data("price_decimals"),e.data("currency_pos");e.find("input[type=checkbox]").on("change",function(){var o=t(this).val();t(this).closest("li").toggleClass("uncheck");var n=parseFloat(t(this).closest("li").find(".product-price").data("price"));t(this).closest("li").hasClass("uncheck")?(e.find("#fbt-product-"+o).addClass("un-active"),c-=n):(e.find("#fbt-product-"+o).removeClass("un-active"),c+=n);var i="0";e.find(".product-list li").each(function(){t(this).hasClass("uncheck")||(i+=","+t(this).find("input[type=checkbox]").val())}),r.attr("value",i),a.html(this.formatNumber(c))}),e.on("click",".otf_add_to_cart_button.ajax_add_to_cart",function(){var e=t(this);e.addClass("loading");var a=window.location.href;t.ajax({url:ajaxurl,dataType:"json",method:"post",data:{action:"otf_woocommerce_fbt_add_to_cart",product_ids:e.attr("value")},error:function(){window.location=a},success:function(a){if("undefined"!=typeof wc_add_to_cart_params&&"yes"===wc_add_to_cart_params.cart_redirect_after_add)return void(window.location=wc_add_to_cart_params.cart_url);t(document.body).trigger("updated_wc_div"),t(document.body).on("wc_fragments_refreshed",function(){e.removeClass("loading")})}})})}}},{key:"formatNumber",value:function(t){var e=t;if(parseInt(price_decimals)>0){t=t.toFixed(price_decimals)+"";for(var a=t.split("."),r=a[0],c=a.length>1?decimal+a[1]:"",o=/(\d+)(\d{3})/;o.test(r);)r=r.replace(o,"$1"+thousand+"$2");e=r+c}switch(currency_pos){case"left":return currency+e;case"right":return e+currency;case"left_space":return currency+" "+e;case"right_space":return e+" "+currency}}}]),e}())}(jQuery);
//# sourceMappingURL=single.js.map