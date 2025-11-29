function POP(u,n,w,h,f){ 
windowFeatures = "width="+w+",height="+h; 
if (f) windowFeatures += ","+f;
popwin = this.open(u, n, windowFeatures);
if (!popwin.opener) popwin.opener=self;
if (popwin.focus) popwin.focus();
return false;
}
