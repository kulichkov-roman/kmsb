function LoadScript( url ){
 document.write( '<script type="text/javascript" src="' + url + '" onerror="alert(\'Error loading js \' + this.src);"><\/script>' ) ;
}

function LoadCss( url ){
 document.write( '<link href="' + url + '" type="text/css" rel="stylesheet" onerror="alert(\'Error loading css \' + this.href);" />' ) ;
}

function SetValue(Key, Value, Type) {
  var Request = null;
  if( window.XMLHttpRequest )
    Request = new XMLHttpRequest();
  else if( window.ActiveXObject )
    Request = new ActiveXObject('MsXml2.XmlHttp');
  if( Request ) {
    Request.open('get', '/setvalue.html?Type='+Type+'&Key='+Key+'&Value='+Value+'&Active='+Math.random(), true);
    Request.send(null);
  }
}

String.prototype.trim = function( charlist ) {	// Strip whitespace (or other characters) from the beginning and end of a string
	// 
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: mdsjack (http://www.mdsjack.bo.it)
	// +   improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
	// +	  input by: Erkekjetter
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

	charlist = !charlist ? ' \s\xA0' : charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
	var re = new RegExp('^[' + charlist + ']+|[' + charlist + ']+$', 'g');
	return this.replace(re, '');
}

function OpenPhoto( HRef, width, height ) {

 win = window.open(HRef,'_blank','statusbar=0,toolbar=0,location=0,scrollbars=1,resizable=0,width='+width+',height='+height);
 //win.document.body.style.margin = "0";
 //win.document.body.style.padding = "0";
}

//функция форматирования числа, по разрядам и с заданной точностью
function number_format(number, decimal, dec_point, th_sep){

	number = Math.round(number * Math.pow(10, decimal)) / Math.pow(10, decimal);
	str_number = number + '';
	arr_int = str_number.split('.');

	if(!arr_int[0]) arr_int[0] = '0';
	if(!arr_int[1]) arr_int[1] = '';
	if(arr_int[1].length < decimal){
		nachkomma = arr_int[1];

		for(i = arr_int[1].length + 1; i <= decimal; i++){
			nachkomma += '0';
		}
	  arr_int[1] = nachkomma;
	}

	if(th_sep != '' && arr_int[0].length > 3){

		Begriff = arr_int[0];
		arr_int[0] = '';

		for(j = 3; j < Begriff.length ; j += 3){

			Extrakt = Begriff.slice(Begriff.length - j, Begriff.length - j + 3);
			arr_int[0] = th_sep + Extrakt +  arr_int[0] + '';
	  }

		str_first = Begriff.substr(0, (Begriff.length % 3 == 0) ? 3 : (Begriff.length % 3));
	  arr_int[0] = str_first + arr_int[0];
	}

	return arr_int[0] + dec_point + arr_int[1];
}

// Функция формирования окончания на основании колличества и слова
function ending(Numeric, gender) {
  
  if(typeof gender == "undefined")
    gender = "f";
  
  return GetStringEndingNumeric(Numeric, gender);
}

function GetStringEndingNumeric(Numeric, gender){
  
  if(typeof gender == "undefined")
    gender = "f";
    
  Numeric = parseInt(Numeric);
  
  if( typeof gender == "string" ){
    var Ending = {
      "k": {
        0: "а",
        1: "ы",
        2: ""
      },
      "m": {
        0: "ь",
        1: "я",
        2: "ей"
      },
      "f": {
        0: "ь",
        1: "и",
        2: "ей"
      },
      "a": {
        0: "е",
        1: "я",
        2: "й"
      },
      "b": {
        0: "",
        1: "а",
        2: "ов"
      },
      "g": {
        0: "",
        1: "о",
        2: "о"
      },
      "x": {
        0: "ий",
        1: "ия",
        2: "ев"
      },
      "n": {
        0: "ая",
        1: "ые",
        2: "ых"
      },
      "d": {
        0: "а",
        1: "ки",
        2: "ок"
      },
      "day": {
        0: "день",
        1: "дня",
        2: "дней"
      },
      "month": {
        0: "месяц",
        1: "месяца",
        2: "месяцев"
      }
    };
    
    Ending = Ending[ gender ];
  }
  else{
    Ending = gender;
  }
  
  // для окончания числовых выражений
  // мужской (н.п. рубл[ь|я|ей]) | женский (н.п. запчаст[ь|и|ей]) род
  // и средний (н.п. объявлени[й|е|я])
  var str = "";
  switch(Numeric) {
   case 11:
   case 12:
   case 13:
   case 14: str = Ending[2]; break;
  }

  if(!str) {
    var LastTen = Numeric % 10;
    switch(LastTen) {
      case  1: str = Ending[0]; break;
      case  2:
      case  3:
      case  4: str = Ending[1]; break;
      case  5:
      case  6:
      case  7:
      case  8:
      case  9:
      case  0: str = Ending[2]; break;
    }
  }
  
  return str;
}

// считает кол-во переменных Объекта
// глючит - надо разобраться
function SetCount(oObj) {

  oObj.Count = 0;

  for(var i in oObj ) {

    if( typeof oObj[i] == "function" )
      continue;

    oObj.Count++;
  }
}

function array_keys(aSource) {

  var aTarget = new Array();

  for( var i in aSource )
    aTarget.push(i);
                
  return aTarget;
}

function print_r(Obj, Level) {

  var Text = "";
  
  if( typeof Level == "undefined" )
    Level = 0;

  if( typeof Obj == "number" )
    Text += Obj;
    
  else if( typeof Obj == "string" )
    Text += "\"" + Obj + "\"";
    
  else if( typeof Obj == "boolean" )
    Text += Obj ? "true" : "false";
    
  else if( typeof Obj == "array"
           || typeof Obj == "object" ) {
           
    Text += "{\n";
    
    for(var i = 0; i < Level; i++)
      Text += "  ";
    
    var n = 0;
    
    for(var Key in Obj) {
    
      if( n )
        Text += ",\n";
        
      for(var i = 0; i < Level; i++)
        Text += "  ";
      
      Text += Key + ":" + print_r(Obj[Key], Level + 1);
      n++;
    }
    
    Text += "\n";

    for(var i = 0; i < Level - 1; i++)
      Text += "  ";
    
    Text += "}";
  }  
  else
   Text += typeof Obj; 
  
  if( !Level )
    alert(Text);
  else  
    return Text;
}

function Add2Favor(url, title) {

  /*if( navigator.appName == "Microsoft Internet Explorer"
      && parseFloat(navigator.appVersion) >= 4.0 )
    window.external.AddFavorite(location.href, document.title);
  else
    window.alert("Ваш браузер не поддерживает данную функцию. Нажмите Ctrl+D, чтобы добавить в Favorites.");*/
    
//   if(!url)
//     url = location.href;
//   
//   if(!title)
//     title = document.title;
//   
//   //Gecko
//   if ((typeof window.sidebar == "object") && (typeof window.sidebar.addPanel == "function"))
//      window.sidebar.addPanel(title, url, "");
//   //IE4+
//   else if (typeof window.external == "object")
//     window.external.AddFavorite(url, title);
//   //Opera7+
//   else if (window.opera && document.createElement){
//     var a = document.createElement('A');
//     
//     if(!a)
//       return false; //IF Opera 6
//       
//     a.setAttribute('rel','sidebar');
//     a.setAttribute('href',url);
//     a.setAttribute('title',title);
//     a.click();
//   }
//   else
//     return false;
//     
//   return true;

// Добавить в Избранное 

  try { 
    // Internet Explorer 
    window.external.AddFavorite(url, title); 
  } 
  catch (e) { 
    try { 
      // Mozilla 
      window.sidebar.addPanel(title, url, ""); 
    } 
    catch (e) { 
      // Opera 
      if (typeof(opera)=="object") { 
        a.rel="sidebar"; 
        a.title=title; 
        a.url=url; 
        return true; 
      } 
      else { 
        // Unknown 
        alert('Нажмите Ctrl-D чтобы добавить страницу в закладки'); 
      } 
    } 
  } 
  return false; 
}

function SetAsStartPage(HomePage){
  
  if(Object.isUndefined(HomePage))
    HomePage = location.href;
  
  // IE
  if(document.all&&!window.opera){
    
    var a = document.createElement('A');
    
    a.style.behavior = 'url(#default#homepage)';
    a.setHomePage(HomePage);
    return true;
  }
  else{
    // FF
    if(window.netscape&&window.netscape.security){
      netscape.security.PrivilegeManager.enablePrivilege('UniversalPreferencesRead');
      if(navigator.preference('browser.startup.homepage')!=HomePage){
        netscape.security.PrivilegeManager.enablePrivilege('UniversalPreferencesWrite');
        navigator.preference('browser.startup.homepage',HomePage);
        return true;
      }
    }
  }
  
  alert("Данная функция не поддерживается Вашим браузером!");
  return false;
}

function OpenPhoto( HRef, width, height ) {

 win = window.open(HRef,'_blank','statusbar=0,toolbar=0,location=0,scrollbars=0,resizable=0,width='+width+',height='+height);
 //win.document.body.style.margin = "0";
 //win.document.body.style.padding = "0";
}

function ShowSorry() {

 window.alert("Извините, но пока этот раздел не доступен...");
 return false;

}

var aMonths = new Array( 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь')
var aMonthsG = new Array( 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря')
var aDays = new Array('вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб');

function FormatDate(dDate, sFormat) {

  if( !dDate )
    return "";
    
  var Str = "";
  
  if( sFormat == "dd.mm" )
    Str = FormatNumber(dDate.getDate()) + "." + FormatNumber((dDate.getMonth()+1));
  else if( sFormat == "ddd, d mmm" )
    Str = aDays[dDate.getDay()] + ", " + dDate.getDate() + " " + aMonths[dDate.getMonth()].substr(0, 3).toLowerCase();
  else if( sFormat == "ddmmyyyy" )
    Str = FormatNumber(dDate.getDate()) + FormatNumber((dDate.getMonth()+1)) + FormatNumber(dDate.getFullYear());
  else if( sFormat == "yyyy-mm-dd" )
    Str = FormatNumber(dDate.getFullYear()) + "-" + FormatNumber((dDate.getMonth()+1)) + "-" + FormatNumber(dDate.getDate());
  else  
    Str = FormatNumber(dDate.getDate()) + "." + FormatNumber((dDate.getMonth()+1)) + "." + FormatNumber(dDate.getFullYear());

  return Str;
}

function FormatNumber(sNum) {

  re = /^(\d{0,1})(\d{1})$/
  aResult = re.exec(sNum)

  if( aResult
      && !aResult[1] )
    return "0" + parseInt(aResult[2]);

  return sNum;
}

function ChangeDateSelect(sName, iISO) {

  var oHidden = ElementByID(sName);
  var oDay = ElementByID(sName + "Day");
  var oMonth = ElementByID(sName + "Month");
  var oYear = ElementByID(sName + "Year");

  var dDate = new Date(oYear.value, oMonth.value-1, oDay.value);
  
  if( dDate.getDate() == parseInt(oDay.value*1)
      && dDate.getMonth()+1 == parseInt(oMonth.value*1)
      && dDate.getFullYear() == parseInt(oYear.value*1) ) {
      
    oHidden.value = FormatDate(dDate, (iISO)?"yyyy-mm-dd":"");

    //if( oHidden.onchange )
    //  SetValue(oHidden.name, oHidden.value, "string");
    
    window.status = "";
  }
  else {
    oHidden.value = "";
    window.status = "Внимание: выбрана неверная дата!";
    return;
  }

}

function ElementByID(ID) {

  return document.all ? document.all[ID] : document.getElementById(ID);
}

var galleryOptions = {};

function PrepareGallery(Mode){

//   if(hs == "undefined")
//     return;

	hs.graphicsDir = '/js/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.fadeInOut = true;
	hs.numberOfImagesToPreload = 0;
	//hs.dimmingOpacity = 0.75;


  if(Mode && typeof Mode != 'undefined'
     && Mode == "text"){
    
    return;   
  }
  
	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .75,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
}

function AddGallery(Id){

  if(!Id)
    return;
  
  // Создаем группу настроек для новой галереи-группы.  
  galleryOptions[Id] = {
  	slideshowGroup: 'gallery'+Id,
  	align: 'center',
  	transitions: ['expand', 'crossfade']
  };
  
  // Регистрируем новую группу как галерею
  if (hs.addSlideshow) hs.addSlideshow({
      slideshowGroup: 'gallery'+Id,
      interval: 5000,
      repeat: false,
      useControls: true,
  	  fixedControls: 'fit',
      overlayOptions: {
          opacity: .6,
          position: 'bottom center',
          hideOnMouseOut: true
  	}
  });
}

// Функция аккордеона
var slideMenu=function() {
  var sp,st,t,m,sa,l,w,sw,ot;
  return {
    build:function(sm,sw,mt,s,sl,h) {
      sp=s;
      st=sw;
      t=mt;

      m=document.getElementById(sm);
      sa=m.getElementsByTagName('li');

      l=sa.length;
      w=m.offsetWidth;
      sw=w/l;

      ot=Math.floor((w-st)/(l-1)); var i=0;

      for(i;i<l;i++) {
        s=sa[i]; s.style.width=sw+'px'; this.timer(s)
      }

      if(sl!=null) {
        m.timer=setInterval(function() {
          slideMenu.slide(sa[sl-1])
        },t)
      }
    },

    timer:function(s) {
      s.onmouseover=function() {
        clearInterval(m.timer);

        m.timer=setInterval(function(){
          slideMenu.slide(s)
        },t)
      }
    },

    slide:function(s){
      var cw=parseInt(s.style.width,'10');
      if(cw<st) {
        var owt=0; var i=0;
        for(i;i<l;i++){
          if(sa[i]!=s){
            var o,ow; var oi=0; o=sa[i]; ow=parseInt(o.style.width,'10');
            if(ow>ot) {
              oi=Math.floor((ow-ot)/sp); oi=(oi>0)?oi:1; o.style.width=(ow-oi)+'px'
            }
            owt=owt+(ow-oi)
          }
        }
        s.style.width=(w-owt)+'px';
      }

      else {
        clearInterval(m.timer)
      }
    }
  };
}();
