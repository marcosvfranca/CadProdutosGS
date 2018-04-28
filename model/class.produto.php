<?php

include __DIR__ . '/./class.categoria.php';
include __DIR__ . '/./class.marca.php';

class produto {

    private $id;
    private $categoria;
    private $marca;
    private $descProduto;
    private $imagem;
    private $vlpreco;

    function __construct($id, $categoria = null, $marca = null, $descProduto = null, $imagem = null, $vlpreco = null) {
        $this->id = $id;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->descProduto = $descProduto;
        $this->imagem = $imagem;
        $this->vlpreco = $vlpreco;
    }

    function getId() {
        return $this->id;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getMarca() {
        return $this->marca;
    }

    function getDescProduto() {
        return $this->descProduto;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getVlpreco() {
        return $this->vlpreco;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setDescProduto($descProduto) {
        $this->descProduto = $descProduto;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setVlpreco($vlpreco) {
        $this->vlpreco = $vlpreco;
    }

}
