<?php

    include 'AlunosService.php'; 
    
    //header("Content-Type: application/json");
     // alterando o cabecalho para retornar um json
    header("Content-Type: application/json; charset=UTF-8;");    
    header("Access-Control-Allow-Origin: *");  // Necessário para a mesma máquina (localhost)  

    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control: no-cache, no-store, must-revalidate");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Max-Age: 86400");

    
    var_dump($_GET);
    var_dump($_GET['url']) ;    

    if($_GET['url']){
        // se houver url ele cria a variável url
        $url = explode('/' , $_GET['url']);
        // mostrar a url
        var_dump($url);

        if($url[0] === 'api' ){
            //se estiver tentando acessar a api
            array_shift($url);            
            // $service = 'App\Services\\'.ucfirst( $url[0]).'Service' ;
            $service = ucfirst( $url[0]).'Service' ;
            array_shift($url);
            //removendo a primeira posição do registro (neste caso api)
            
            $method = strtolower( $_SERVER['REQUEST_METHOD']);
            // metodo get ou post
            var_dump($service) ;           
            var_dump($method) ;            
            var_dump($url);
            // die();
            try {// chama o metodo
                $response =  call_user_func_array(array( new  $service , $method), $url) ;              

                http_response_code(200) ; // ok
                echo json_encode( array('sucesso' => true , 'mensagem' => '' , 'dados' => $response));
                //convertendo o resultado em json e mostrando os dados;
            } catch (Exception $e) {
                http_response_code(404) ; // erro
                echo json_encode( array('sucesso' => false , 'mensagem' => $e->getMessage() , 'dados' => []));
                //mostrando a mensagem de erro (não encontrado);
            }
        }
    }
    ?>
