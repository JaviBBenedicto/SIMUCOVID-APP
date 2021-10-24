

//Array donde se guardan las bolas 
let bolas = [];

//Numero de bolas
var numero = 0;

//Estado simulacion

var simulacion = true;

//variables de las bolas 
let xdirection = 1; 
let ydirection = 1;
let rad = 60;

//indice contagio
let indiceContagio = 0;

// dimension caja
let cajax = 900;
let cajay = 500;

//CRONO------
//variables cronometre
var count = 0;
var time = '00:00:00';
//variables crono h / m / s
var second = 0;
var minute = 0;
var hour = 0;
var clear;

//GRAFICA
let numerocont = 0;
let arraytimes = [];
let onetime = true;

function setup() {
}
//****************************************************
//--------FUNCION DE EJECUCION PROGRAMA ------------
function draw() {
	if (simulacion) {
		if(cajay > 0) {
			//create canvas 
			var myCanvas = createCanvas(cajax,cajay);
			myCanvas.parent("experimental");
		
			background(79,79,84);
			for (let u = 0; u < bolas.length; u++){
	  			bolas[u].move();
	  			bolas[u].show();
	  			contacto();
	  			estado();
	  		}
		}
	}else{
		stop();
		if(onetime){
			//ejecuta grafica
			graficar(arraytimes);
			onetime = false;
		}

		

	}
}
//Obtener tamaño caja
function caja (){
	cajax =document.getElementById('cx').value;
	cajay =document.getElementById('cy').value;

}
//****************************************************
//Funcion crear divs para las bolas (formulario)
function creadiv(n){
	var divinicial = document.getElementById('divs');
	var divsecond = document.createElement("div");
	divsecond.setAttribute("id","divsecond");
	divinicial.appendChild(divsecond);
	for(let i = 0; i < n; i++){
		var div = document.createElement("div");
		var id = String("movi"+i);
		div.setAttribute("id",id);
		divsecond.appendChild(div);
	}
	divinicial.appendChild(divsecond);
}
//******AUTOMATICO*************
//Creacion bolas AUTO
function numBolas(){
	bolas = [];
	reStart();
	numero =document.getElementById('numero').value;
	indiceContagio = document.getElementById('carga').value;
	//creacion divs 
	creadiv(numero);
	//creo las bolas 
	for(let y = 0; y < numero ; y++){
		let p1 = (Math.random()>=0.5)? 1 : -1;
		let p2 = (Math.random()>=0.5)? 1 : -1;
		//carga de 0 a 100
		let car = Math.floor(Math.random() * 100) + 0;
		//edat de 1 a 99 
		let age = Math.floor(Math.random() * 99) + 1;
		//posició X
		let posx = Math.floor(Math.random() * (cajax - 60)) + 70;
		//posició Y
		let posy = Math.floor(Math.random() * (cajay -60)) + 70;

		// posicion x , posicion y , direccion x , direccion y
		//añado al array
		bolas[y] = new Bola(y,posx,posy,p1,p2,car,age);
  }
  //----- Cronometro -------
  start();
  //btn panic (display)
  document.getElementById("panic").style.display = "block";

}
//***********MANUAL **************
//Creación form (modo manual)
function prueba(){
	reStart();
	indiceContagio = document.getElementById('carga').value;
	var num = document.getElementById('numero').value;
	numero = num;
	var docu = document.getElementById('form');
	var form = document.createElement('form');
	form.setAttribute("id","formulario");

	for(let i=0; i < num; i++){
		var per = i+1;
		var divelement = document.createElement('div');
		var edat = document.createElement('input');
		var carga = document.createElement('input');
		

		edat.type = "number";
		edat.id = "edad"+i;
		edat.placeholder = "edad per."+per;

		carga.type = "number";
		carga.id = "carga"+i;
		carga.placeholder = "carga per."+per;

		//divelement.appendChild(textper);
		divelement.appendChild(edat);
		divelement.appendChild(carga);
		form.appendChild(divelement);

	}
	docu.appendChild(form);

	var send = document.createElement('button');
	send.setAttribute("onClick", "obtenerForm("+num+")");
	send.innerHTML = "Crear elementos";
	send.setAttribute("id","btnform");

	docu.appendChild(send);
}

//Obtener valores del form
function obtenerForm(n){
	bolas = [];
	creadiv(n);
	for(let i = 0; i<n;i++){
		var value1 = document.getElementById('edad'+i).value;
		//si el campo esta vacio
		if (value1 =="") {
			//valor random
			value1 = Math.floor(Math.random() * 99) + 1;
		}
		var value2 = document.getElementById('carga'+i).value;
		value2 = parseInt(value2);
		//si el campo esta vacio
		if(isNaN(value2)){
			value2 = Math.floor(Math.random() * 100) + 0;
		}
		let p1 = (Math.random()>=0.5)? 1 : -1;
		let p2 = (Math.random()>=0.5)? 1 : -1;
		let posx = Math.floor(Math.random() * (cajax - 60)) + 70;
		let posy = Math.floor(Math.random() * (cajay - 60)) + 70;

		bolas[i] = new Bola(i,posx,posy,p1,p2,value2,value1);
 		
	}
	//quitamos el form
	var elemento = document.getElementById('form');
	var child = document.getElementById('formulario');
	elemento.removeChild(child);

	start();
	//btn panic
  	document.getElementById("panic").style.display = "block";
}


//Objeto bola
class Bola {
	constructor(id,x,y ,xd,yd,ca,age){
		this.id = id;
		this.x = x;
		this.y = y;
		this.xd = xd;
		this.yd = yd;
		//carga virica
		this.ca = ca;
		//edad
		this.age = age;
		//No infectado 0
		//Infectado 1
		this.estado = 0;
		//tiempo infectado
		this.tim = "";
	}
	//Movimiento bola
	move(){
		//velocidad
		this.x = this.x + 2 * this.xd;
		this.y = this.y + 2  * this.yd;
		//cambio de direccion
		if (this.x > width - rad || this.x < rad) {
   			 this.xd *= -1;
  		}
  		if (this.y > height - rad || this.y < rad) {
    		this.yd *= -1;
  		}
  		let htmlp = '';

  		//new -- color
  		let color = '';
  	
  		htmlp = String("movi"+this.id);

  		let estadoShow = "";
  		//Miramos el estado
  		if (this.estado == 1) {
  			estadoShow = "CONTAGIADO";
  			color = "red";
  		}else{
  			estadoShow ="No contagiado";
  			this.tim = time;
  			color = "black";
  		}
  		//mostrar info elemento 
  		var docu = document.getElementById(htmlp);

  		docu.innerHTML = "X: " + this.x.toFixed(2) + " Y: " + this.y.toFixed(2) + " Carga: "+this.ca+" Edad: "+this.age +" ESTADO: "+estadoShow +" tiempo: "+this.tim;

  		docu.style.color = color;

  		return docu;
	}
	//Mostrar bola
	show(){
		let c; 
		//Color segun carga virica 
		if(this.ca >= indiceContagio){
			this.estado = 1;
			//Color rojo
			c = color(255, 0, 0);
			fill(c);
			noStroke();
			ellipse(this.x,this.y, 50,50);
		}else{
			//Color segun edad 
			let varcol = colorAge(this.age);
			c = color(varcol[0],varcol[1],varcol[2]);
			fill(c);
			noStroke();
			ellipse(this.x,this.y, 50,50);
		}
	}

}

//Color segun edad
function colorAge(edat){

	let color = [];

	if (edat<10) {
		color = [234, 236, 238];
	}else if (10 <= edat && edat <= 39) {
		color = [171, 178, 185];
	}else if (40 <= edat && edat <= 49) {
		color = [128, 139, 150];
	}else if (50 <= edat && edat <= 59) {
		color = [86, 101, 115];
	}else if (60 <= edat && edat <= 69) {
		color = [44, 62, 80];
	}else if (70 <= edat && edat <= 79) {
		color = [39, 55, 70];
	}else if (80 <= edat) {
		color = [28, 40, 51];
	}

	return color;

}

//Funcion para mirar si las bolas se tocan 
//En caso de tocar añadir carga virica
function contacto(){
	for(let i = 0; i< bolas.length; i++){
		for(let u = 0; u < bolas.length; u++){
			if(u != i){
				var xi = (bolas[i].x).toFixed(0);
				var xu = (bolas[u].x).toFixed(0);
				var yi = (bolas[i].y).toFixed(0);
				var yu = (bolas[u].y).toFixed(0);
				if(xi == xu||xi+10 == xu || xi-10 == xu){
					// edat / carga1 / carga2 
					bolas[i].ca = viralLoad(bolas[i].age,bolas[i].ca,bolas[u].ca);
					bolas[u].ca = viralLoad(bolas[u].age,bolas[u].ca,bolas[i].ca);
					
				}
				
				if(yi == yu||yi+10 == yu || yi-10 == yu){

					bolas[i].ca = viralLoad(bolas[i].age,bolas[i].ca,bolas[u].ca);
					bolas[u].ca = viralLoad(bolas[u].age,bolas[u].ca,bolas[i].ca);

				}
			}
		}
	}
}
//Carga virica segun edad al contacto
function viralLoad(edat,carga1,carga2){
	//% de carga segons edat 
	//0 - 9 -- > 0,1%
	//10 -39 --> 0,2%
	//40 -49 --> 0,4%
	//50 - 59 --> 1,3%
	//60 - 69 --> 3,6%
	//70 - 79 --> 8%
	// 80 + --> 14,8%
	var newcarga ;
	if (edat<10) {
		
		newcarga = carga1 + (carga2 * 0,1);
	}else if (10 <= edat && edat <= 39) {
		
		newcarga = carga1 + (carga2 * 0,2);
	}else if (40 <= edat && edat <= 49) {
		
		newcarga = carga1 + (carga2 * 0,4);
	}else if (50 <= edat && edat <= 59) {
		
		newcarga = carga1 + (carga2 * 1,3);
	}else if (60 <= edat && edat <= 69) {
		
		newcarga = carga1 + (carga2 * 3,6);
	}else if (70 <= edat && edat <= 79) {
		
		newcarga = carga1 + (carga2 * 8);
	}else if (80 <= edat) {
		
		newcarga = carga1 + (carga2 * 14,8);
	}

	return newcarga;

}

//Con esta funcion miramos el estado de contagio del conjunto
function estado(){
	let sumaContagiados = 0;
	for(let i = 0; i< bolas.length; i++){
		if (bolas[i].estado == 1) {
			sumaContagiados = sumaContagiados +1;
		}

	}
	//Llamara a funcion para guardar tiempos
	estadistica(sumaContagiados);
	//Miramos si todos estan contagiados
	if (sumaContagiados == numero) {
		
		document.getElementById('inf').innerHTML = "TODOS INFECTADOS"

		document.getElementById("descargar").style.display = "block";

		document.getElementById("panic").style.display = "none";
		//Paramos simulacion
		simulacion = false;
	}



}
//Funcion creacion array del numero de contagiados
function estadistica(num){
	//Miramos si el numero de contagiados ha cambiado
	if(numerocont < num){
		numerocont = num;
		let newtt = count;
		//Hacemos un push del tiempo
		arraytimes.push(newtt);
	}

}
//Funcion restart del programa 
function reStart(){
	stop();
	time = '00:00:00';
	count = 0;
	simulacion = true;
	bolas = [];

	//grafica
	onetime = true;
	numerocont = 0;
	arraytimes = [];
	if (document.getElementById('graficaCurva')) {
		var elemento3 = document.getElementById('grafica');
		var child3 = document.getElementById('graficaCurva');
		elemento3.removeChild(child3);
    }



	document.getElementById('clock').innerHTML = '00:00:00';
	document.getElementById('inf').innerHTML = '';
	document.getElementById('panic').style.display = "none";

	
	if (document.getElementById('divsecond')) {
		var elemento = document.getElementById('divs');
		var child = document.getElementById('divsecond');
		elemento.removeChild(child);
    }

    if (document.getElementById('formulario')) {
		var elemento2 = document.getElementById('form');
		var child2 = document.getElementById('formulario');
		var btnform = document.getElementById('btnform');
		elemento2.removeChild(child2);
		elemento2.removeChild(btnform);
    }

    document.getElementById("descargar").style.display = "none";


}

//--------CRONOMETRO------------------
//Iniciar cronometro
function start(){
	clear = setInterval(ValueCount,1000)
}

//Parar cronometro
function stop(){
	clearInterval(clear);
}

//Obtener tiempo y mostrarlo
function ValueCount(){
	count = count + 1;
	//pasem el temps en segons a HH/MM/SS
	time = secondsToString(count);
	document.getElementById('clock').innerHTML = time;
	
}

//Funcion formato cronometro (HH/MM/SS)
function secondsToString(seconds) {
  hour = Math.floor(seconds / 3600);
  hour = (hour < 10)? '0' + hour : hour;
  minute = Math.floor((seconds / 60) % 60);
  minute = (minute < 10)? '0' + minute : minute;
  second = seconds % 60;
  second = (second < 10)? '0' + second : second;
  return hour + ':' + minute + ':' + second;
}


//Enviamos objetos al script de PDF
function btndownload(){
	download(bolas);
}

//Funcion panic (para experimento)
function panic(){
	window.alert("Parar experimento");
}


