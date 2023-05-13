<?php

    // arquivo de controle : tipo de servicos
    
    include 'Alunos.php';
    class AlunosService 
    {
        //Um método para consulta de dados
        public function get( $id = null)
        {
            if ($id){// se existe id              
                return Alunos::select($id) ;
            }else{
                return Alunos::selectAll() ;
            }

        }
        
        // funcão para inclusão de dados
        public function post()
        {
            /* Metodo 01: 
            $dados = $_POST; //$_POST é vetor(array) para receber os dados de retorno
            return Alunos::insert($dados); */

            /* Metodo 02:  */
            // pega as informações para incluir no banco            
            $dados = json_decode(file_get_contents('php://input'), true, 512);
            if ($dados == null) {
                throw new Exception("Faltou as informações para incluir");
            }
            return Alunos::insert($dados);           
        }

        // funcão para alteração de dados
        public function put($id = null)          
        {
            if ($id == null ){
                throw new Exception("Falta o código");
            }                  
            // pega as informações para atualizar no banco
            $dados = json_decode(file_get_contents('php://input'), true, 512);
            if ($dados == null ){
                throw new Exception("Faltou as informações para alterar");
            }
            return Alunos::alterar($id, $dados);  
        }

        // funcão para exclusão de dados          
        public function delete($id = null)
        {
            if($id == null ){
                throw new Exception("Falta o código");
            }
            return Alunos::delete( $id );   
        }
    }
    ?>