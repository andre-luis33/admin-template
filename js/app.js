(function(){
   /*  ############### Var, Consts, e funcoes Globais #################   */
   var bgDiv = $('#bg')

   function bgIn(delay = 300) {
      bgDiv.fadeIn(delay)
   }

   function bgOut(delay = 300) {
      bgDiv.fadeOut(delay)
   }

   function switchClick(element, clicked) {
      if(clicked) {
         document.querySelector(element).setAttribute('clicked', 'true')
      } else {
         document.querySelector(element).setAttribute('clicked', 'false')
      }
   }

   bgDiv.click(() => {
      closeSidebar()
      closeConfigBar()
   })

   /*  ############### Parte de Toggle Menu #################   */
   var btnToggle = $('[btn-toggle-sidebar]')
   var btnToggleIcon = document.querySelector('#btn-toggle-icon')
   var navBar = document.querySelector('.sidebar')
   var navBarJQ = $('.sidebar')

   function toggleSidebar() {
      var isActive = navBar.classList.contains('active')
      btnToggleIcon.classList.remove('fa-bars')
      btnToggleIcon.classList.remove('fa-times')
      
      if(isActive) {
         closeSidebar()
      } else {
         btnToggleIcon.classList.add('fa-times')
         navBar.classList.add('active')
         bgIn()
      }
   }

   function closeSidebar() {
      navBar.classList.remove('active')
      btnToggleIcon.classList.add('fa-bars')
      btnToggleIcon.classList.remove('fa-times')
      bgOut()
   }

   btnToggle.click(() => toggleSidebar())

   navBarJQ.hover(
      () => bgIn(),
      () => {
         var isFixed = navBar.classList.contains('active')
         if(!isFixed) {
            bgOut()
         }
      }
   )


   /*  ############### Parte de Toggle Item do Menu #################   */
   var btnFinanceiro = document.querySelector('#navbar-dropdown')
   var itemsMenuHidden = $('.hidden-navbar-item[financeiro]')

   btnFinanceiro.onclick = () => itemsMenuHidden.slideToggle(400)


   /*  ############### Parte de Toggle Item do Menu #################   */
   var btnConfig = document.querySelector('#btn-config')
   var configBar = document.querySelector('.config-bar')
   var configBarJQ = $('.config-bar')
   var closeConfigBarBtn = document.querySelector('#close-config-bar')

   btnConfig.onclick = () => {
      configBarJQ.slideDown(400)
      bgIn()
      bgDiv.mousedown(() => closeConfigBar())
   }

   function closeConfigBar() {
      // configBar.classList.remove('active')
      // bgDiv.off("mousedown")
      bgOut()
      configBarJQ.slideUp(400)
   }

   closeConfigBarBtn.onclick = () => closeConfigBar()

 
   /*  ############### Parte do dark mode #################   */

   var btnTheme = document.querySelector('#btn-theme')
   var themeLink = document.querySelector('[data-theme]')

   btnTheme.onclick = () => {
      var wichTheme = themeLink.getAttribute('data-theme')

      if(wichTheme == 'white') {
         themeLink.href = 'css/dark-mode.css'
         themeLink.setAttribute('data-theme', 'dark')
         switchClick('#btn-theme', true)
      } else {
         themeLink.href = 'css/white-mode.css'
         themeLink.setAttribute('data-theme', 'white')
         switchClick('#btn-theme', false)
      }
   }



   /*  ############### Binds do teclado #################   */

   $(window).keydown(e => {
      if(e.ctrlKey && e.keyCode === 66) {
         toggleSidebar()

      } else if (e.keyCode === 27) {
         closeSidebar()
         closeConfigBar()
      }
   })

   
})()