 Number.prototype.formato = function (moneda) {
	var n = this, 
	    c = 2, d = ",", t = '.', 
	    s = n < 0 ? "-" : "", 
	    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "")  + ' ' + moneda;
 }
 Number.prototype.z = function(n){
	return ('000' + this).slice(-(n || 2));
 }
 /* Prototipos de Date */
 Date.prototype.gDia = function() { // Día
 	return this.getDate().z();
 }
 Date.prototype.gMes = function() { // Mes en letra
	var m = ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
 	return m[this.getMonth()];
 }
 Date.prototype.gAno = function() { // Año
 	return this.getFullYear();
 }
 Date.prototype.gHora = function() { // Hora
 	return this.getHours().z();
 }
 Date.prototype.gMinu = function() { // Minutos
 	return this.getMinutes().z();
 }
 Date.prototype.gSegu = function() { // Segundos
 	return this.getSeconds().z();
 }
/*
  ----------------------------
  vf() - función ver fecha
	Dada una string con formato 'aaaa/mm/dd hh:mm:ss'
	devuelve string con 'dd/mes/aaaa a las hh:mm:ss'
  ----------------------------
 */
String.prototype.vf = function(){
	var f = new Date(this.toString());
	return f.gDia() + '-' + f.gMes() + '-' + f.gAno();
};
String.prototype.fv = function(){
	var f = new Date(this.toString());
	return f.gDia() + '-' + f.gMes() + '-' + f.gAno();	
};

String.prototype.hoy = function(){
	return (new Date()).toString().vf();
};	
