<?php

      // Arquivo de Regras de negócio
      // MODELO ->Operações para Acessar o BANCO DE DADOS

     /* criar uma classe para acessae o BD e criarmos dois métodos */
      
      require_once 'config.php' ; // ou include 'config.php'
      class Alunos 
      {
        //um método para fazer consulta atráves do parâmetro $id
        public static function select(int $id)
        {
            $tabela = "alunos";
            $coluna = "ra";
            
            // conectando com o banco de dados através da classe PDO
            // pegando as informações do config.php (variáveis globais)
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);            
           // comando que será executado no banco de dados para consultar
            $sql = "select * from $tabela where $coluna = :id" ;
            // preparando o comando Select para ser executado usando método prepare()
            $stmt = $connPdo->prepare($sql);            
            // configurando (ou mapear) o parametro de busca
            $stmt->bindValue(':id' , $id) ;
           // executando o comando select no banco de dados
            $stmt->execute() ;
           
            if ($stmt->rowCount() > 0)
            {
                // se houve retorno de dados
                //ou imprimir usando : var_dump( $stmt->fetch(PDO::FETCH_ASSOC) );
                return $stmt->fetch(PDO::FETCH_ASSOC) ; // retornando os dados do banco de dados                
            }else{
                // se não houve retorno de dados, jogar no classe Exception (erro)
                throw new Exception("Sem registro do aluno");
            }

        }
        
        //Um método para fazer consultado de todos os dados
        public static function selectAll()
        {
            $tabela = "alunos";
            
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "select * from $tabela"  ;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute() ;

            if ($stmt->rowCount() > 0)
            {
                return $stmt->fetchAll(PDO::FETCH_ASSOC) ;
            }else{
                throw new Exception("Sem registros");
            }

        }

        //Um método para fazer inclusao de dados no BD
        public static function insert($dados)
        {
           $tabela = "alunos";
           
           $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
           //comando SQL
           $sql = "insert into $tabela (nome,email,telefone) values (:nome, :email, :telefone)"  ;
           $stmt = $connPdo->prepare($sql);
           //Mapear os parâmentros para obter os dados de inclusao
           $stmt->bindValue(':nome' , $dados['nome']) ;
           $stmt->bindValue(':email' , $dados['email']) ;
           $stmt->bindValue(':telefone' , $dados['telefone']) ;
           $stmt->execute() ;

           if ($stmt->rowCount() > 0)
           {
               return 'Dados cadastrados com sucesso!';
           }else{
               throw new Exception("Erro ao  inserir os dados!!");
           }
        }
        //Um método para fazer alteração de dados no BD
        public static function alterar($id, $dados)
        {
            $tabela = "alunos";
            $coluna = "ra";
            
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "update $tabela  set nome=:nome, email=:email, telefone=:telefone where $coluna = :id"  ;
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id' , $id) ;
            $stmt->bindValue(':nome' , $dados['nome']) ;
            $stmt->bindValue(':email' , $dados['email']) ;
            $stmt->bindValue(':telefone' , $dados['telefone']) ;            
            $stmt->execute() ;

            if ($stmt->rowCount() > 0)
            {
                return 'Dados alterados com sucesso!';
            }else{
                throw new Exception("Erro ao  alterar os dados!!");
            }
        }
        //Um método para fazer exclusão de um determinado dado atráves de id
        public static function delete($id)
        {
            $tabela = "alunos";
            $coluna = "ra";

            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "delete from $tabela where $coluna = :codigo"  ;
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':codigo' , $id) ;
            $stmt->execute() ;

            if ($stmt->rowCount() > 0)
            {
                return 'Dados excluídos com sucesso!';
            }else{
                throw new Exception("Erro ao excluir os dados!!");
            }
        }   

    }

    ?>