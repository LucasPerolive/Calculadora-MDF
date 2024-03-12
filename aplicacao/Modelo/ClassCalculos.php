<?php
class Calculadora {    
    public function QuantidadeChapasMDF($altura, $comprimento, $profundidade){
        return ceil(((($altura * $profundidade) + ($altura * $comprimento ) + ($comprimento * $profundidade)) * 2)/5.03);
    }

    public function QuantidadeDobradicas($quantidade_portas){
        return ($quantidade_portas * 2);
    }

    public function QuantidadeCorredicas($quantidade_gavetas){
        return ($quantidade_gavetas * 2);
    }

    public function QuantidadePuxadores($quantidade_gavetas, $quantidade_portas){
        return ($quantidade_gavetas + $quantidade_portas);
    }

    public function QuantidadeParafusos($quantidade_chapas){
        return ($quantidade_chapas * 50);
    }

    public function QuantidadeRoloFitas(){
        return 1;
    }
}