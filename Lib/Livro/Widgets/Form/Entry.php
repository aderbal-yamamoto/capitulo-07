<?php
namespace Livro\Widgets\Form;
use Livro\Widgets\Base\Element;

class Entry extends Field implements FormElementInterface
{
    protected $properties;
    public function show(){
        //atribui as propriedades da Tag
        $tag = new Element('input');
        $tag->class = 'field';               //classe css
        $tag->name  = $this->name;           //nome da Tag
        $tag->value = $this->value;          //valor da Tag
        $tag->type  = 'text';                //tipo de entrada 
        $tag->style = "width:{$this->size}"; //tamanho em pixels
        
        //se o campo não é editavel
        if (!parent::getEditable()) {
            $tag->readonly = "1";
        }
        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }
        $tag->show(); //exibe a tag
    }
}
