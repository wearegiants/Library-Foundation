var NB_CASES=16;
var Vocalisation={DUREE_SON:1.1,DUREE_SONS:0,active:false,charge:false,audioTagSupport:false,canPlayOgg:false,canPlayMp3:false,canPlaySwf:false,swf:false,mp3Ogg:false,flashVersion:"",audios:null,first:true,timePlay:null,chiffreSelectionne:false,chiffreCourant:-1,initialisationOk:false,elementInfoCache:false,premiereVocalisation:true,charger:function(){if(!this.estVocalisable){return
}if(this.charge){return
}var a=document.createElement("script");
a.setAttribute("type","text/javascript");
if(isIOS()){if(this.estVocalisableAvecAudio()){a.src=PATH_STATIQUE+"/js/val_keypad_cvvs_audio-unifie.js";
this.charge=true;
this.mp3Ogg=true
}}else{if(isChrome()){if(this.estVocalisableAvecAudio()){a.src=PATH_STATIQUE+"/js/val_keypad_cvvs_audio.js";
this.charge=true;
this.mp3Ogg=true
}else{if(this.estVocalisableAvecSwf()){a.src=PATH_STATIQUE+"/js/val_keypad_cvvs_swf-unifie.js";
this.charge=true;
this.canPlaySwf=true
}}}else{if(this.estVocalisableAvecSwf()){a.src=PATH_STATIQUE+"/js/val_keypad_cvvs_swf.js";
this.charge=true
}}}document.getElementsByTagName("head")[0].appendChild(a)
},initialiser:function(a){},startVocalise:function(a){},startClick:function(){},stopVocalise:function(){},estVocalisableAvecAudio:function(){this.audioTagSupport=!!(document.createElement("audio").canPlayType);
try{var a=new Audio("");
this.audioObjSupport=!!(a.canPlayType);
if(a.canPlayType){this.canPlayMp3=("no"!=a.canPlayType("audio/mpeg"))&&(""!=a.canPlayType("audio/mpeg"))
}}catch(c){this.audioObjSupport=false;
this.basicAudioSupport=false;
this.canPlayOgg=false;
this.canPlayMp3=false
}return(this.audioObjSupport&&(this.canPlayOgg||this.canPlayMp3))
},estVocalisableAvecSwf:function(){var g=!1,a="";
function c(e){e=e.match(/[\d]+/g);
e.length=3;
return e.join(".")
}if(navigator.plugins&&navigator.plugins.length){var k=navigator.plugins["Shockwave Flash"];
k&&(g=!0,k.description&&(a=c(k.description)));
navigator.plugins["Shockwave Flash 2.0"]&&(g=!0,b="2.0.0.11")
}else{if(navigator.mimeTypes&&navigator.mimeTypes.length){var i=navigator.mimeTypes["application/x-shockwave-flash"];
(g=i&&i.enabledPlugin)&&(a=c(i.enabledPlugin.description))
}else{try{var j=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.8");
g=!0;
a=c(j.GetVariable("$version"))
}catch(d){}}}this.swf=g;
this.flashVersion=a;
return this.swf
},estVocalisable:function(){return this.estVocalisableAvecAudio||this.estVocalisableAvecSwf
},calculerDureeSons:function(){try{if((this.audios.duration>this.DUREE_SONS)){this.DUREE_SON=this.audios.duration/(NB_CASES+1);
this.DUREE_SONS=this.audios.duration;
console.log("duree son calculee : "+this.DUREE_SONS.toString());
console.log("duree son unitaire : "+this.DUREE_SON.toString())
}if(!this.audios.paused){this.audios.pause()
}}catch(a){console.log("erreur calcul duration : "+a)
}}};
var Cookie={creer:function(h,i){var g=this.creer.arguments;
var e=this.creer.arguments.length;
var d=(e>2)?g[2]:null;
var j=(e>3)?g[3]:null;
var f=(e>4)?g[4]:null;
var c=(e>5)?g[5]:false;
var a=h+"="+escape(i)+((d==null||d=="")?"":("; expires="+d.toGMTString()))+((j==null)?"":("; path="+j))+((f==null)?"":("; domain="+f))+((c==true)?"; secure":"");
document.cookie=a
},getValeur:function(c){var a=document.cookie.indexOf(";",c);
if(a==-1){a=document.cookie.length
}return unescape(document.cookie.substring(c,a))
},lire:function(d){var c=d+"=";
var g=c.length;
var a=document.cookie.length;
var f=0;
while(f<a){var e=f+g;
if(document.cookie.substring(f,e)==c){return this.getValeur(e)
}f=document.cookie.indexOf(" ",f)+1;
if(f==0){break
}}return null
}};
String.prototype.trim=function(){return this.replace(/^\s+|\s+$/,"")
};
function is_touch_device(){return !!("ontouchstart" in window)||!!("onmsgesturechange" in window)
}var CVSVTable={focusChiffre:null,nbmax:6,nb:0,boutons:function(){var a=$("#imageclavier input, #imageclavier button, #imageclavier a, #imageclavier area");
if(!is_touch_device()){a.on("click",function(c){CVSVTable.cliquer(c)
});
a.on("focus",function(c){CVSVTable.focus(c)
});
a.on("mouseover",function(c){CVSVTable.mouseover(c)
});
a.on("keydown",function(c){CVSVTable.keyDown(c)
})
}else{a.on("focus",function(c){CVSVTable.focus(c)
});
a.on("click",function(c){CVSVTable.toucher(c)
});
a.on("keydown",function(c){CVSVTable.keyDown(c)
})
}},keyDown:function(d){var c=d.keyCode||d.which;
var a=d.target||d.srcElement;
var f={space:32,left:37,up:38,right:39,down:40};
switch(c){case f.space:if(a.tagName!="AREA"&&a.tagName!="IMG"){break
}CVSVTable.valide();
d.preventDefault();
break;
case f.left:if(CVSVTable.focusChiffre==null){CVSVTable.focusChiffre=0
}else{if(CVSVTable.focusChiffre>0){CVSVTable.focusChiffre--
}else{if(CVSVTable.focusChiffre==0){d.preventDefault();
break
}}}$("#val_cel_"+CVSVTable.focusChiffre).focus();
Vocalisation.stopVocalise();
Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre));
d.preventDefault();
break;
case f.right:if(CVSVTable.focusChiffre==null){CVSVTable.focusChiffre=0
}else{if(CVSVTable.focusChiffre<(NB_CASES-1)){CVSVTable.focusChiffre++
}else{if(CVSVTable.focusChiffre==(NB_CASES-1)){d.preventDefault();
break
}}}$("#val_cel_"+CVSVTable.focusChiffre).focus();
Vocalisation.stopVocalise();
Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre));
d.preventDefault();
break;
case f.up:if(CVSVTable.focusChiffre==null){CVSVTable.focusChiffre=0
}else{if(CVSVTable.focusChiffre>3){CVSVTable.focusChiffre=parseInt(CVSVTable.focusChiffre)-4
}else{CVSVTable.focusChiffre=NB_CASES-4+parseInt(CVSVTable.focusChiffre)
}}$("#val_cel_"+CVSVTable.focusChiffre).focus();
Vocalisation.stopVocalise();
Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre));
d.preventDefault();
break;
case f.down:if(CVSVTable.focusChiffre==null){CVSVTable.focusChiffre=0
}else{if(CVSVTable.focusChiffre<(NB_CASES-4)){CVSVTable.focusChiffre=parseInt(CVSVTable.focusChiffre)+4
}else{CVSVTable.focusChiffre=parseInt(CVSVTable.focusChiffre)+(4-NB_CASES)
}}$("#val_cel_"+CVSVTable.focusChiffre).focus();
Vocalisation.stopVocalise();
Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre));
d.preventDefault();
break;
d.preventDefault();
break
}},cliquer:function(a){var c=a.target||a.srcElement;
if(!(c.id)||c.id==""){c=c.parentElement
}CVSVTable.focusChiffre=CVSVTable.getindex(c);
CVSVTable.valide()
},mouseover:function(a){var c=a.target||a.srcElement;
if(!(c.id)||c.id==""){c=c.parentElement
}c.focus();
Vocalisation.stopVocalise();
Vocalisation.startVocalise(c)
},toucher:function(c){var d=c.target||c.srcElement;
if(!(d.id)||d.id==""){d=d.parentElement
}var a=CVSVTable.getindex(d);
if(Vocalisation.active){if(CVSVTable.focusChiffre==null||CVSVTable.focusChiffre!=a){CVSVTable.focusChiffre=CVSVTable.getindex(d);
Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre))
}else{CVSVTable.focusChiffre=CVSVTable.getindex(d);
CVSVTable.valide()
}}else{CVSVTable.focusChiffre=CVSVTable.getindex(d);
CVSVTable.valide()
}},getindex:function(a){id=a.id;
sid=new String(id);
return sid.substr(8)
},focus:function(a){var c=a.target||a.srcElement;
if(!(c.id)||c.id==""){c=c.parentElement
}CVSVTable.focusChiffre=CVSVTable.getindex(c);
if(!CVSVTable.mover){Vocalisation.stopVocalise();
Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre))
}},valide:function(){if(!CVSVTable.focusChiffre||this.nb>=this.nbmax){return
}this.nb++;
var d=document.getElementById("cvs-bloc-mdp-input");
if(d.value.length<6){d.value=d.value+"*"
}var e=$("#cs");
if(CVSVTable.focusChiffre<10){e.val(e.val()+"0"+CVSVTable.focusChiffre+"")
}else{e.val(e.val()+CVSVTable.focusChiffre+"")
}Vocalisation.startClick();
valid_ident();
if(Vocalisation.active&&Vocalisation.mp3Ogg){Vocalisation.audios.addEventListener("ended",function c(){Vocalisation.startVocalise(document.getElementById("val_cel_"+CVSVTable.focusChiffre));
Vocalisation.audios.removeEventListener("ended",c)
})
}},reset:function(){var a=document.getElementById("cvs-bloc-mdp-input");
a.value="";
this.nb=0;
CVSVTable.focusChiffre=null;
$("#cs").val("");
deactivateValid();
if(document.getElementById("cvs-bloc-mdp-input-hidden")!=undefined){document.getElementById("cvs-bloc-mdp-input-hidden").className="";
document.getElementById("cvs-bloc-mdp-input").className="cache"
}},activate:function(){CVSVTable.boutons()
},desactivate:function(){var a=$("#imageclavier input, #imageclavier a, #imageclavier button");
a.off("click");
$(document).off("keydown")
},lancer:function(){if(isIOS()){if(Vocalisation.canPlayOgg||Vocalisation.canPlayMp3&&Vocalisation.DUREE_SONS==0&&!Vocalisation.initialisationOk){try{initVocalisation()
}catch(a){console.log("erreur Lancer : "+a)
}}else{activerVocalisation()
}}else{chargerFichierAudio()
}}};
function initVocalisation(){if(Vocalisation.mp3Ogg){var a=$("#progressBar").append("<p class='webaccess' id='progressMsg' role='alert' aria-live='assertive'>Veuillez patienter le fichier audio est en cours de telechargement</p>");
$("#cvs-lien-voca-active").val("Attente chargement fichier audio");
$("#cvs-lien-voca-active").attr("disabled","disabled")
}Vocalisation.audios.load();
Vocalisation.audios.muted=true;
Vocalisation.audios.play();
Vocalisation.initialisationOk=true
}function ajouterCookieVocalisation(){if(!is_touch_device()){var a=new Date;
a.setTime(a.getTime()+31536000000);
Cookie.creer("VOCAL",Vocalisation.active?"true":"false",a,"https://voscomptes.labanquepostale.mobi/",document.domain)
}}function activerVocalisation(){Vocalisation.active=true;
$("#cvs-lien-voca-active").attr("class","cache");
$("#cvs-lien-voca-desactive").attr("class","non-cache");
ajouterCookieVocalisation()
}function desactiverVocalisation(){Vocalisation.active=false;
$("#cvs-lien-voca-active").attr("class","non-cache");
$("#cvs-lien-voca-desactive").attr("class","cache");
$("#progressMsg").remove();
ajouterCookieVocalisation()
}function chargerFichierAudio(){if(!this.charge){Vocalisation.charger()
}activerVocalisation()
}function isIOS(){return((navigator.userAgent.toLowerCase().indexOf("ipad")>-1)||(navigator.userAgent.toLowerCase().indexOf("iphone")>-1)||(navigator.userAgent.toLowerCase().indexOf("ipod")>-1))
}function isNoIOS(){return navigator.userAgent.match(/(android|blackberry|symbian|symbianos|symbos|netfront|model-orange|javaplatform|iemobile|windows phone|samsung|htc|opera mobile|opera mobi|opera mini|presto|huawei|blazer|bolt|doris|fennec|gobrowser|iris|maemo browser|mib|cldc|minimo|semc-browser|skyfire|teashark|teleca|uzard|uzardweb|meego|nokia|bb10|playbook)/gi)
}function activateValid(){$("#valider").off();
$("#valider").removeAttr("disabled");
$("#valider").toggleClass("grey",false)
}function deactivateValid(){$("#valider").off();
$("#valider").attr("disabled","disabled");
$("#valider").toggleClass("grey",true)
}var vocalisationCookie=Cookie.lire("VOCAL");
function updateVocalIOS(){Vocalisation.charger()
}function updateVocal(){if(Vocalisation.estVocalisable()){$("#audio_box").remove();
if(vocalisationCookie=="true"){Vocalisation.charger();
Vocalisation.active=true;
$("#cvs-lien-voca-active").attr("class","cache");
$("#cvs-lien-voca-desactive").attr("class","non-cache")
}else{Vocalisation.active=false;
$("#cvs-lien-voca-active").attr("class","non-cache");
$("#cvs-lien-voca-desactive").attr("class","cache")
}}}var _envoi="false";
function checkInput(d){var c;
var a;
var f;
if(window.event){c=window.event;
a=window.event.keyCode
}else{if(d){c=d;
a=c.which
}else{return true
}}if(a>96&&a<123){return true
}else{if(a>64&&a<91){return true
}else{if(a>47&&a<58){return true
}else{if(a==8||a<32){return true
}else{return false
}}}}}function readCookieBkalias(){var f=true;
if(document.cookie!=""){var e="bkalias=";
var a=document.cookie.split(";");
for(var d=0;
d<a.length;
d++){var g=a[d];
while(g.charAt(0)==" "){g=g.substring(1,g.length)
}if(g.indexOf(e)==0){f=true
}else{f=false
}}}return f
}function IsSafari(){var a=navigator.userAgent.toLowerCase();
if(a.indexOf("safari")!=-1){if(a.indexOf("chrome")>-1){return false
}else{return true
}}else{return false
}}function isChrome(){return navigator.userAgent.toLowerCase().indexOf("chrome")>-1
}function isFirefox(){return typeof InstallTrigger!=="undefined"
};