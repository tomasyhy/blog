!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof module&&module.exports?module.exports=a(require("jquery")):a(window.jQuery)}(function(a){a.extend(a.summernote.plugins,{gxcode:function(b){var d=a.summernote.ui;b.memo("button.gxcode",function(){function c(a){return(a+"").replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}var a=d.button({contents:'<i class="fa fa-code"/> Code',tooltip:"Code Wrapper",click:function(a){var b=window.getSelection(),d=document.createElement("pre"),e=b.getRangeAt(0);b=c(b),d.innerHTML=b,e.deleteContents(),e.insertNode(d)}}),e=a.render();return e}),this.destroy=function(){this.$panel.remove(),this.$panel=null}}})});
