function disable(element, action = true) {
   if(action) {
       $(element).prop('disabled', true)
   } else {
       $(element).prop('disabled', false)
   }

   return
}

function setDisplay(el, display){
   $(el).css('display', display)
}

function rotate(el, deg){
   $(el).css('transform', 'rotate('+deg+'deg)')
}

// se for necessÃ¡rio passar algum elemento especifico, passar com o seletor junto! parametro action Ã© obrigatorio!
function setCursor(action, element = false) {
   if(!element) {
       $('body, html').css('cursor', action)
   } else {
       $(element).css('cursor', action)
   }
   return
}

function checkEnter(btn){
   $(window).keydown(function(event){
       var tecla = event.keyCode;
       if(tecla == 13){
           if(!$('textarea').is(':focus')) {
               $(btn).click();
           }
       } 
   })
}

function lazyLoad() {
   document.querySelectorAll('img[data-src]').forEach((img, index) => {
       if(img.getBoundingClientRect(). top < window.innerHeight && img.src == '') {
           img.src = img.getAttribute('data-src')
       }
   })
}

function validateEmail(email) {
   if(email.indexOf('@') == -1 || email.indexOf('.') == -1) {
       return false       
   } else {
       return true
   }
}

function validateCNPJ(cnpj) {
   if(cnpj.length < 18) {
       return false
   } else {
       return true
   }
}

function checkNullValue(el) {
   var inputs = document.querySelectorAll(el)
   var flag = true

   for(var i = 0; i < inputs.length; i++) {
       if(inputs[i].value == '') {
           inputs[i].classList.add('is-invalid')
           flag = false
       } else {
           inputs[i].classList.remove('is-invalid')
       }
   }

   return flag
}

function formatNumber (num) {
   // var number = num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
   // number = number.replace('.', ',')
   var number = parseFloat(num)
   return number.toLocaleString('pt-br', {minimumFractionDigits: 2});
   // return number
}

function formatDate(data) {
   var dia  = data.split("/")[0];
   var mes  = data.split("/")[1];
   var ano  = data.split("/")[2];
 
   return ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
   // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
}

function compareDates(pattern = 'EN', d1, d2 = false) {
  if(pattern != 'EN') {
     d1 = formatDate(d1)
     d1 = new Date(d1)

     if(d2) {
        d2 = formatDate(d2)
     } else {
        d2 = new Date()
     }
  }

  if(d1 > d2) {
     return 'd1' 
  } else {
     return 'd2'
  }
}

function today(pattern = 'EN') {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  if(pattern == 'EN') {
     return yyyy+'-'+mm+'-'+dd
  } else {
     return dd+'/'+mm+'/'+yyyy
  }
}

function getLastPath(fullURL, needle) {
   var neddleLen = needle.length
   return fullURL.substr(fullURL.indexOf(needle) + neddleLen, fullURL.length)
}

function tableWaitingResponse(el, colspan, type = 'append') {
   if(type == 'append')
      $(el).append(`<td class="text-center" colspan=${colspan}><i class="fas fa-circle-notch fa-spin"></i></td>`)
   else 
      $(el).html(`<td class="text-center" colspan=${colspan}><i class="fas fa-circle-notch fa-spin"></i></td>`)
}