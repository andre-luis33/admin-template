<?php

class Router{

    private $painelFile = '../src/views/painel.php';
    /**
     * 
     * 
     */

   public function handleRoute($url): array{
      if(!$url) {
         return [
            'loader' => $this->painelFile,
            'view' => 'home.html',
         ];
      }
      $routePath = $this->identifyPath($url); // verifica se está tentando acessar uma view com renderização completa ou somente o conteúdo
      $route = $this->$routePath($url); // carrega o respectivo arquivo
      return $route; // array
   }

   public function getView($url){
      $loader = $this->painelFile;

      switch($url) {
         case 'cadastro-usuarios':
            $view = 'cadastro-usuarios.html';
         break;

         case 'relatorios':
            $view = 'relatorios.html';
         break;

         case 'home':
            $view = 'home.html';
         break;

         default:
            $view = '404.html';
         break;
      }

      return [
         'loader' => $loader,
         'view' => $view,
      ];
   }

   public function getSPAView($url) {
      $headers = getallheaders();
      if($headers['auth-key'] != 'g24Kw!2#BN0fAfMj89') {
         http_response_code(400);
         die;
      }

      $url = $this->cutPath($url);

      switch($url) {
         case 'home':
            $loader = 'home.html';
         break;

         case 'cadastro-usuarios':
            $loader = 'cadastro-usuarios.html';
         break;

         case 'relatorios':
            $loader = 'relatorios.html';
         break;

         default:
            $loader = '404.html';
         break;
      }

      return [
         'loader' => '../src/views/'.$loader,
         'view' => ''
      ];
   }

    
    /**
     * Identifica o caminho que o usuário deseja acessar, e retorna o respectivo handler 
     */
   public function identifyPath(String $url): string {
      $hasBar = strpos($url, '/');
   
      if(!$hasBar) {
         return 'getView';
      } else {
         return 'getSPAView';
      }
   }


    /**
     * Corta o caminho, e deixa apenas a queryString a ser procurada, uma vez que o caminho ja foi encontrado
     * @param string $url URL a ser tratada
     * @return string a URL tratada
     */
    public function cutPath($url): string {
        $bar = strpos($url, '/');
        // return substr($url, 0, $bar);
        return substr($url, $bar + 1, strlen($url));
    }

}
