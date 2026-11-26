const L=/\.(pdf|xlsx?|csv|docx?|pptx?|zip|rar|png|jpe?g|gif)(\?|#|$)|(pdf|excel|xlsx|exportar|descargar|download|imprimir|reporte_pdf)/i,E=`
.tesvb-carga-barra{position:fixed;top:0;left:0;z-index:2147483646;height:3px;width:0;opacity:0;pointer-events:none;
  background:linear-gradient(90deg,rgba(70,95,255,.55),rgb(70,95,255) 60%,rgb(54,65,245));
  box-shadow:0 0 10px rgba(70,95,255,.6),0 0 4px rgba(70,95,255,.5);border-radius:0 3px 3px 0;
  transition:width .35s ease,opacity .3s ease}
.tesvb-carga-barra.activa{opacity:1}
.tesvb-carga-capa{position:fixed;inset:0;z-index:2147483645;display:flex;align-items:center;justify-content:center;padding:16px;
  background:rgba(16,24,40,.28);-webkit-backdrop-filter:blur(3px);backdrop-filter:blur(3px);
  opacity:0;visibility:hidden;transition:opacity .25s ease,visibility 0s linear .25s;
  font-family:var(--tesvb-font-family,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif)}
.tesvb-carga-capa.visible{opacity:1;visibility:visible;transition:opacity .25s ease}
.tesvb-carga-tarjeta{width:100%;max-width:360px;border-radius:16px;background:#fff;border:1px solid #e4e7ec;
  box-shadow:0 20px 24px -4px rgba(16,24,40,.10),0 8px 8px -4px rgba(16,24,40,.04);
  padding:28px 24px 24px;text-align:center;transform:translateY(8px) scale(.98);transition:transform .25s ease}
.tesvb-carga-capa.visible .tesvb-carga-tarjeta{transform:none}
.tesvb-carga-icono{position:relative;width:92px;height:92px;margin:0 auto 18px}
.tesvb-carga-aro{position:absolute;inset:0;border-radius:50%;border:3px solid #ecf3ff;border-top-color:rgb(70,95,255);
  border-right-color:rgba(70,95,255,.45);animation:tesvb-carga-gira .9s linear infinite}
.tesvb-carga-logo{position:absolute;inset:8px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;overflow:hidden}
.tesvb-carga-logo img{max-width:84%;max-height:84%;object-fit:contain}
.tesvb-carga-logo span{width:14px;height:14px;border-radius:50%;background:rgb(70,95,255);animation:tesvb-carga-late 1.2s ease-in-out infinite}
.tesvb-carga-titulo{margin:0 0 6px;font-size:16px;line-height:24px;font-weight:600;color:#1d2939}
.tesvb-carga-texto{margin:0;font-size:14px;line-height:20px;color:#667085}
.tesvb-carga-puntos{display:flex;justify-content:center;gap:6px;margin-top:16px}
.tesvb-carga-puntos i{width:6px;height:6px;border-radius:50%;background:rgb(70,95,255);opacity:.25;animation:tesvb-carga-punto 1.2s ease-in-out infinite}
.tesvb-carga-puntos i:nth-child(2){animation-delay:.15s}.tesvb-carga-puntos i:nth-child(3){animation-delay:.3s}
.tesvb-carga-ocultar{display:none;margin:18px auto 0;cursor:pointer;border:0;border-radius:8px;padding:8px 14px;font:inherit;font-size:14px;font-weight:500;
  color:#344054;background:#fff;box-shadow:inset 0 0 0 1px #d0d5dd,0 1px 2px rgba(16,24,40,.05)}
.tesvb-carga-ocultar:hover{background:#f9fafb}
.tesvb-carga-capa.lenta .tesvb-carga-ocultar{display:inline-flex}
.dark .tesvb-carga-capa{background:rgba(0,0,0,.45)}
.dark .tesvb-carga-tarjeta{background:#1a2231;border-color:#344054}
.dark .tesvb-carga-logo{background:#fff;box-shadow:0 0 0 1px rgba(255,255,255,.08)}
.dark .tesvb-carga-aro{border-color:rgba(70,95,255,.18);border-top-color:#7592ff;border-right-color:rgba(117,146,255,.45)}
.dark .tesvb-carga-titulo{color:rgba(255,255,255,.9)}
.dark .tesvb-carga-texto{color:#98a2b3}
.dark .tesvb-carga-ocultar{color:#d0d5dd;background:#1d2939;box-shadow:inset 0 0 0 1px #475467}
@keyframes tesvb-carga-gira{to{transform:rotate(360deg)}}
@keyframes tesvb-carga-late{0%,100%{transform:scale(.7);opacity:.6}50%{transform:scale(1);opacity:1}}
@keyframes tesvb-carga-punto{0%,100%{opacity:.25;transform:translateY(0)}40%{opacity:1;transform:translateY(-3px)}}
@media (prefers-reduced-motion:reduce){.tesvb-carga-aro,.tesvb-carga-logo span,.tesvb-carga-puntos i{animation-duration:2.4s}
  .tesvb-carga-barra,.tesvb-carga-capa,.tesvb-carga-tarjeta{transition:none}}
`;let i,o,h,c,l,d,g,n=0,b=!1;function y(){if(o)return;const e=document.createElement("style");e.textContent=E,document.head.appendChild(e),i=document.createElement("div"),i.className="tesvb-carga-barra",i.setAttribute("aria-hidden","true");const t=document.querySelector('img[alt="TESVB"]'),r=document.querySelector('meta[name="tesvb-logo"]'),a=t?t.getAttribute("src"):r?r.getAttribute("content"):null;o=document.createElement("div"),o.className="tesvb-carga-capa",o.setAttribute("role","status"),o.setAttribute("aria-live","polite"),o.innerHTML='<div class="tesvb-carga-tarjeta"><div class="tesvb-carga-icono"><div class="tesvb-carga-aro"></div><div class="tesvb-carga-logo">'+(a?'<img alt="" src="'+a.replace(/"/g,"&quot;")+'">':"<span></span>")+'</div></div><p class="tesvb-carga-titulo"></p><p class="tesvb-carga-texto"></p><div class="tesvb-carga-puntos" aria-hidden="true"><i></i><i></i><i></i></div><button type="button" class="tesvb-carga-ocultar">Ocultar aviso</button></div>',h=o.querySelector(".tesvb-carga-titulo"),c=o.querySelector(".tesvb-carga-texto"),o.querySelector(".tesvb-carga-ocultar").addEventListener("click",()=>k()),document.body.appendChild(i),document.body.appendChild(o)}function w(){y(),clearInterval(l);let e=parseFloat(i.style.width)||0;i.classList.contains("activa")||(e=0,i.style.transition="none",i.style.width="0",i.offsetWidth,i.style.transition="",i.classList.add("activa"));const t=()=>{e+=(90-e)*(e<40?.18:.06),i.style.width=e+"%"};t(),l=setInterval(t,300)}function A(){!i||!i.classList.contains("activa")||(clearInterval(l),i.style.width="100%",setTimeout(()=>{i.classList.remove("activa"),setTimeout(()=>{i.classList.contains("activa")||(i.style.width="0")},300)},250))}function k(){clearTimeout(d),clearTimeout(g),o&&o.classList.remove("visible","lenta")}function u(e="Cargando pantalla…",t="Estamos preparando la información. No cierres ni recargues la página."){y(),b=!0,w(),clearTimeout(d),clearTimeout(g),h.textContent=e,c.textContent=t,o.classList.remove("lenta"),d=setTimeout(()=>o.classList.add("visible"),500),g=setTimeout(()=>{c.textContent="Está tardando más de lo normal. Puedes seguir esperando; la pantalla se abrirá en cuanto esté lista.",o.classList.add("lenta")},12e3)}function v(){b=!1,k(),n===0&&A()}function T(e,t){if(!e||t&&t!=="_self"&&t!=="_top"&&t!=="_parent")return!1;const r=e.trim();if(/^(#|javascript:|mailto:|tel:|data:|blob:)/i.test(r))return!1;let a;try{a=new URL(r,location.href)}catch{return!1}return a.origin!==location.origin||a.pathname===location.pathname&&a.search===location.search&&a.hash?!1:!L.test(a.pathname+a.search)}function j(e){const t=(e.getAttribute("action")||"").toLowerCase();return/logout|salir|cerrar_sesion/.test(t)?["Cerrando sesión…","Un momento, estamos cerrando tu sesión de forma segura."]:(e.getAttribute("method")||"get").toLowerCase()==="get"?["Buscando información…","Estamos consultando los datos. No cierres ni recargues la página."]:["Guardando información…","Estamos registrando los datos. No cierres ni recargues la página ni vuelvas a enviar el formulario."]}function m(e,t){if(!e||e.hasAttribute("data-sin-carga")||t&&t.hasAttribute&&t.hasAttribute("data-sin-carga"))return;const r=t&&t.getAttribute&&t.getAttribute("formtarget")||e.getAttribute("target"),a=t&&t.getAttribute&&t.getAttribute("formaction")||e.getAttribute("action")||location.href;T(a,r)&&u(...j(e))}function x(){document.addEventListener("click",r=>{if(r.button!==0||r.ctrlKey||r.metaKey||r.shiftKey||r.altKey)return;const a=r.target.closest?r.target.closest("a[href], [onclick]"):null;if(!a||a.closest("[data-sin-carga]")||a.hasAttribute("data-toggle")||a.hasAttribute("data-dismiss"))return;let s=null,p=null;if(a.tagName==="A"&&a.hasAttribute("href")){if(a.hasAttribute("download"))return;s=a.getAttribute("href"),p=a.getAttribute("target")}else{const f=(a.getAttribute("onclick")||"").match(/location(?:\.href)?\s*=\s*['"]([^'"]+)['"]/);if(!f||/window\.open/.test(a.getAttribute("onclick")))return;s=f[1]}setTimeout(()=>{!r.defaultPrevented&&T(s,p)&&u()},0)}),document.addEventListener("submit",r=>{const a=r.target;setTimeout(()=>{r.defaultPrevented||m(a,r.submitter)},0)});const e=HTMLFormElement.prototype.submit;HTMLFormElement.prototype.submit=function(){try{m(this,null)}catch{}return e.apply(this,arguments)},window.addEventListener("pageshow",()=>v());const t=window.jQuery;t&&t(document).on&&(t(document).on("ajaxSend",()=>{n++,w()}),t(document).on("ajaxComplete",()=>{n=Math.max(0,n-1),n===0&&!b&&A()})),window.TesvbCarga={mostrar:u,ocultar:v}}window.TesvbCarga||(document.readyState==="loading"?document.addEventListener("DOMContentLoaded",x):x());
