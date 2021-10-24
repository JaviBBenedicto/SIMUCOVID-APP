function graficar(times){


	crearCanvas();

	var number = [];
	var valors = [];
	for(let i = 1; i < (times.length + 1); i++){
		number.push(i);
	}
	for(let u = 0; u < times.length ; u++){
		var time = secondsToString(times[u]);
		valors.push(time);
	}

	for(let y = 0; y < valors.length; y++){
		for(let t = 0; t < valors.length; t++){
			if(y != t){
				
				if(valors[y] == valors[t]){

					valors.splice(y,1);
					number.splice(y,1);
				}
			}
		}
		if (valors[y] =="NaN:NaN:NaN") {
			valors.splice(y,1);
		}
	}


	var ctx = document.getElementById('graficaCurva').getContext('2d');
	var chart = new Chart(ctx, {
		type: 'line',
		data:{
		datasets: [{
		data: number,
		borderColor: '#DE3163',
		pointBorderColor: '#DE3163',
		label: 'Numero de contagiados'}],
		labels: valors},
		options: {
			responsive: true,
			title:{
				display: true,
				text: 'Curva de contagios'
			},
			scales: {
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Tiempo (HH:MM:SS)'
					}
				}],
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Contagiados'
					}
				}]
			}
		}
	});

}

function secondsToString(seconds) {
  hour = Math.floor(seconds / 3600);
  hour = (hour < 10)? '0' + hour : hour;
  minute = Math.floor((seconds / 60) % 60);
  minute = (minute < 10)? '0' + minute : minute;
  second = seconds % 60;
  second = (second < 10)? '0' + second : second;
  return hour + ':' + minute + ':' + second;
}

function crearCanvas(){
	var docu = document.getElementById('grafica');
	var canvas = document.createElement('canvas');
	canvas.setAttribute("id","graficaCurva");
	canvas.setAttribute("width","800");
	canvas.setAttribute("height","400");
	docu.appendChild(canvas);

}