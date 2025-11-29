////////////////////////////////////////////////////////////////////
// Netricks' Content Manager, Copyright (c) 2003 Netricks, Inc. ////
// Content Manager is licensed under the AGPL //////////////////////
// Content Manager comes with ABSOLUTELY NO WARRANTY ///////////////
// See license.txt and readme.txt for details //////////////////////
////////////////////////////////////////////////////////////////////
function preloadImages()
{
	var d=document; if(d.images)
	{
		if(!d.p) d.p=new Array();
		var i,j=d.p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0)
		{
			d.p[j]=new Image;
			d.p[j++].src=a[i];
		}
	}
}
function swapImgRestore()
{
	  var i,x,a=document.sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function swapImage()
{
	var i,j=0,x,a=swapImage.arguments; document.sr=new Array; for(i=0;i<(a.length-2);i+=3)
	if ((x=findObj(a[i]))!=null){document.sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function findObj(n, d)
{
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length)
	{
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);
	}
	if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document); return x;
}
function validate_contact()
{
	if(document.getElementById('form').Name.value==""){alert("Please enter your name.");return false;}
	else if(document.getElementById('form').Email.value==""){alert("Please enter your email address.");return false;}
	else if(document.getElementById('form').Comments.value==""){alert("Please enter your comments.");return false;}
}
function validate_newsletter()
{
	if(document.getElementById('newsletter').email.value==""){alert("Please enter your email address.");return false;}
}
function validate_search()
{
	if(document.getElementById('search').query.value==""){alert("Please enter what you are looking for.");return false;}
}
function blocking(nr)
{
	if (document.getElementById)
	{
		current=(document.getElementById(nr).style.display=='none')?'block':'none';
		document.getElementById(nr).style.display=current;
	}
}