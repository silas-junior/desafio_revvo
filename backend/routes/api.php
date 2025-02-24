<?php

// VAI REMOVER QUERY PARAMS E RETORNAR SOMENTE '/api/courses/{id}'
$uri = trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
$method = $_SERVER['REQUEST_METHOD'];

// echo json_encode($uri);
// die();

$basePath = '/api';

// VAI RETIRAR A BARRA(/) DO $basePath E VAI VERIFICAR SE A POSIÇÃO DA REFERÊNCIA(api) DENTRO DE $uri É IGUAL A 0
// OU SEJA, COMO A $uri POR PADRÃO DEVE SER: api/courses, ENTÃO A POSIÇÃO DA REFERÊNCIA(api) DE FATO VAI SER 0
// MAS CASO SEJA INFORMADO ALGO DIFERENTE DE: api/courses, POR EXEMPLO: teste/api/courses VAI RETORNAR QUE A ROTA NÃO EXISTE
if(strpos($uri, trim($basePath, '/')) === 0) {
   $path = substr($uri, strlen($basePath));
} else {
   $path = $uri;
}

// VAI VERIFICAR SE O $path POSSUI *OPCIONALMENTE(IMAGINANDO QUE SEJA UM ID)* ALGUM NÚMERO DEPOIS DE "courses/"
if (preg_match('/^courses(?:\/(\d+))?$/', $path, $matches)) {
   $id = null;

   if(!empty($matches[1])) {
      $id = intval($matches[1]);
   }


   switch ($method) {
      case 'GET':
         if(!$id) {
            echo "Buscando todos...";
         } else {
            echo "Buscando somente um...";
         }
         break;
      case 'POST':
         echo "Criando...";
         break;
      case 'PUT':
         echo "Atualizando...";
         break;
      case 'DELETE':
         echo "Deletando...";
         break;
      
      default:
         http_response_code(404);
         echo json_encode(['message' => 'Invalid request method']);
         break;
   }
} else {
   http_response_code(404);
   echo json_encode(["error" => "Rota não encontrada"]);
}