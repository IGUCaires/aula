<?php

class Bot
{
    private $nome = 'Chatbot Belezinha';

    public function getNome()
    {
        return $this->nome;
    }

    private function mostraAjuda($dados)
    {
        $retorno = null;
        foreach ($dados as $chave => $valor) {
            if ($chave != 'ajuda') {
                $retorno .= $chave . PHP_EOL;
            }
        }
        return $retorno;
    }

    # Método para ler o cabeçalho da requisições
    public function hears($message, callable $call)
    {
        $call(new Bot()); # instanciando a própria classe (stack)
        return $message;
    }

    # Escreve na interface HTML
    public function reply($response)
    {
        print($response . '<br>');
    }

    public function procurarPergunta($valor, $listaPerguntasRespostas)
    {
        $valor = trim($valor); # remover espaços em branco no início e no fim
        foreach ($listaPerguntasRespostas as $pergunta => $resposta){
            if ($valor == $pergunta){
                if(gettype($resposta) == 'array'){
                    return $this->mostraAjuda($listaPerguntasRespostas) .
                        $this->mostraAjuda($resposta);
                }else{
                    return $resposta;
                }
            }
        }
    }
}