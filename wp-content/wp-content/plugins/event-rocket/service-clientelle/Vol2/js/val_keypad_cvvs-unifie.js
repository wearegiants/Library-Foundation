var _domain=".labanquepostale.fr";
if(location.href.indexOf(".laposte.fr")>0){_domain=".laposte.fr"
}$(document).ready(function(){if(document.getElementById("messagePrecaution")!=undefined){document.getElementById("messagePrecaution").innerHTML="Authentification par vocalisation. Attention aux oreilles indiscr\350tes. Conseil : connectez-vous dans un endroit s\373r ou utilisez un casque audio."
}if(document.getElementById("day")!=undefined){construireSelectsDate()
}if(document.getElementById("messageDebutClavier")!=undefined){document.getElementById("messageDebutClavier").innerHTML="Mode op\351ratoire : Le clavier virtuel vocalis\351 marche sur les ordinateurs fixes et portables, ainsi que sur les m\351dias tactiles APPLE. Pour acc\351der au mode op\351ratoire sp\351cifique d\351taill\351, aller sur labanquepostale.fr et cliquer sur le lien \253Accessibilit\351\273"
}if(document.getElementById("messageDebutClavier2")!=undefined){document.getElementById("messageDebutClavier2").innerHTML="Navigation : pour vocaliser chaque case, utiliser TAB et SHIFT+TAB ou ALT+fl\350che gauche et droite sur PC; sur MAC fl\350che gauche et droite, TAB et SHIFT+TAB ou touche VO+fl\350che gauche et droite. Sur les m\351dias tactiles APPLE, utiliser les gestes VOICEOVER. Pour s\351lectionner et valider des chiffres, utiliser barre espace ou entr\351e sur PC ou MAC, et le geste double tappe sur les m\351dias tactiles APPLE ce qui produit un son de confirmation. Le bouton Effacer efface les chiffres saisis. La validation du formulaire devient possible lorsque l\264identifiant et tous les chiffres du mot de passe sont saisis."
}if(isNoIOS()){$("#cvs-lien-voca").attr("class","cache");
$("#messageDebutClavier").attr("aria-hidden","true");
$("#messageDebutClavier2").attr("aria-hidden","true");
$("#cvs_swf").hide();
$("#audio_box").hide()
}else{if(isIOS()){$("#cvs_swf").hide();
updateVocalIOS()
}else{updateVocal()
}}if(isMediaTablette()){$("#cvs_swf").hide();
$("head").append($(document.createElement("link")).attr({rel:"stylesheet",type:"text/css",href:PATH_STATIQUE+"/css/cvs_tablette.css"}));
$("#imageclavier").css({background:"url("+IMG_ALL+") no-repeat 13px 6px"})
}var c=$("#val_cel_identifiant");
if(c.length>0){var e;
if(isMediaTablette()){if(document.getElementById("saveId")!=undefined){$("#saveId").hide();
$("#saveId").next("label").remove()
}if(document.getElementById("val_cel_identifiant")!=undefined){window.addEventListener("message",function(g){console.log("origin message : "+g.origin+" message recu : "+g.data);
if(g.data!==""){e=g.data;
$("#val_cel_identifiant").val(e);
$("#val_cel_identifiant").hide();
$("#val_cel_identifiant_masque").val("********"+e.substring(8,10));
$("#val_cel_identifiant_masque").show()
}})
}}else{if(window.localStorage){e=localStorage.CVS_DONNEE_MEMO
}else{e=Cookie.lire("CVS_DONNEE_MEMO")
}}if(e&&e.length>9&&!isNaN(e)){$("#val_cel_identifiant").val(e);
var a=document.getElementById("saveId");
if(a){a.checked=true
}$("#val_cel_identifiant").hide();
$("#val_cel_identifiant_masque").val("********"+e.substring(8,10))
}else{$("#val_cel_identifiant").val("");
$("#val_cel_identifiant").show();
if(document.getElementById("val_cel_identifiant_masque")!=undefined){$("#val_cel_identifiant_masque").hide()
}}}if(document.getElementById("cvs-bloc-mdp-input-hidden")!=undefined){if(document.getElementById("val_cel_identifiant_hidden")!=undefined){document.getElementById("val_cel_identifiant_hidden").className="input-non-modif";
document.getElementById("val_cel_identifiant").className="webaccess"
}document.getElementById("cvs-bloc-mdp-input-hidden").className="";
document.getElementById("cvs-bloc-mdp-input").className="cache";
var b=document.getElementById("cvs-bloc-mdp-input");
var f=document.getElementsByTagName("button");
for(var d=0;
d<f.length;
d++){f[d].onclick=function(){editMdp()
}
}}CVSVTable.activate();
c.bind("keyup",valid_ident);
c.bind("change",valid_ident);
valid_ident();
$("#cs").val("")
});
function modifIdent(){var a=document.getElementById("saveId");
if(a.checked===false){if(document.getElementById("val_cel_identifiant_masque")!=undefined){$("#val_cel_identifiant_masque").hide()
}$("#val_cel_identifiant").val("");
$("#val_cel_identifiant").show();
effacerIdMemorise();
if(document.getElementById("cvs-bloc-mdp-input-hidden")!=undefined){if(document.getElementById("val_cel_identifiant_hidden")!=undefined){document.getElementById("val_cel_identifiant_hidden").className="input-non-modif";
document.getElementById("val_cel_identifiant").className="webaccess"
}document.getElementById("cvs-bloc-mdp-input-hidden").className="";
document.getElementById("cvs-bloc-mdp-input").className="cache"
}}valid_ident()
}function effacerIdMemorise(){if(window.localStorage){localStorage.removeItem("CVS_DONNEE_MEMO")
}else{var a=new Date();
a.setTime(a.getTime()-1);
Cookie.creer("CVS_DONNEE_MEMO","",a,"https://voscomptes.labanquepostale.mobi/",document.domain)
}}function valid_ident(){if(isIdentOk()){activateValid()
}else{deactivateValid()
}}function isIdentOk(){var e=true;
var b=true;
var f=$("#val_daten");
if(f.length>0){var c=new RegExp("[ajm]");
if(f.val().match(c)!=null){b=false
}}var a=$("#val_cel_identifiant");
if(a.length>0){var d=a.val();
if(!(d.length==10||d.length==11)){e=false
}}return(e&&b&&CVSVTable.nb==CVSVTable.nbmax)
}function sendForm(){var a=document.getElementById("saveId");
if(a&&a.checked){var b=new Date();
b.setTime(b.getTime()+5184000000);
if(window.localStorage){localStorage.CVS_DONNEE_MEMO=$("#val_cel_identifiant").val()
}else{Cookie.creer("CVS_DONNEE_MEMO",$("#val_cel_identifiant").val(),b,"https://voscomptes.labanquepostale.mobi/",document.domain)
}}else{effacerIdMemorise()
}if(_envoi=="false"&&isIdentOk()){_envoi="true";
window.document.forms.formAccesCompte.submit();
return true
}else{return false
}}function isMediaTablette(){currentPageUrlIs=document.location.toString();
var f=false;
var b="";
var e=location.search.substring(1).split("&");
for(var d=0;
d<e.length;
d++){var a=e[d].split("=");
if(a[0]==="URL"){b=a[1]
}else{if(a[0]==="codeMedia"){if(a[1]==="9250"||a[1]==="9251"){f=true
}}}}if(b!=""){b=unescape(b);
e=b.split("&");
for(var c=0;
c<e.length;
c++){var g=e[c].split("=");
if(g[1]==="9250"||g[1]==="9251"){f=true
}}}return f
}function modif_date(){var c=document.getElementById("day").options[document.getElementById("day").options.selectedIndex].text;
var b=document.getElementById("month").options[document.getElementById("month").selectedIndex].text;
var a=document.getElementById("year").options[document.getElementById("year").options.selectedIndex].text;
$("#val_daten").val(""+a+b+c+"");
valid_ident()
}function construireSelectsDate(){var a=new Date().getFullYear()-12;
construireSelect("day",1,31,0);
construireSelect("month",1,12,0);
construireSelect("year",1900,a,1)
}function construireSelect(g,e,a,f){select=document.getElementById(g);
var d=null;
if(f==0){for(var c=e;
c<=a;
c++){d=document.createElement("option");
d.value=c;
if(c<10){d.text="0"+c
}else{d.text=c
}select.add(d)
}}else{for(var b=a;
b>=e;
b--){d=document.createElement("option");
d.value=b;
if(b<10){d.text="0"+b
}else{d.text=b
}select.add(d)
}}}window.document.forms.formAccesCompte.onsubmit=sendForm;