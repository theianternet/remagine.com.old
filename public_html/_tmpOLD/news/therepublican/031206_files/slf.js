// 2006/02/13 16:12:59
var ANV='3.1.0.26a';
var ANSID='12328';
var ANID='TID';
var ANP=2;
var ANEU="http://anrtx.tacoda.net/e/e.js?";
var ANT3=1;
var ANDPF;
var ANDPU="http://anrtx.tacoda.net/rtx/r.js?";
var ANCU="http://anrtx.tacoda.net/cbd/cbd?";
var ANURL=0;
var ANRDF=1;
var ANCC=0;
var ANDCC='lcn';
var ANVPC=ANDCC;
var ANSCC="unescape(document.location.href).toLowerCase()";
var AN2CC=new Array();
AN2CC[0]=new Array("c","surf","TVL");AN2CC[1]=new Array("c","travel","TVL");AN2CC[2]=new Array("c","lodge","TVL");AN2CC[3]=new Array("c","usair","TVL");AN2CC[4]=new Array("c","lodging","TVL");AN2CC[5]=new Array("c","airline","TVL");AN2CC[6]=new Array("c","bed & breakfast","TVL");AN2CC[7]=new Array("c","bed and breakfast","TVL");AN2CC[8]=new Array("c","vacation","TVL");AN2CC[9]=new Array("c","airport","TVL");AN2CC[10]=new Array("c","holiday","TVL");AN2CC[11]=new Array("c","fodors","TVL");AN2CC[12]=new Array("c","car rental","TVL");AN2CC[13]=new Array("c","spa","TVL");AN2CC[14]=new Array("c","hertz","TVL");AN2CC[15]=new Array("c","avis","TVL");AN2CC[16]=new Array("c","theme park","TVL");AN2CC[17]=new Array("c","destination","TVL");AN2CC[18]=new Array("c","flight","TVL");AN2CC[19]=new Array("c","amtrak","TVL");AN2CC[20]=new Array("c","hotel","TVL");AN2CC[21]=new Array("c","flier","TVL");AN2CC[22]=new Array("c","cruise","TVL");AN2CC[23]=new Array("c","eurotrain","TVL");AN2CC[24]=new Array("c","xpedia","TVL");AN2CC[25]=new Array("c","beach","TVL");AN2CC[26]=new Array("c","motel","TVL");AN2CC[27]=new Array("c","mountain","TVL");AN2CC[28]=new Array("c","tickets","TVL");AN2CC[29]=new Array("c","skiing","TVL");AN2CC[30]=new Array("c","boating","TVL");AN2CC[31]=new Array("c","resort","TVL");AN2CC[32]=new Array("c","marine","TVL");AN2CC[33]=new Array("c","yacht","TVL");AN2CC[34]=new Array("c","royal carribean","TVL");AN2CC[35]=new Array("c","holland america","TVL");AN2CC[36]=new Array("c","cunnard","TVL");AN2CC[37]=new Array("c","disney","TVL");AN2CC[38]=new Array("c","norwegian","TVL");AN2CC[39]=new Array("c","getaway","TVL");AN2CC[40]=new Array("c","escapes","TVL");AN2CC[41]=new Array("c","tourism","TVL");AN2CC[42]=new Array("c","dow jones","PFZ");AN2CC[43]=new Array("c","exchange","PFZ");AN2CC[44]=new Array("c","nasdaq","PFZ");AN2CC[45]=new Array("c","quote","PFZ");AN2CC[46]=new Array("c","standards & poor","PFZ");AN2CC[47]=new Array("c","recession","PFZ");AN2CC[48]=new Array("c","s & p","PFZ");AN2CC[49]=new Array("c","stocks","PFZ");AN2CC[50]=new Array("c","depression","PFZ");AN2CC[51]=new Array("c","banking","PFZ");AN2CC[52]=new Array("c","ticker","PFZ");AN2CC[53]=new Array("c","greenspan","PFZ");AN2CC[54]=new Array("c","options","PFZ");AN2CC[55]=new Array("c","money","PFZ");AN2CC[56]=new Array("c","trading","PFZ");AN2CC[57]=new Array("c","market","PFZ");AN2CC[58]=new Array("c","broker","PFZ");AN2CC[59]=new Array("c","invest","PFZ");AN2CC[60]=new Array("c","opi","PFZ");AN2CC[61]=new Array("c","financial","PFZ");AN2CC[62]=new Array("c","portfolio","PFZ");AN2CC[63]=new Array("c","chase manhattan","PFZ");AN2CC[64]=new Array("c","chemical bank","PFZ");AN2CC[65]=new Array("c","jp morgan","PFZ");AN2CC[66]=new Array("c","savings","PFZ");AN2CC[67]=new Array("c","checking","PFZ");AN2CC[68]=new Array("c","bonds","PFZ");AN2CC[69]=new Array("c","tax","PFZ");AN2CC[70]=new Array("c","futures","PFZ");AN2CC[71]=new Array("c","yen","PFZ");AN2CC[72]=new Array("c","dollar","PFZ");AN2CC[73]=new Array("c","dividends","PFZ");AN2CC[74]=new Array("c","interest","PFZ");AN2CC[75]=new Array("c","commission","PFZ");AN2CC[76]=new Array("c","audit","PFZ");AN2CC[77]=new Array("c","irs","PFZ");AN2CC[78]=new Array("c","statement","PFZ");AN2CC[79]=new Array("c","expense","PFZ");AN2CC[80]=new Array("c","accounting","PFZ");AN2CC[81]=new Array("c","kiplinger","PFZ");AN2CC[82]=new Array("c","loan","PFZ");AN2CC[83]=new Array("c","worksheet","PFZ");AN2CC[84]=new Array("c","vested","PFZ");AN2CC[85]=new Array("c","annuity","PFZ");AN2CC[86]=new Array("c","credit","PFZ");AN2CC[87]=new Array("c","cash","PFZ");AN2CC[88]=new Array("c","currency","PFZ");AN2CC[89]=new Array("c","asset","PFZ");AN2CC[90]=new Array("c","debt","PFZ");AN2CC[91]=new Array("c","consolidation","PFZ");AN2CC[92]=new Array("c","ira","PFZ");AN2CC[93]=new Array("c","inherit","PFZ");AN2CC[94]=new Array("c","income","PFZ");AN2CC[95]=new Array("c","salary","PFZ");AN2CC[96]=new Array("c","lien","PFZ");AN2CC[97]=new Array("c","equity","PFZ");AN2CC[98]=new Array("c","underwriter","PFZ");AN2CC[99]=new Array("c","mortgage","PFZ");AN2CC[100]=new Array("c","prospectus","PFZ");AN2CC[101]=new Array("c","foreclosure","PFZ");AN2CC[102]=new Array("c","fannie may","PFZ");AN2CC[103]=new Array("c","freddie mac","PFZ");AN2CC[104]=new Array("c","fortune","PFZ");AN2CC[105]=new Array("c","estate","PFZ");AN2CC[106]=new Array("c","annual report","PFZ");AN2CC[107]=new Array("c","quarterly","PFZ");AN2CC[108]=new Array("c","entrepreneur","SBZ");AN2CC[109]=new Array("c","capital","SBZ");AN2CC[110]=new Array("c","grant","SBZ");AN2CC[111]=new Array("c","bookkeeping","SBZ");AN2CC[112]=new Array("c","business plan","SBZ");AN2CC[113]=new Array("c","franchise","SBZ");AN2CC[114]=new Array("c","consulting","SBZ");AN2CC[115]=new Array("c","payroll","SBZ");AN2CC[116]=new Array("c","startup","SBZ");AN2CC[117]=new Array("c","incorporate","SBZ");AN2CC[118]=new Array("c","llc","SBZ");AN2CC[119]=new Array("c","oracle","SBZ");AN2CC[120]=new Array("c","office","SBZ");AN2CC[121]=new Array("c","peachtree","SBZ");AN2CC[122]=new Array("c","quicken","SBZ");AN2CC[123]=new Array("c","compensation","SBZ");AN2CC[124]=new Array("c","retirement","SBZ");AN2CC[125]=new Array("c","revenue","SBZ");AN2CC[126]=new Array("c","partnership","SBZ");AN2CC[127]=new Array("c","corporation","SBZ");AN2CC[128]=new Array("c","proprietorship","SBZ");AN2CC[129]=new Array("c","seminar","SBZ");AN2CC[130]=new Array("c","dba","SBZ");AN2CC[131]=new Array("c","corporate","SBZ");AN2CC[132]=new Array("c","home-based","SBZ");AN2CC[133]=new Array("c","disclosure","SBZ");AN2CC[134]=new Array("c","patent","SBZ");AN2CC[135]=new Array("c","invention","SBZ");AN2CC[136]=new Array("c","employment","SBZ");AN2CC[137]=new Array("c","benefits","SBZ");AN2CC[138]=new Array("c","outsourcing","SBZ");AN2CC[139]=new Array("c","pda","ADN");AN2CC[140]=new Array("c","laptop","ADN");AN2CC[141]=new Array("c","computer","ADN");AN2CC[142]=new Array("c","system","ADN");AN2CC[143]=new Array("c","satellite","ADN");AN2CC[144]=new Array("c","sony","ADN");AN2CC[145]=new Array("c","panasonic","ADN");AN2CC[146]=new Array("c","digital","ADN");AN2CC[147]=new Array("c","wireless","ADN");AN2CC[148]=new Array("c","software","ADN");AN2CC[149]=new Array("c","hardware","ADN");AN2CC[150]=new Array("c","download","ADN");AN2CC[151]=new Array("c","support","ADN");AN2CC[152]=new Array("c","bluetooth","ADN");AN2CC[153]=new Array("c","phone","ADN");AN2CC[154]=new Array("c","palm pilot","ADN");AN2CC[155]=new Array("c","treo","ADN");AN2CC[156]=new Array("c","blackberry","ADN");AN2CC[157]=new Array("c","mp3","ADZ");AN2CC[158]=new Array("c","ipod","ADZ");AN2CC[159]=new Array("c","fashion","AGK");AN2CC[160]=new Array("c","food","ACZ");AN2CC[161]=new Array("c","movies","MOV");AN2CC[162]=new Array("c","bars","NLF");AN2CC[163]=new Array("c","clubs","NLF");AN2CC[164]=new Array("c","dvd","AEB");AN2CC[165]=new Array("c","xbox","GAM");AN2CC[166]=new Array("c","playstation","GAM");AN2CC[167]=new Array("c","nintendo","GAM");AN2CC[168]=new Array("c","psp","GAM");AN2CC[169]=new Array("c","nano","ADZ");AN2CC[170]=new Array("c","segway","ADN");AN2CC[171]=new Array("c","sirius","ABU");
var ANAS="http://anad.tacoda.net";
var ANDD="example.org";
var ANDN=new Array();
var AMSTEP="tste";
var AMSTES="tte/blank.gif";
var AMSDPF;
var AMSLGC=0;
var AMSC=new Array(ANID);
var ANCB=0;
var ANDSZ=2;
var ANVAC='a';
var ANVSZ=ANDSZ;
var ANVAD=0;
var ANADS=new Array();
ANADS=["468x60a","728x90a","300x250a","120x600a","160x600a","468x60a|728x90a","120x600a|160x600a"];
var ANRD='';
var ANVDT=0;
var ANOO=0;
var ANVSC='';
var ANVDA=0;
var AMSK=new Array();
var AMSVL=new Array();
var AMSN=0;
function ANRC(n) {
var cn=n + "=";
var dc=document.cookie;
if (dc.length > 0) {
for(var b=dc.indexOf(cn); b!=-1; b=dc.indexOf(cn,b)) {
if((b!=0) && (dc.charAt(b-1) !=' ')) {
b++;
continue;
}
b+=cn.length;
var e=dc.indexOf(";",b);
if (e==-1) e=dc.length;
return unescape(dc.substring(b,e));
}
}
return null;
}
function ANSC(n,v,ex,p) {
var e=document.domain.split (".");
e.reverse();
var m=e[1] + '.' + e[0];
var cc=n+"="+escape(v);
if (ex) {
var exp=new Date;
exp.setTime(exp.getTime()+ex);
cc +=";expires="+exp.toGMTString();
}
if (p) {
cc +=";path="+p;
}
if (m) {
cc +=";domain="+m;
}
document.cookie=cc;
}
function ANGRD() {
if (top !=self || ANRD !='') {
return ANRD;
}
var rf=top.location.href;
var i=j=0;
i=rf.indexOf('/');
i=rf.indexOf('/',++i);
j=rf.indexOf('/',++i);
if (j==-1) {
j=rf.length;
}
r=rf.substring(i,j);
return r;
}
function ANTR(s) {
if (!s) {
return '';
}
s=s.replace(/^\s*/g,'');
s=s.replace(/\s*$/g,'');
return s;
}
function ANEH(m,u,l) {
var s=ANEU+'m='+escape(m)+'&u='+escape(u)+'&l='+l;
document.write('<SCR'+'IPT SRC="'+s+'" LANGUAGE="JavaScript"></SCR'+'IPT>');
return true;
}
function ANPF () {
if (ANT3==1) {
return;
}
var now=new Date;
var c=ANRC('T3CK');
if (c!=null) {
var f=c.split("|");
var r=q=j=0;
for (var i=0; i<f.length; i++) {
j=f[i].indexOf('TANO=');
if (j>=0) {
ANOO=f[i].substring(j+5);
continue;
}
j=f[i].indexOf('TANE=');
if (j>=0) {
r=1;
var e=f[i].substring(j+5);
if ((Date.parse(now)/1000) - e > 86400) {
q=1;
f[i]="";
}
continue;
}
j=f[i].indexOf('TANC=');
if (j>=0) {
ANCB=f[i].substring(j+5);
if (q==1) {
f[i]="";
}
continue;
}
}
if (r==0 || q==1) {
c=f.join("|");
ANSC("T3CK",c,4*365*24*60*60*1000,"/");
AN3CB();
}
} else {
AN3CB();
}
}
function ANDCB() {
ANSC('TCT',1, 60*1000, '/');
return ANRC('TCT')==null;
}
function AN3CB() {
document.write('<SCR'+'IPT SRC="'+ANCU+'"></SCR' + 'IPT>');
return;
}
function TCDA(ps) {
if (!ps || ps=='') {
return;
}
var pa=ps.split(";");
for (p in pa) {
kv=pa[p].split("=");
k=kv[0];
v=kv[1];
if (k!=null) {
k=ANTR(k);
}
if (v!=null) {
v=ANTR(v);
}
var m=k.toUpperCase();
switch (m) {
case ("SA"):
v=v.toLowerCase();
if (v!=null&&v!=''&&v.match(/[a-z]{1,2}/)) {
ANVAC=v;
}
break;
case ("SZ"):
v=v.toUpperCase();
if (v!=null&&v!='') {
ANVSZ=v;
}
break;
case ("CC"):
v=v.toUpperCase();
if (v!=null&&v!='') {
ANVPC=v;
}
break;
case ("SC"):
if (v!=null&&v!='') {
if (v.length > 256) {v=v.substring(0,256);}
ANVSC=v;
}
break;
case ("RD"):
if (v!=null&&v!='') {
if (v.length > 128) {v=v.substring(0,128);}
ANRD=v.toLowerCase();
}
break;
case ("DT"):
ANVDT=1;
break;
case ("DA"):
ANVDA=1;
break;
case ("AD"):
ANVAD=1;
break;
default:
if (v!=null&&v!='') {
ANCV(k,v);
}
}
}
if (ANVDT==1 && ANOO==0) {
ANDP(ANVPC);
ANVDT=0;
}
if (ANVAD==1) {
ANAP(ANVAC,ANVSZ);
ANVAD=0;
}
if (ANVDA==1) {
ANDA(ANSID,ANVPC,ANVSC);
ANVDA=0;
}
return;
}
ANPF();
if (typeof(tcdacmd) !='undefined' && tcdacmd !="") {
var f=tcdacmd;
tcdacmd='';
TCDA(f);
}
function Tacoda_AMS_DDC_addPair(k, v) {
ANCV(k,v);
}
function ANCV(k,v){
AMSK[AMSN]=k;
AMSVL[AMSN]=v;
AMSN++;
}
function ANTCV() {
var TVS="";
for(var i=0; i<AMSN; i++) {
if (!AMSK[i]) {
continue;
}
if (!AMSVL[i]) {
AMSVL[i]='';
}
TVS +="&v_" + escape( AMSK[i].toLowerCase() ) + "=" + escape( AMSVL[i].toLowerCase() ) ;
}
return TVS;
}
function Tacoda_AMS_DDC(tiu, tjv) {
ANDDC(tiu,tjv);
}
function ANDA() {
var t='';
var e=ANGRD().split(".");
e.reverse();
t=e[1] + '.' + e[0];
if (typeof(ANDN[t])!='undefined') {
t=ANDN[t];
}
else {
t=ANDD;
}
var tiu='http://'+AMSTEP+'.'+t+'/'+AMSTES;
ANDDC(tiu,"0.0");
}
function ANDDC(tiu, tjv) {
if ((ANP&1)==0) {
return;
}
if (AMSDPF==1) {
return;
} else {
AMSDPF=1;
}
var ckblk=ANDCB();
var ta="?"+Math.random()+"&v="+ANV+"&r="+escape(document.referrer)+"&p="+ANVPC+":"+escape(ANVSC);
if (AMSLGC==1) {
ta +="&page="+escape(window.location.href);
}
ta +="&tz="+(new Date()).getTimezoneOffset()+"&s="+ANSID;
if (ckblk) {
ta +="&ckblk1";
} else {
if (ANCB==1) {
ta+="&ckblk3";
}
for(var i=0; i<AMSC.length; i++) {
var cl=AMSC[i];
var clv=ANRC(cl);
if(cl !=null) {
ta +="&c_"+escape(cl)+"="+escape(clv);
}
}
}
ta +=ANTCV();
document.write('<IMG'+' SRC="' + tiu + ta + '" STYLE="display: none" height="1" width="1" border="0">');
}
function ANDP(pc) {
if ((ANP&2)==0) {
return;
}
if (ANDPF==1) {
return;
} else {
ANDPF=1;
}
ANVPC=pc;
if (ANCC==0) {
ANVPC=ANS2CC(eval(ANSCC));
}
if (!ANVPC.match(/\w{3}$/)) {ANVPC=ANDCC;}
var ANU="";
var ckblk="";
if (ANDCB()) {
ckblk="&ckblk1";
}
if (ANCB==1) {
ckblk="&ckblk3";
}
if (ANURL==1) {
ANU="&page="+escape(window.location.href);
}
if (ANRDF==1) {
ANU +="&r=" + ANGRD();
}
if (ANVPC!='') {
document.write('<SCR'+'IPT SRC="'+ANDPU+"cmd="+ANVPC+'&si='+ANSID+ANU+'&v='+ANV+ckblk+'&cb='+Math.random()+'" LANGUAGE="JavaScript"></SCR' + 'IPT>');
}
}
function ANS2CC (s) {
if (!s) {
return ANDCC;
}
for (i=0; i<AN2CC.length; i++) {
if (!AN2CC[i][0] || !AN2CC[i][1]) {
continue;
}
switch (AN2CC[i][0]) {
case 'e':
if ((s.indexOf(AN2CC[i][1])==0) && (s.length==AN2CC[i][1].length)) {
return AN2CC[i][2];
}
break;
case 'c':
if (s.indexOf(AN2CC[i][1]) !=-1) {
return AN2CC[i][2];
}
break;
case 'p':
if (s.indexOf(AN2CC[i][1])==0) {
return AN2CC[i][2];
}
break;
case 's':
if (s.lastIndexOf(AN2CC[i][1])==(s.length - AN2CC[i][1].length)) {
return AN2CC[i][2];
}
break;
case 'r':
if (s.search(AN2CC[i][1]) !=-1) {
return AN2CC[i][2];
}
break;
}
}
return ANDCC;
}
function ANAP(ac,sz,pc) {
if (sz <=ANADS.length) {
ANVAC=ac.toLowerCase();
var au='<SCR'+'IPT SRC="'+ANAS+'/cgi-bin/ads/';
if (sz==4||sz==5||sz==7) {
au+='sk';
}
else {
au+='ad';
}
au+=ANSID+ANVAC+'.cgi/v=2.0S/sz='+ANADS[sz-1]+'/'+Math.round(Math.random()*100000)+'/RETURN-CODE/JS/" LANGUAGE="JavaScript"></SCR' + 'IPT>';
document.write(au);
}
ANVSZ=ANDSZ;
}
