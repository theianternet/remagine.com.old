var mp_swver = 0;
var mp_pos = 0;
if( navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"] && navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin ) {
  if( navigator.plugins && navigator.plugins["Shockwave Flash"] ) {
    mp_pos = navigator.plugins["Shockwave Flash"].description.indexOf("Shockwave Flash");
    mp_swver = navigator.plugins["Shockwave Flash"].description.substr(mp_pos+16,1);
  }
} else if ( navigator.userAgent && navigator.userAgent.indexOf("MSIE") >= 0 && ( navigator.userAgent.indexOf("Windows") >= 0 ) ) {
  document.write("<SCR"+"IPT LANGUAGE=VBScript>\n");
  document.write("on error resume next\n");
  document.write("For mp_i=11 To 6 Step -1\n");
  document.write("If Not IsObject(CreateObject(\"ShockwaveFlash.ShockwaveFlash.\" & mp_i)) Then\n");
  document.write("Else\n");
  document.write("  mp_swver=mp_i\n");
  document.write("  Exit For\n");
  document.write("End If\n");
  document.write("Next\n");
  document.write("</SCR"+"IPT> \n");
}
if( mp_swver >= 6 ) {
  document.write("<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"");
  document.write(" codebase=\"\" id=\"2763/36005/a2_300x250.\" NAME=\"movie1353891\" WIDTH=\"300\" HEIGHT=\"250\">");
  if( mp_swver > 5 ) {
    document.write("<PARAM NAME=FlashVars VALUE=\"clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-1?mpt=%25%25REALRAND%25%25\">");
    document.write("<PARAM NAME=movie VALUE=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_300x250.swf\">");
  } else
    document.write("<PARAM NAME=movie VALUE=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_300x250.swf?clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-1?mpt=%25%25REALRAND%25%25\">");
  document.write("<PARAM NAME=wmode VALUE=\"opaque\">");
  if( mp_swver > 5 )
    document.write("<EMBED wmode=\"opaque\" NAME=\"2763/36005/a2_300x250.\" src=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_300x250.swf\" FlashVars=\"clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-1?mpt=%25%25REALRAND%25%25\"");
  else
    document.write("<EMBED wmode=\"opaque\" NAME=\"2763/36005/a2_300x250.\" src=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_300x250.swf?clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-1?mpt=%25%25REALRAND%25%25\"");
  document.write(" swLiveConnect=\"FALSE\" WIDTH=\"300\" HEIGHT=\"250\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"\">");
  document.write("</EMBED>");
  document.write("</OBJECT>");
} else if( !( navigator.appName && navigator.appName.indexOf("Netscape") >= 0 && navigator.appVersion.indexOf("2.") >= 0 ) ) {
  document.write("<a href=\"http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-1?mpt=%%REALRAND%%\" TARGET=\"_blank\">");
  document.write("<IMG SRC=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_300x250.gif\" WIDTH=\"300\" HEIGHT=\"250\" BORDER=0></a>");
}
//-->

