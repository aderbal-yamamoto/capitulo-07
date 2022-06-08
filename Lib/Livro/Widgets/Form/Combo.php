<?php
namespace Livro\Widgets\Form;
use Livro\Widgets\Base\Element;

class Combo extends field implements FormElementInterface
{
    private $items; // array contendo os itens do combo
    protected $properties;

    public function addItems($items) {
        $this->items = $items;
    }
    public function show() {
        $tag = new Element('select');
        $tag->class ='combo';
        $tag->name = $this->name;
        $tag->style = "width:{$this->size}"; // Tamanho em pixels
        
        // cria uma TAG <option> com um valor padrão
        $option = new Element('option');
        $option->add('');
        $option->value = '0'; //Valor da TAG

        // adciona a opção combo
        $tag->add($option);
        if ($this->items) {
            //percore os itens adicionados
            foreach ($this->items as $chave => $item) {
                // cria uma TAG <option> para o item 
                $option = new Element('option');
                $option->value = $chave; // define o item da opção
                $option->add($item); // adciona o texto da opção

                // caso seja a opção selecionada
                if ($chave == $this->value) {
                    // seleciona o item da combo
                    $option->selected =1;
                }
                //adiciona a opção a combo
                $tag->add($option);
            }
        }
        // verifica se o campo é editável 
        if (!parent::getEditable()) {
            // desabilita a TAG imput
            $tag->readonly = "1";
        }
        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }
        $tag->show(); // exibe a combo

    }
}
