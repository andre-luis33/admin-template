<?php


/**
 * Essa função retorna um status HTTP de acordo com o parâmetro, com direito a dois campos de texto e um array de dados convertidos em json. Após a exibição do json, o arquivo é encerrado OBRIGATORIAMENTE!
 * @param int $status Status HTTP a ser passado na resposta da requisição
 * @param string $type json.type (Opcional)
 * @param array $data json.data.[seu array de dados] (Opcional)
 * @return void o arquivo morre para não exibir nenhum conteúdo desnecessário para o DOM
 */
function returnRequest($status, $type = '', $data = ''): void {
   http_response_code($status);
   if($status != 204) {
       echo json_encode([
           'status' => $status,
           'type' => $type,
           'data' => $data
       ]);
   }
   exit();
   die;
}



?>