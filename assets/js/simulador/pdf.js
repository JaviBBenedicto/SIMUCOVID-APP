function download(element){
	var doc = new jsPDF();

	var n ;

	var num = element.length;

	var inf = 0;

	//var imgData = ;
	//doc.addImage(imgData, 'JPEG', 10, 40, 180, 180);
	doc.setFontSize(10);
	doc.text("Resultados experimentales",10,10);
	
	for(let i = 0; i< element.length; i++){
		doc.setFontSize(5);

		n = (i+1) * 10;
		n = (n/2)+15;
		var np = i+1;
		var edat = (element[i].age).toString();
		var carga = (element[i].ca).toString();
		var est = element[i].estado;
		var estado;
		var g = 255;
		var b = 255;
		if (est == 1) {
			estado = "CONTAGIADO";
			inf = inf +1;
			g = 0;
			b = 0;
		}else{
			estado = "NO CONTAGIADO";
		}
		var time = element[i].tim;
		var text = "Persona: "+np+" de edad "+edat+" años, ha recivido una carga de: "+carga+"   Su estado es: "+estado+" En un tiempo de: "+time;
		doc.setTextColor(255,g,b);
		doc.text(text,10,n);
	}
	var porcent = percent(num,inf);
	doc.setFontSize(8);
	doc.setTextColor(0,0,0);
	var text2 = "Tras finalizar el experimento el "+porcent+"% de los sujetos se han contagiado.";
	doc.text(text2,10,n+10);

	var d = dat();
	doc.setFontSize(5);
	doc.text(d,10,n+20);





	doc.save("prueba.pdf")

}

//Obtener porcentaje
function percent(num,inf){

	var res = (inf * 100)/num;

	res = res.toString();

	return res;
	
}

//Obtener fecha 
function dat(){
	var dat = new Date();
	dat.toUTCString();
	dat = dat.toString();
	return dat;
}
