function validar(num) {
	var clase = "formValidar"+num;
	var mensaje = "";
	var inputs = document.getElementsByClassName(clase);
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].value == "" || inputs[i].value.length == 0 || /^\s*$/.test(inputs[i].value) || inputs[i].value == "El campo es obligatorio" || inputs[i].value == "23:00") {
			mensaje += "El campo es obligatorio";
			if (inputs[i].type == 'password') {
				inputs[i].placeholder = "El campo es obligatorio";
			} else if (inputs[i].type == 'time') {
				inputs[i].value = "23:00";
			} else {
				inputs[i].value = "El campo es obligatorio";
			}
			
			inputs[i].style.backgroundColor = "#ffaaaa";
			inputs[i].onfocus = function() {
				return limpiar(this);
			}
		}
	}

	if (mensaje == "") {
		return true;
	} else {
		return false;
	}
}

function limpiar(target) {
	if (target.value == "El campo es obligatorio" || target.placeholder == "El campo es obligatorio" || target.value == "23:00") {
		target.value= "";
		target.style.backgroundColor = "white";
	}
}

window.onload = function() {
	document.formValidar1.onsubmit = function() {
	return validar(1);
	}
	document.formValidar2.onsubmit = function() {
	return validar(2);
	}
	document.formValidar3.onsubmit = function() {
	return validar(3);
	}
	document.formValidar4.onsubmit = function() {
	return validar(4);
	}
}