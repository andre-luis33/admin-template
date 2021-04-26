<?php

class Router{

   private String $painelFile = '../src/views/painel.php';
   private String $apiPath = '../src/api/';
   
   /**
    * Para adicionar uma nova view, basta criar um novo índice no array. O arquivo deverá estar dentro de src/views
    */
   protected Array $views = [
      'cadastro-usuarios' => 'cadastro-usuarios.html',
      'relatorios' => 'relatorios.php',
      'clientes' => 'customers.php',
      'home' => 'home.php',
   ];
   protected String $page404 = '404.html';
   
   protected Array $api = [
      'customers' => 'customers.php'
   ];
   

   
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

      if(array_key_exists($url, $this->views)) 
         $view = $this->views[$url];
      else
         $view = $this->page404;
      

      return [
         'loader' => $loader,
         'view' => $view,
      ];
   }

   public function getSPAView($url) {
      $headers = getallheaders();

      // oferece uma segurança mínima, visto que qualquer um pode copiar a chave. Mas impede que alguem abra no browser normalmente
      if($headers['auth-key'] != SPA_AUTH_KEY) { 
         http_response_code(400);
         echo 'Ops, método não autorizado!';
         die;
      }

      $url = $this->cutPath($url);

      if(array_key_exists($url, $this->views)) 
         $loader = $this->views[$url];
      else
         $loader = $this->page404;
      

      return [
         'loader' => '../src/views/'.$loader,
         'view' => ''
      ];
   }

   public function getAPIController($url) {
      $headers = getallheaders();

      // oferece uma segurança mínima, visto que qualquer um pode copiar a chave. Mas impede que alguem abra no browser normalmente
      if($headers['auth-key'] != SPA_AUTH_KEY) { 
         http_response_code(400);
         echo 'Ops, método não autorizado!';
         die;
      }

      $url = $this->cutPath($url);

      if(array_key_exists($url, $this->api)) 
         $loader = $this->api[$url];
      else
         returnRequest(404, 'Route not found');
      

      return [
         'loader' => $this->apiPath.$loader,
      ];
   }

    
    /**
     * Identifica o caminho que o usuário deseja acessar, e retorna o respectivo handler 
     */
   public function identifyPath(String $url): string {
      $hasBar = strpos($url, '/');
      
      $dir = $this->cutDir($url);
      
      if(!$hasBar) {
         return 'getView';

      } else if ($dir == 'spa') {
         return 'getSPAView';
      } else if ($dir == 'api') {
         return 'getAPIController';
      }
   }


   /**
    * Corta o caminho, e deixa apenas a queryString a ser procurada, uma vez que o caminho ja foi encontrado
    * @param string $url URL a ser tratada
    * @return string a URL tratada
    */
   public function cutPath($url): string {
      $bar = strpos($url, '/');
      return substr($url, $bar + 1, strlen($url));
   }
   
   public function cutDir($url): string {
      $bar = strpos($url, '/');
      return substr($url, 0, $bar);
   }

}
