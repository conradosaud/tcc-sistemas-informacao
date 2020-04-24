<?php

include_once("../../model/AnuncioOperacoes.php");
include_once("../../php/InterfaceREST.php");

class AnuncioOperacoesControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        switch($action){
            case "buscaAnuncioPorIdEmpresa":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncio = $objAnuncio->buscaAnuncioPorIdEmpresa($obj);
                return $objAnuncio;
            case "buscaTodosBasico":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncio = $objAnuncio->buscaTodosBasico($obj);
                return $objAnuncio;
            case "buscaAnuncioGeral":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncio = $objAnuncio->buscaAnuncioGeral($obj);
                return $objAnuncio;
            case "buscaTodosImpulsionados":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncio = $objAnuncio->buscaTodosImpulsionados();
                return $objAnuncio;
            case "buscaTodosPreencher":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncio = $objAnuncio->buscaTodosPreencher($obj);
                return $objAnuncio;
            case "buscaFiltroCategoria":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncio = $objAnuncio->buscaFiltroCategoria($obj);
                return $objAnuncio;
            case "buscaFiltros":
                $objAnuncio = new AnuncioOperacoes();
                $objAnuncioTodos = $objAnuncio->buscaFiltro($this->filtrarGeral($obj));
                $objAnuncioImpulsionados = $objAnuncio->buscaFiltro($this->filtrarImpulsionado($obj));
                $objAnuncio = ["geral"=>$objAnuncioTodos, "impulsionados"=>$objAnuncioImpulsionados];
                $objAnuncio = $this->reorganizarFiltros($objAnuncio);
                return $objAnuncio;
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        // CASE NAO APLICADO NA CLASSE
    }

    public function put($action, $objAtual, $objNovo) {
        switch($action){
            case "altera":
                $objAnuncioApresentacao = new AnuncioApresentacao();
                $objAnuncioApresentacao = $objAnuncioApresentacao->altera($objAtual, $objNovo);
                return $objAnuncioApresentacao;
            default:
                return false;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Procedures">
    
    public function deleteProcedure($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function getProcedure($action, $obj, $xa) {
        switch($action){
            case "busca":
                $objAnuncio = new AnuncioApresentacao();
                $objAnuncio = $objAnuncio->busca($obj);
                return $objAnuncio;
            default:
                return false;
        }
        
    }

    public function postProcedure($action, $obj) {
        // CASE NAO APLICADO NA CLASSE
    }

    public function putProcedure($action, $objAtual, $objNovo) {
        switch($action){
            case "altera":
                $objAnuncioApresentacao = new AnuncioApresentacao();
                $objAnuncioApresentacao = $objAnuncioApresentacao->altera($objAtual, $objNovo);
                return $objAnuncioApresentacao;
            default:
                return false;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    // deleta da lista de anúncios comuns os anúncios que estão impulsionados
    private function reorganizarFiltros($obj){
        
        // verifica se realmente há anuncios impulsionados
        if(count($obj["impulsionados"]["objEmpresa"]) != 0 && count($obj["geral"]["objEmpresa"]) != 0){
            for($i = 0; $i < count($obj["impulsionados"]["objEmpresa"]); $i++){
                for($y = 0; $y < count($obj["geral"]["objEmpresa"]); $y++){
                    // verifica se o anuncio já não foi removido no loop de baixo
                    if(!isset($obj["geral"]["objEmpresa"][$y])){
                        continue;
                    }
                    // se existir um anuncio impulsionado na lista de anuncios comuns, o remove
                    if($obj["geral"]["objEmpresa"][$y]->getIdEmpresa() == $obj["impulsionados"]["objEmpresa"][$i]->getIdEmpresa()){
                        unset($obj["geral"]["objEmpresa"][$y]);
                        unset($obj["geral"]["objInfo"][$y]);
                        unset($obj["geral"]["objHorarios"][$y]);
                        unset($obj["geral"]["objApresentacao"][$y]);
                        unset($obj["geral"]["objImagem"][$y]);
                    }
                }
            }
    
            // reorganiza os arrays
            $obj["geral"]["objEmpresa"] = array_values($obj["geral"]["objEmpresa"]);
            $obj["geral"]["objInfo"] = array_values($obj["geral"]["objInfo"]);
            $obj["geral"]["objHorarios"] = array_values($obj["geral"]["objHorarios"]);
            $obj["geral"]["objApresentacao"] = array_values($obj["geral"]["objApresentacao"]);
            $obj["geral"]["objImagem"] = array_values($obj["geral"]["objImagem"]);
        }
        
        return $obj;
    }
    
    private function filtrarImpulsionado($filtro){

        // # ------------ Filtrar pesquisa
        $sqlPesquisa = "";
        if(isset($filtro["Pesquisa"])){
            $fPesquisa = $filtro["Pesquisa"];
            // inicia a string sql
            $sqlPesquisa = "
                 AND (
                NomeExibicao LIKE '%".$fPesquisa."%'
                OR
                DescricaoCurta LIKE '%".$fPesquisa."%'
                OR
                DescricaoLonga LIKE '%".$fPesquisa."%'
                    )
            ";
        }
        
        // # ------------ Filtrar categorias
        $sqlCategoria = "";
        if(isset($filtro["C"])){
            $todos = false;
            // separa categorias por %
            $fCategoria = explode("%", $filtro["C"]);
            
            // se for menor que 1 seleciona todos naturalmente
            if(count($fCategoria >= 1)){
                // inicia a string sql
                $sqlCategoria = " AND e.TipoNegocio IN (";
                // para cada categoria encontrada
                for($i = 1; $i < count($fCategoria); $i++){
                    if($fCategoria[$i] == "Todos"){
                        $todos = true;
                        break;
                    }
                    // 'nome', 
                    $sqlCategoria .= " '".$fCategoria[$i]."', ";
                }
                // retira a ultima virgula da string
                $sqlCategoria = substr($sqlCategoria, 0, strlen($sqlCategoria)-2);
                // fecha e termina a string
                $sqlCategoria .= " ) ";
                
                // cancela sqlcategoria se filtro for todos
                if($todos){
                    $sqlCategoria = "";
                }
            }
        }
        
        $sql = "
            # ------------ Estrutura basica do SELECT
            SELECT
                    *
                FROM
                
                # ------------ Tabelas basicas a serem chamadas
                    Empresa e
                        JOIN AnuncioApresentacao AS aa
                            ON e.IdEmpresa = aa.IdEmpresa
                        JOIN AnuncioHorarios AS ah
                            ON e.IdEmpresa = ah.IdEmpresa
                        JOIN AnuncioImagem AS ai
                            ON e.IdEmpresa = ai.IdEmpresa
                        JOIN AnuncioInfo as ain
                            ON e.IdEmpresa = ain.IdEmpresa
                                
                # ------------ Tabelas adicionais
                        JOIN AnuncioImpulsionado aim
                            ON e.IdEmpresa = aim.IdEmpresa AND aim.Status = 'A' AND DATE(aim.DataDuracao) = CURDATE()

                # ------------ Condições básicas
                WHERE
                    #somente empresas com status ativo
                    e.Status = 'A'
                    #somente empresas que estão anunciando
                    AND e.Anunciando = 1
                    #a empresa deve possuir ao menos uma imagem principal
                    AND ai.Principal = 1
                    
                    # ------------ Condições adicionais
                    ".
                    $sqlCategoria
                    .$sqlPesquisa
                    ."

                # ------------ Ordenagem
                #embaralha as empresas
                ORDER BY e.IdEmpresa DESC;";
        
        // filtra o que deverá ser carregado no banco para a model
        $opcoesCarregaDados = [1, 0, 0, 1, 1, 1, 0, 1];
        
        $obj = ["opcoes"=>$opcoesCarregaDados, "sql"=>$sql];

        return $obj;
    }
    
    private function filtrarGeral($filtro){
        
        // # ------------ Filtrar pesquisa
        $sqlPesquisa = "";
        if(isset($filtro["Pesquisa"])){
            $fPesquisa = $filtro["Pesquisa"];
            // inicia a string sql
            $sqlPesquisa = "
                 AND (
                NomeExibicao LIKE '%".$fPesquisa."%'
                OR
                DescricaoCurta LIKE '%".$fPesquisa."%'
                OR
                DescricaoLonga LIKE '%".$fPesquisa."%'
                    )
            ";
        }
        
        // # ------------ Filtrar categoria
        $sqlCategoria = "";
        if(isset($filtro["C"])){
            $todos = false;
            // separa categorias por %
            $fCategoria = explode("%", $filtro["C"]);
            
            // se for menor que 1 seleciona todos naturalmente
            if(count($fCategoria > 1)){
                // inicia a string sql
                $sqlCategoria = " AND e.TipoNegocio IN (";
                // para cada categoria encontrada
                for($i = 1; $i < count($fCategoria); $i++){
                    // se achar todos, cancela filtro de categoria e recomenda tudo
                    if($fCategoria[$i] == "Todos"){
                        $todos = true;
                        break;
                    }
                    // 'nome', 
                    $sqlCategoria .= " '".$fCategoria[$i]."', ";
                }
                // retira a ultima virgula da string
                $sqlCategoria = substr($sqlCategoria, 0, strlen($sqlCategoria)-2);
                // fecha e termina a string
                $sqlCategoria .= " ) ";
                
                // cancela sqlcategoria se filtro for todos
                if($todos){
                    $sqlCategoria = "";
                }
            }
        }
        
        # ------------ Filtrar avaliações
        if(isset($filtro["A"])){
            for($i = 0; $i < count($filtro["A"]); $i++){
                // avaliações
            }
            
            //Entregas a domicílio
        }
        
        # ------------ Filtrar opções
        $sqlOpcoes = "";
        if(isset($filtro["O"])){
            $fOpcoes = explode("%", $filtro["O"]);
            if(count($fCategoria > 1)){
                $sqlOpcoes = " AND ";
                for($i = 1; $i < count($fOpcoes); $i++){
                    
                    // transforma o label em string do banco
                    switch($fOpcoes[$i]){
                        case "Entregas a domicílio":
                            $sqlOpcoes .= " ain.EntregaDomicilio = 1 ";
                            break;
                        case "Atende-se no local": 
                            $sqlOpcoes .= " ain.AtendeLocal = 1 ";
                            break;
                        case "Com estacionamento": 
                            $sqlOpcoes .= " ain.Estacionamento = 1 ";
                            break;
                    }
                }
            }
        }
        
        # ------------ Filtrar informações
        $sqlInformacoesTabela = "";
        $sqlInformacoes = "";
        if(isset($filtro["I"])){
            $fInfo= explode("%", $filtro["I"]);
            if(count($fCategoria > 1)){
                
                $endereco = false;
                for($i = 1; $i < count($fInfo); $i++){
                    
                    // transforma o label em string do banco
                    // dependendo, acrescenta a tabela necessária
                    if(($fInfo[$i] == "Endeços disponíveis" || "Telefones disponíveis") && !$endereco){
                        $sqlInformacoesTabela .= " JOIN AnuncioEndereco as ae ON e.IdEmpresa = ae.IdEmpresa ";
                        $endereco = true;
                        
                        switch($fInfo[$i]){
                            case "Endeços disponíveis":
                                $sqlInformacoes .= " AND LENGTH(ae.Cep) > 1 ";
                                break;
                            case "Telefones disponíveis":
                                $sqlInformacoes .= " AND (LENGTH(ae.Telefone1) > 1 OR LENGTH(ae.Celular1) > 1) ";
                                break;
                        }
                    }
                    if($fInfo[$i] == "Mapa disponível"){
                        $sqlInformacoesTabela .= " JOIN AnuncioMaps AS amaps ON e.IdEmpresa = amaps.IdEmpresa ";
                    }
                    if($fInfo[$i] == "Facebook disponível"){
                        $sqlInformacoesTabela .= " JOIN AnuncioFacebook AS af ON e.IdEmpresa = af.IdEmpresa ";
                    }
                }
            }
        }
        
        # ------------ Filtrar horarios
        $sqlHorarios = "";
        if(isset($filtro["F"])){
            $fHorarios= explode("%", $filtro["F"]);
            if(count($fHorarios > 1)){
                for($i = 1; $i < count($fHorarios); $i++){
                    
                    // verifica os dias que o usuário marcou
                    switch($fHorarios[$i]){
                        case "Segunda-feira": $sqlHorarios.= " AND LENGTH(ah.SegundaDas) > 1 "; break;
                        case "Terça-feira": $sqlHorarios.= " AND LENGTH(ah.TercaDas) > 1 "; break;
                        case "Quarta-feira": $sqlHorarios.= " AND LENGTH(ah.QuartaDas) > 1 "; break;
                        case "Quinta-feira": $sqlHorarios.= " AND LENGTH(ah.QuintaDas) > 1 "; break;
                        case "Sexta-feira": $sqlHorarios.= " AND LENGTH(ah.SextaDas) > 1 "; break;
                        case "Sábado": $sqlHorarios.= " AND LENGTH(ah.SabadoDas) > 1 "; break;
                        case "Domingo": $sqlHorarios.= " AND LENGTH(ah.DomingoDas) > 1 "; break;
                    }
                    
                    // se está aberto agora ou não é verificado na classe php com a função isOpen
                }
            }
        }
        
        $sql = "
            # ------------ Estrutura basica do SELECT
            SELECT
                    *
                FROM
                
                # ------------ Tabelas basicas a serem chamadas
                    Empresa e
                        JOIN AnuncioApresentacao AS aa
                            ON e.IdEmpresa = aa.IdEmpresa
                        JOIN AnuncioHorarios AS ah
                            ON e.IdEmpresa = ah.IdEmpresa
                        JOIN AnuncioImagem AS ai
                            ON e.IdEmpresa = ai.IdEmpresa
                        JOIN AnuncioInfo as ain
                            ON e.IdEmpresa = ain.IdEmpresa
                                
                # ------------ Tabelas adicionais
                        #LEFT JOIN AnuncioImpulsionado aim
                            #ON e.IdEmpresa = aim.IdEmpresa AND aim.Status IS NOT = 'A'
                
                        ".
                        $sqlInformacoesTabela
                        ."

                # ------------ Condições básicas
                WHERE
                    #somente empresas com status ativo
                    e.Status = 'A'
                    #somente empresas que estão anunciando
                    AND e.Anunciando = 1
                    #a empresa deve possuir ao menos uma imagem principal
                    AND ai.Principal = 1
                    
                    # ------------ Condições adicionais
                    ".
                    $sqlCategoria
                    .$sqlOpcoes
                    .$sqlInformacoes
                    .$sqlHorarios
                    .$sqlPesquisa
                    ."

                # ------------ Ordenagem
                #embaralha as empresas
                ORDER BY e.IdEmpresa DESC;";
        
        // filtra o que deverá ser carregado no banco para a model
        $opcoesCarregaDados = [1, (strlen($sqlInformacoesTabela)>1?1:0), 0, 1, 1, 1, 0, 1];
        
        $obj = ["opcoes"=>$opcoesCarregaDados, "sql"=>$sql];

        return $obj;
        echo $sql;
        die;    
        return false;
    }
    
    private function buscaFiltroSimples($obj){
        $aux = "";
        
        $obj = strtolower($obj);
        switch($obj){
            case "todos":
                break;
            case "pizzarias":
                $aux = " AND e.TipoNegocio = 'Pizzaria' ";
                break;
            case "lanchonetes":
                $aux = " AND e.TipoNegocio = 'Lanchonete' ";
                break;
            case "salgadarias":
                $aux = " AND e.TipoNegocio = 'Salgadaria' ";
                break;
            case "frios":
                $aux = " AND e.TipoNegocio = 'Frios' ";
                break;
            case "drinks":
                $aux = " AND e.TipoNegocio = 'Drinks' ";
                break;
            case "festas":
                $aux = " AND e.TipoNegocio = 'Festa' ";
                break;
            case "recomendados":
                $aux = " AND e.IdPlano > 0 ";
                break;
            case "maisavaliados":
                break;
            case "maiscomentados":
                break;
            default:
                return;
        }
        
        $sql = " 
        
            SELECT *
            FROM Anuncio a
            INNER JOIN AnuncioApresentacao ap
            INNER JOIN AnuncioContato ac
            INNER JOIN AnuncioEndereco ae
            INNER JOIN AnuncioInfo ai
            INNER JOIN AnuncioIntegracao ain
            INNER JOIN Empresa e
            ON a.IdAnuncio = ap.IdAnuncio
            AND a.IdAnuncio = ac.IdAnuncio
            AND a.IdAnuncio = ae.IdAnuncio
            AND a.IdAnuncio = ai.IdAnuncio
            AND a.IdAnuncio = ain.IdAnuncio
            AND a.IdAnuncio = e.IdAnuncio

        ";
        
        $sql.= $aux;
        $sql.= ";";
        
        $objAnuncio = new Anuncio();
        $objAnuncio = $objAnuncio->buscaFiltro($sql);  
        
        return $objAnuncio;
    }
    
    private function buscaFiltro($obj){

        $obj = explode(",", $obj);
        
        $categoria = array();
        $avalicaoes = array();
        $info = array();
        $horarios = array();
        
        foreach($obj as $item){
            if(strpos($item, "categoria") !== false){
                $aux = $item;
                $aux = str_replace("categoria=", "", $aux);
                $categoria[] = $aux;
            }
            if(strpos($item, "avaliacoes") !== false){
                $aux = $item;
                $aux = str_replace("avaliacoes=", "", $aux);
                $avaliacoes[] = $aux;
            }
            if(strpos($item, "info") !== false){
                $aux = $item;
                $aux = str_replace("info=", "", $aux);
                $info[] = $aux;
            }
            if(strpos($item, "horarios") !== false){
                $aux = $item;
                $aux = str_replace("horarios=", "", $aux);
                $horarios[] = $aux;
            }
        }
        
        $sql = " 
        
            SELECT *
            FROM Anuncio a
            INNER JOIN AnuncioApresentacao ap
            INNER JOIN AnuncioContato ac
            INNER JOIN AnuncioEndereco ae
            INNER JOIN AnuncioInfo ai
            INNER JOIN AnuncioIntegracao ain
            INNER JOIN Empresa e
            ON a.IdAnuncio = ap.IdAnuncio
            AND a.IdAnuncio = ac.IdAnuncio
            AND a.IdAnuncio = ae.IdAnuncio
            AND a.IdAnuncio = ai.IdAnuncio
            AND a.IdAnuncio = ain.IdAnuncio
            AND a.IdAnuncio = e.IdAnuncio

        ";
        
        // filtro de categorias
        if(count($categoria) == 1){
            $sql .= "AND e.TipoNegocio = '$categoria[0]'";
        }
        if(count($categoria) > 1){
            $sql .= " AND (";
            foreach($categoria as $item){
                $sql .= "e.TipoNegocio = '$item'";
                if(next($categoria)){
                    $sql.= " OR ";
                }
            }
            $sql .= ") ";
        }
        
        // filtro de avaliações
        
        // filtro de info
        if(count($info) >= 1){
            $sql .= " AND ";
            if(count($info) > 1){
                $sql.=" (";
            }
            foreach($info as $item){
                switch ($item){
                    case "entregas":
                        $sql .= "ai.EntregaDomicilio = 1";
                        break;
                    case "atende":
                        $sql .= "ai.AtendeLocal = 1";
                        break;
                    case "endereco":
                        $sql .= "e.Rua IS NOT NULL";
                        break;
                    case "telefone":
                        $sql .= "(ac.Telefone1 IS NOT NULL OR ac.Celular1 IS NOT NULL)";
                        break;
                    case "email":
                        $sql .= "ac.Email1 IS NOT NULL";
                        break;
                    case "mapa":
                        $sql .= "ain.GoogleMaps IS NOT NULL";
                        break;
                    case "facebook":
                        $sql .= "ain.FacebookPagina IS NOT NULL";
                        break;
                }
                
                if(next($info)){
                    $sql.= " AND ";
                }
            }
            if(count($info) > 1){
                $sql.=") ";
            }
        }
        
        // filtro de horarios
        
        // filtro outros
        /*
        switch($outros){
            case "recentes":
                $sql .= "ORDER BY e.DataCadastro DESC";
                break;
            case "antigos":
                $sql .= "ORDER BY e.DataCadastro ASC";
                break;
        }
        */
        
        
        $sql .= ";";

        $objAnuncio = new Anuncio();
        $objAnuncio = $objAnuncio->buscaFiltro($sql);    
        return $objAnuncio;
    }
    
    private function montaListaAlbum($obj){
        $img = explode("-", $obj);
        array_pop($img);
        return $img;
    }
    
    private function buscaHome($obj){
        
    }
    
    private function tirarAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">
    
    public static function criaObj($IdEmpresa, $NomeExibicao, $DescricaoCurta, $DescricaoLonga){
        $objApresentacao = new AnuncioApresentacao();
        $objApresentacao->setIdEmpresa($IdEmpresa);
        $objApresentacao->setNomeExibicao($NomeExibicao);
        $objApresentacao->setDescricaoCurta($DescricaoCurta);
        $objApresentacao->setDescricaoLonga($DescricaoLonga);
        
        return $objApresentacao;
    }

    // </editor-fold>

}
