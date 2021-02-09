(function(){
   /*  ############### Var e Consts Globais #################   */
   var bgDiv = $('#bg')

   function bgIn(delay = 300) {
      bgDiv.fadeIn(delay)
   }

   function bgOut(delay = 300) {
      bgDiv.fadeOut(delay)
   }


   /*  ############### Parte de Toggle Menu #################   */
   var btnToggle = document.querySelector('#btn-toggle')
   var btnToggleIcon = document.querySelector('#btn-toggle-icon')
   var navBar = document.querySelector('.sidebar')
   var navBarJQ = $('.sidebar')

   function toggleSidebar() {
      var isActive = navBar.classList.contains('active')
      btnToggleIcon.classList.remove('fa-bars')
      btnToggleIcon.classList.remove('fa-times')
      
      if(isActive) {
         navBar.classList.remove('active')
         btnToggleIcon.classList.add('fa-bars')
         bgOut()
      } else {
         btnToggleIcon.classList.add('fa-times')
         navBar.classList.add('active')
         bgIn()
      }
   }

   btnToggle.onclick = () => toggleSidebar()

   $(window).keydown(e => {
      if(e.ctrlKey && e.keyCode === 66) {
         toggleSidebar()
      }
   })

   navBarJQ.hover(
      () => bgIn(),
      () => bgOut()
   )


   /*  ############### Parte de Toggle Item do Menu #################   */
   var btnFinanceiro = document.querySelector('#navbar-dropdown')
   var itemsMenuHidden = $('.hidden-navbar-item[financeiro]')

   btnFinanceiro.onclick = () => itemsMenuHidden.slideToggle(400)


})()