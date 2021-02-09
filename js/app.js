(function(){
   /*  ############### Parte de Toggle Menu #################   */
   var btnToggle = document.querySelector('#btn-toggle')
   var btnToggleIcon = document.querySelector('#btn-toggle-icon')
   var navBar = document.querySelector('.sidebar')

   function toggleSidebar() {
      var isActive = navBar.classList.contains('active')
      btnToggleIcon.classList.remove('fa-bars')
      btnToggleIcon.classList.remove('fa-times')
      
      if(isActive) {
         navBar.classList.remove('active')
         btnToggleIcon.classList.add('fa-bars')
      } else {
         btnToggleIcon.classList.add('fa-times')
         navBar.classList.add('active')
      }
   }

   btnToggle.onclick = () => toggleSidebar()

   $(window).keydown(e => {
      if(e.ctrlKey && e.keyCode === 66) {
         toggleSidebar()
      }
   })


   /*  ############### Parte de Toggle Item do Menu #################   */
   var btnFinanceiro = document.querySelector('#navbar-dropdown')
   var itemsMenuHidden = $('.hidden-navbar-item[financeiro]')

   btnFinanceiro.onclick = () => itemsMenuHidden.slideToggle(400)

   /* ############## Parte para lupa do header ########### */
   var btnLupa = document.querySelector('#btn-lupa')
   var inputHeader = $('#input-header')

   btnLupa.onclick = () => inputHeader.fadeToggle(1000)

})()