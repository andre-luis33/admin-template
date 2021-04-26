(function(){
   const authKey = 'g24Kw!2#BN0fAfMj89'

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

   var pathsFinanceiro = [
      "cadastro-usuarios"
   ]

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
   var localTheme = localStorage.getItem('data-theme')
   
   btnTheme.onclick = () => {
      var wichTheme = themeLink.getAttribute('data-theme')

      if(wichTheme == 'white') {
         themeLink.href = 'assets/css/dark-mode.css'
         themeLink.setAttribute('data-theme', 'dark')
         switchClick('#btn-theme', true)
         localStorage.setItem('data-theme', 'dark')
      } else {
         themeLink.href = 'assets/css/white-mode.css'
         themeLink.setAttribute('data-theme', 'white')
         switchClick('#btn-theme', false)
         localStorage.setItem('data-theme', 'white')
      }
   }

   if(localTheme == 'dark') {
      themeLink.href = 'assets/css/dark-mode.css'
      themeLink.setAttribute('data-theme', 'dark')
      switchClick('#btn-theme', true)
   } else {
      themeLink.href = 'assets/css/white-mode.css'
      themeLink.setAttribute('data-theme', 'white')
      switchClick('#btn-theme', false)
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

   /*  ############### Parte SPA #################   */
   var linkEl = $('[js-link]')

   var contentBox = $('.content')
   var contentLoader = $('.content-loader')

   var currentPage = getLastPath(window.location.pathname, 'public/')
   $(`a[js-link="${currentPage}"]`).addClass('selected')

   if(pathsFinanceiro.includes(currentPage)) {
      itemsMenuHidden.slideDown(400)
   }

   function navigate(href) {
      linkEl.removeClass('selected')
      $(`[js-link="${href}"]`).addClass('selected')

      setCursor('wait')
      contentLoader.css('display', 'flex')

      $.ajax({
         url: 'spa/' + href,
         method: 'GET', 
         beforeSend: function(request) {
            request.setRequestHeader("auth-key", authKey);
         },
         success: data => {
            contentBox.html(data)
            setCursor('auto')
            contentLoader.fadeOut(300)
            history.pushState({ box: '.content' }, null, href)
            currentPage = href
         },
         error: () => {
            setCursor('auto')
            contentLoader.fadeOut(300)
            contentBox.html('Erro ao carregar página :(')
         },
      })
   }

   linkEl.click(e => {
      e.preventDefault()

      var href = e.currentTarget.getAttribute('js-link')
      var currentHref = getLastPath(window.location.pathname, 'public/')

      if(currentHref == href) return
      navigate(href)
   })

   window.onpopstate = e => {
      var href = getLastPath(window.location.pathname, 'c/')
      navigate(href)
   }

   var pagesPaths = []
   var linkElJS = document.querySelectorAll('a[js-link]')


   for(var i = 0; i < linkElJS.length; i++) { // pega todas as paginas disponiveis
      pagesPaths.push(linkElJS[i].getAttribute('js-link'))
   }

   console.log(pagesPaths)

   // navegação por arrow down e arrow up
   $(window).keydown(e => {
      
      if(e.altKey && e.keyCode == 40) {
         var index = pagesPaths.indexOf(currentPage)
         var plusOne
         
         if((index + 1) < pagesPaths.length) {
            plusOne = pagesPaths[index + 1] 
         
         } else {
            plusOne = pagesPaths[0] // deverá ser a primeira página na lista do menu
         }

         if(pathsFinanceiro.includes(plusOne)) {
            itemsMenuHidden.slideDown(400)
         } else {
            itemsMenuHidden.slideUp(400)
         }

         navigate(plusOne)

      } else if (e.altKey && e.keyCode == 38) {
         var index = pagesPaths.indexOf(currentPage)
         var plusOne
         
         if((index - 1) < 0) {
            plusOne = pagesPaths[pagesPaths.length - 1] // deverá ser a ultima página do menu, caso ela seja logout, invés de - 1 use - 2
            
         } else {

            plusOne = pagesPaths[index - 1] 
         }

         if(pathsFinanceiro.includes(plusOne)) {
            itemsMenuHidden.slideDown(400)
         } else {
            itemsMenuHidden.slideUp(400)
         }

         navigate(plusOne)
      }
   })

})()

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

