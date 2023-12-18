!function(e){
	"use strict";
	var t=function(){};
	t.prototype.createStackedChart=function(e,t,a,i,o,r){
		
	},
	e(".peity-pie").each(function(){
		e(this).peity("pie",e(this).data())
	}),
	e(".peity-donut").each(function(){
		e(this).peity("donut",e(this).data())
	}),
	e(".peity-line").each(function(){
		e(this).peity("line",e(this).data())
	}),
	t.prototype.init=function(){
		this.createStackedChart("morris-bar-stacked",
			[{y:"2008",a:45,b:180,c:100},{y:"2009",a:75,b:65,c:80},
			{y:"2010",a:100,b:90,c:56},{y:"2011",a:75,b:65,c:89},
			{y:"2012",a:100,b:90,c:120},{y:"2013",a:75,b:65,c:110},
			{y:"2014",a:50,b:40,c:85},{y:"2015",a:75,b:65,c:52},
			{y:"2016",a:50,b:40,c:77},{y:"2017",a:75,b:65,c:90},
			{y:"2018",a:100,b:90,c:130}],"y",["a","b","c"],
			["Desktops","Tablets","Mobiles"],["#1699dd","#e2595f","#ebeff2"]
		);
	},
	e.Dashboard=new t,e.Dashboard.Constructor=t
}
(window.jQuery),
function(e){"use strict";window.jQuery.Dashboard.init()}();