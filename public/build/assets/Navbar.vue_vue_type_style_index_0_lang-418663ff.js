import{o,f as a,a as c,n as d}from"./app-ee34ed33.js";import{_ as g}from"./_plugin-vue_export-helper-c27b6911.js";import{r as u}from"./UserIcon-3b17aadd.js";function x(t,e){return o(),a("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[c("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"})])}function k(t,e){return o(),a("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[c("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 8.25l-7.5 7.5-7.5-7.5"})])}let r;const _={data(){return{loading:!0,retry:1}},components:{UserIcon:u},mounted(){r=this},watch:{loading(){}},props:["type","src","alt","classes"],methods:{imageError:t=>{r.loading=!1,!(r.retry<0)&&(r.loading=!0,r.type=="user"?t.target.src="/assets/images/def-user.png":t.target.src="/assets/images/noimage.png",r.retry--)}}},m=["src","alt"];function p(t,e,n,f,s,i){return o(),a("img",{src:n.src,alt:n.alt,class:d(n.classes+(s.loading?" animate-pulse bg-gray-200 ":" ")),onLoad:e[0]||(e[0]=l=>s.loading=!s.loading),onError:e[1]||(e[1]=(...l)=>i.imageError&&i.imageError(...l))},null,42,m)}const y=g(_,[["render",p]]);export{y as I,x as a,k as r};
