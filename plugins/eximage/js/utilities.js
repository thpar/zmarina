/*
* @author     Chanaka Mannapperuma <irusri@gmail.com>
* @date       2014-02-06
* @version    Beta 1.0
* @usage      Expression view new version
* @licence    GNU GENERAL PUBLIC LICENSE
* @link       http://irusri.com
*/

// Round decimal numbers
function roundNumber(num, noPlaces) {
    return Math.round(num * Math.pow(10, noPlaces)) / Math.pow(10, noPlaces);
}

//Get Hex color from RGB
function rgbToHex(r, g, b) {
    //if(r < 0 || r > 255) alert("r is out of bounds; "+r);
    //if(g < 0 || g > 255) alert("g is out of bounds; "+g);
    //if(b < 0 || b > 255) alert("b is out of bounds; "+b);
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1,7);
}

//Assign min/max value for given input
function clamp(input, minn, maxn){
	if (input > maxn) {
		return parseFloat(maxn)
	}
	if (input < minn) {
		return parseFloat(minn)
	}
	return parseFloat(input)
}

//SVG convertion and download into different formats
function submit_download_form(output_format)
{
	var tmp = chanaka.select(document.getElementById("viz")).node();
	var svg = document.getElementsByTagName("svg")[0];

	// Extract the data as SVG text string
	var svg_xml = (new XMLSerializer).serializeToString(svg);

	// Submit the <FORM> to the server.
	// The result will be an attachment file to download.
	var form = document.getElementById("svgform");
	form['output_format'].value = output_format;
	form['data'].value = svg_xml ;
	form.submit();
}

//getcookie with name
function getCookie(c_name) {
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name){
			return unescape(y);
		}
	}
}
//Set cookie with name value and exp days
function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
