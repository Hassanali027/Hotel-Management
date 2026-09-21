{{-- Shared CRUD helpers: csrf token, modal styles, post() helper --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>window.ROLE='{{ auth()->user()->role ?? '' }}';window.IS_ADMIN=(ROLE==='admin');window.CAN_MANAGE=(ROLE==='admin'||ROLE==='manager');</script>
<style>
.modal-ov{position:fixed;inset:0;background:rgba(0,0,0,.4);display:none;align-items:center;justify-content:center;z-index:100;zoom:1}
.modal-ov.open{display:flex}
.modal{background:#fff;border-radius:16px;padding:26px;width:440px;max-width:92vw;max-height:90vh;overflow:auto;font-family:Lato,Arial,sans-serif}
.modal h3{margin:0 0 18px;font-size:20px}
.modal label{display:block;font-size:13px;color:#777;margin:12px 0 5px}
.modal input,.modal select,.modal textarea{width:100%;height:42px;border:1px solid #e2e2e2;border-radius:9px;padding:0 12px;font-size:14px;font-family:inherit;color:#222}
.modal textarea{height:70px;padding:9px 12px}
.modal .mrow{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.modal .mact{display:flex;justify-content:flex-end;gap:10px;margin-top:20px}
.modal .mbtn{height:42px;border:0;border-radius:9px;padding:0 20px;font-size:14px;font-weight:700;cursor:pointer}
.modal .mbtn.cancel{background:#f2f2f2;color:#444}
.modal .mbtn.save{background:#e8fb82;color:#2f3a0c}
.flash{position:fixed;top:20px;right:20px;background:#e8fb82;color:#2f3a0c;padding:12px 18px;border-radius:10px;font-weight:700;z-index:200;box-shadow:0 6px 18px rgba(0,0,0,.12);font-family:Lato,Arial,sans-serif;zoom:1}
select.fsel{height:44px;border:0;border-radius:11px;padding:0 36px 0 16px;font-size:15px;font-family:Lato,Arial,sans-serif;background-color:#f4f4f4;color:#333;cursor:pointer;-webkit-appearance:none;appearance:none;background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><path d='m6 9 6 6 6-6'/></svg>");background-repeat:no-repeat;background-position:right 12px center}
select.fsel.lime{background-color:#e8fb82;color:#2f3a0c;font-weight:700}
</style>
@if(session('ok'))<div class="flash" id="flash">{{ session('ok') }}</div>@endif
<div class="modal-ov" id="detailModal"><div class="modal"><h3 id="detailTitle"></h3><div id="detailBody" style="font-size:14px;line-height:1.9;color:#444"></div><div class="mact"><button class="mbtn cancel" onclick="closeModal('detailModal')">Close</button></div></div></div>
<script>
function openModal(id){document.getElementById(id).classList.add('open')}
function closeModal(id){document.getElementById(id).classList.remove('open')}
function post(url,method,data){
  const f=document.createElement('form');f.method='POST';f.action=url;f.style.display='none';
  const t=document.querySelector('meta[name=csrf-token]').content;
  let h='<input name="_token" value="'+t+'">'+(method&&method!=='POST'?'<input name="_method" value="'+method+'">':'');
  if(data)for(const k in data)h+='<input name="'+k+'" value="'+data[k]+'">';
  f.innerHTML=h;document.body.appendChild(f);f.submit();
}
window.PGSTATE={};
function paginateRender(key,list,per,renderFn){
 const st=(PGSTATE[key]=PGSTATE[key]||{page:1});
 const total=list.length,pages=Math.max(1,Math.ceil(total/per));
 if(st.page>pages)st.page=pages; if(st.page<1)st.page=1;
 const start=(st.page-1)*per;
 renderFn(list.slice(start,start+per));
 const info=document.getElementById(key+'Info'); if(info)info.textContent='Showing '+(total?start+1:0)+'-'+Math.min(start+per,total)+' of '+total;
 const pg=document.getElementById(key+'Pages');
 if(pg){let h='<button class="pg" data-p="prev">‹</button>';for(let i=1;i<=pages;i++)h+='<button class="pg '+(i===st.page?'active':'')+'" data-p="'+i+'">'+i+'</button>';h+='<button class="pg" data-p="next">›</button>';pg.innerHTML=h;pg.querySelectorAll('.pg').forEach(b=>b.onclick=()=>{const p=b.dataset.p;if(p==='prev')st.page--;else if(p==='next')st.page++;else st.page=+p;paginateRender(key,list,per,renderFn);});}
}
function pgReset(key){if(PGSTATE[key])PGSTATE[key].page=1;}
function downloadPdf(name, content){
  const safe=String(content).replace(/[^\x20-\x7E\n]/g,'?').replace(/[()\\]/g,'\\$&');
  const lines=safe.split('\n');
  const body=['BT','/F1 16 Tf','50 790 Td'];
  lines.forEach((line,index)=>{if(index)body.push('0 -18 Td');body.push('('+line+') Tj')});
  body.push('ET');
  const stream=body.join('\n');
  const objects=['<< /Type /Catalog /Pages 2 0 R >>','<< /Type /Pages /Kids [3 0 R] /Count 1 >>','<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 5 0 R >> >> /Contents 4 0 R >>','<< /Length '+stream.length+' >>\nstream\n'+stream+'\nendstream','<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>'];
  let pdf='%PDF-1.4\n';const offsets=[0];
  objects.forEach((object,index)=>{offsets.push(pdf.length);pdf+=(index+1)+' 0 obj\n'+object+'\nendobj\n'});
  const xref=pdf.length;pdf+='xref\n0 '+(objects.length+1)+'\n0000000000 65535 f \n';
  offsets.slice(1).forEach(offset=>pdf+=String(offset).padStart(10,'0')+' 00000 n \n');
  pdf+='trailer\n<< /Size '+(objects.length+1)+' /Root 1 0 R >>\nstartxref\n'+xref+'\n%%EOF';
  const url=URL.createObjectURL(new Blob([pdf],{type:'application/pdf'}));const link=document.createElement('a');link.href=url;link.download=name;document.body.appendChild(link);link.click();link.remove();setTimeout(()=>URL.revokeObjectURL(url),1000);
}
function downloadFile(name,content){if(name.toLowerCase().endsWith('.pdf'))return downloadPdf(name,content);const b=new Blob([content],{type:'text/plain'});const u=URL.createObjectURL(b);const a=document.createElement('a');a.href=u;a.download=name;document.body.appendChild(a);a.click();a.remove();URL.revokeObjectURL(u);}
function showDetail(title,html){const t=document.getElementById('detailTitle'),b=document.getElementById('detailBody');if(t)t.textContent=title;if(b)b.innerHTML=html;openModal('detailModal');}
window.SORT={};
function sortCol(key,f,apply){const st=SORT[key]=SORT[key]||{};if(st.f===f)st.a=!st.a;else{st.f=f;st.a=true;}apply();}
function sortList(key,list){const st=SORT[key];if(!st||!st.f)return list;return [...list].sort((a,b)=>{let x=a[st.f],y=b[st.f];const nx=parseFloat(x),ny=parseFloat(y);if(!isNaN(nx)&&!isNaN(ny)&&String(x).match(/^[$]?[\d.]+/)&&String(y).match(/^[$]?[\d.]+/))return (nx-ny)*(st.a?1:-1);return String(x==null?'':x).localeCompare(String(y==null?'':y))*(st.a?1:-1);});}
document.addEventListener('click',e=>{if(e.target.classList&&e.target.classList.contains('modal-ov'))e.target.classList.remove('open')});
setTimeout(()=>{const fl=document.getElementById('flash');if(fl)fl.remove()},2500);
</script>
