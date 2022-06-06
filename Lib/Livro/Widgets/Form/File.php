<?php
namespace Livro\Widgets\Form;
use Livro\Widgets\Base\Element;

class File extends Field implements FormElementInterface {
    public function show(){
        // atribui as propriedades da TAG
        $tag = new Element('input');
        $tag->class = 'field';
        $tag->name = $this->name;  // nome da TAG
        $tag->value = $this->value; // valor da TAG
        $tag->type = 'file'; //tipo da TAG
        $tag->style = "width:{$this->size}"; //tamanho em pixel

        //se o campo não é editável
        if (!parent::getEditable()) {
            $tag->readonly = "1"; //desabilita a Tag de input
        }
        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->property = $value;
            }
        }
        $tag->show(); // exibe a TAG
    } 
}