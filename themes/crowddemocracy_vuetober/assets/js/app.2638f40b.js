(function(t){function e(e){for(var r,c,i=e[0],s=e[1],u=e[2],f=0,d=[];f<i.length;f++)c=i[f],Object.prototype.hasOwnProperty.call(o,c)&&o[c]&&d.push(o[c][0]),o[c]=0;for(r in s)Object.prototype.hasOwnProperty.call(s,r)&&(t[r]=s[r]);l&&l(e);while(d.length)d.shift()();return a.push.apply(a,u||[]),n()}function n(){for(var t,e=0;e<a.length;e++){for(var n=a[e],r=!0,i=1;i<n.length;i++){var s=n[i];0!==o[s]&&(r=!1)}r&&(a.splice(e--,1),t=c(c.s=n[0]))}return t}var r={},o={app:0},a=[];function c(e){if(r[e])return r[e].exports;var n=r[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.m=t,c.c=r,c.d=function(t,e,n){c.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},c.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},c.t=function(t,e){if(1&e&&(t=c(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)c.d(n,r,function(e){return t[e]}.bind(null,r));return n},c.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return c.d(e,"a",e),e},c.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},c.p="/C:\\laragon\\www\\crowddemocracy\\themes\\crowddemocracy_vuetober\\assets/";var i=window["webpackJsonp"]=window["webpackJsonp"]||[],s=i.push.bind(i);i.push=e,i=i.slice();for(var u=0;u<i.length;u++)e(i[u]);var l=s;a.push([0,"chunk-vendors"]),n()})({0:function(t,e,n){t.exports=n("56d7")},"56d7":function(t,e,n){"use strict";n.r(e);n("e260"),n("e6cf"),n("cca6"),n("a79d");var r=n("2b0e"),o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"app"}},[n("router-view")],1)},a=[],c={},i=c,s=n("2877"),u=Object(s["a"])(i,o,a,!1,null,null,null),l=u.exports,f=n("5f5b"),d=(n("f9e3"),n("2dd8"),n("8c4f")),p=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"wrap"},[n("h1",{staticClass:"text-center header"},[t._v("CrowdDemocracy")]),n("b-container",{staticClass:"content"},[n("b-row",[n("b-col",[n("h3",[t._v(" Na crowd democracy mozte dat svoj hlas novym navrhom alebo ho odovzdat ludom ktorym doverujete ")])]),n("b-col",{staticClass:"buttons"},[n("b-button",{attrs:{to:"/registration"}},[t._v("Registrovať sa")]),n("b-button",{attrs:{to:"/login"}},[t._v("Prihlásiť sa")])],1)],1)],1),t._m(0)],1)},m=[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("section",[n("p",[t._v("Post..")])])}],v={},h=v,b=(n("5ff6"),Object(s["a"])(h,p,m,!1,null,"9d7a6c46",null)),_=b.exports,y=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("h1",[t._v("Registration page")]),n("b-button",{attrs:{to:"home"}},[t._v("Home")])],1)},g=[],w={},j=Object(s["a"])(w,y,g,!1,null,null,null),O=j.exports,x=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("h1",[t._v("Login page")]),n("b-button",{attrs:{to:"home"}},[t._v("Home")])],1)},C=[],P={},$=P,k=Object(s["a"])($,x,C,!1,null,"5f228b57",null),E=k.exports,S=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"wrap"},[n("h1",[t._v("Crowddemocracy")]),n("b-button",{attrs:{to:"/",variant:"danger"}},[t._v("Odhlásiť sa")]),t._l(t.communities,(function(e,r){return n("div",{key:r,staticClass:"communities"},[n("div",{staticClass:"communitie"},[n("h1",[t._v(t._s(e.name))]),n("p",[t._v(t._s(e.description))])])])})),n("div",{staticClass:"tops"},[n("h2",[t._v("Top Komunity")]),t._l(t.communities,(function(e,r){return n("div",{key:r,staticClass:"names"},[n("h4",[t._v(t._s(e.name))])])}))],2)],2)},M=[],T=(n("d3b7"),{data:function(){return{communities:null}},mounted:function(){var t=this;fetch("http://crowddemocracy.test/api/communities").then((function(t){return t.json()})).then((function(e){t.communities=e.data}))}}),H=T,R=(n("f532"),Object(s["a"])(H,S,M,!1,null,"8223bc48",null)),z=R.exports;r["default"].use(d["a"]);var J=[{path:"/",name:"Intro",component:_},{path:"/registration",name:"Registration",component:O},{path:"/login",name:"Login",component:E},{path:"/home",name:"Home",component:z}],L=new d["a"]({mode:"history",routes:J}),D=L;r["default"].use(f["a"]),r["default"].config.productionTip=!1,new r["default"]({router:D,render:function(t){return t(l)}}).$mount("#app")},"5ff6":function(t,e,n){"use strict";var r=n("6c6e"),o=n.n(r);o.a},"6c6e":function(t,e,n){},ed78:function(t,e,n){},f532:function(t,e,n){"use strict";var r=n("ed78"),o=n.n(r);o.a}});
//# sourceMappingURL=app.2638f40b.js.map