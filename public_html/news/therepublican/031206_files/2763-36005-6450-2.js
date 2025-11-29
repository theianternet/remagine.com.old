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
  document.write(" codebase=\"\" id=\"2763/36005/a2_160x600.\" NAME=\"movie1353883\" WIDTH=\"160\" HEIGHT=\"600\">");
  if( mp_swver > 5 ) {
    document.write("<PARAM NAME=FlashVars VALUE=\"clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-2?mpt=507575464\">");
    document.write("<PARAM NAME=movie VALUE=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_160x600.swf\">");
  } else
    document.write("<PARAM NAME=movie VALUE=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_160x600.swf?clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-2?mpt=507575464\">");
  document.write("<PARAM NAME=wmode VALUE=\"opaque\">");
  if( mp_swver > 5 )
    document.write("<EMBED wmode=\"opaque\" NAME=\"2763/36005/a2_160x600.\" src=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_160x600.swf\" FlashVars=\"clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-2?mpt=507575464\"");
  else
    document.write("<EMBED wmode=\"opaque\" NAME=\"2763/36005/a2_160x600.\" src=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_160x600.swf?clickTAG=http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-2?mpt=507575464\"");
  document.write(" swLiveConnect=\"FALSE\" WIDTH=\"160\" HEIGHT=\"600\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"\">");
  document.write("</EMBED>");
  document.write("</OBJECT>");
} else if( !( navigator.appName && navigator.appName.indexOf("Netscape") >= 0 && navigator.appVersion.indexOf("2.") >= 0 ) ) {
  document.write("<a href=\"http://altfarm.mediaplex.com/ad/ck/2763-36005-6450-2?mpt=507575464\" TARGET=\"_blank\">");
  document.write("<IMG SRC=\"http://img-cdn.mediaplex.com/0/2763/36005/a2_160x600.gif\" WIDTH=\"160\" HEIGHT=\"600\" BORDER=0></a>");
}
//-->

