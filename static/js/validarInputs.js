function validateNumber(evt) {

    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;

    key = String.fromCharCode( key );
    var regex = new RegExp('^[0-9\b\t]$');

    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function validateText(evt) {

    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;

    key = String.fromCharCode( key );
    var regex = /^[a-zÀ-úA-Z\s\b\t]*$/;

    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function validateTextFn(element) {

    var text = element.value;
    var regex = /^[a-zÀ-úA-Z\s\b\t]*$/;

    if(!regex.test(text)) {
        element.classList.add('incorrecto');
    }
    else{
        if(element.classList.contains('incorrecto'))
          element.classList.remove('incorrecto');
          return true;
    }
}

function words(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}


function validateMail(element) {

    var mail = element.value;
    var regex = /\S+@\S+\.\S+/;

    if(!regex.test(mail)) {
        element.classList.add('incorrecto');
    } else {
        if(element.classList.contains('incorrecto'))
          element.classList.remove('incorrecto');
          return true;
    }
}

function validatePhoneKey(evt) {

    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;

    key = String.fromCharCode(key);
    var regex = /[\b\t\d+()-]/;

    if(!regex.test(key)) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function checkEmpty(element){
    if(element.value == ""){
        element.classList.add('incorrecto');
    }else{
        element.classList.remove('incorrecto');
        return true;
    }
}

function checkSelect(element){
  if(element.value === "" && element.value === "0"){
      element.classList.add('incorrecto');
  } else {
      element.classList.remove('incorrecto');
      return true;
  }
}

function validatePassword(element) {
    var newPassword = element.value;
    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,12}$/;
    if(regularExpression.test(newPassword)){
      return true;
    } else {
      return false;
    }
}

function validateSamePass(FirstElement, SecondElement){
    if (FirstElement.value == SecondElement.value){
        SecondElement.classList.remove('incorrecto');
        return true;
    } else {
        SecondElement.classList.add('incorrecto');
        return false;
    }
}
