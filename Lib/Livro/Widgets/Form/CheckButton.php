<?php
namespace Livro\Widgets\Form;
use Livro\Widgets\Base\Element;

class CeckButton extends field implements FormElementInterface 
{
    public function show(){
        // atribui as propriedades da TAG
        $tag = new Element('input');
        $tag->class = 'field';      // classe CSS
        $tag->name  = $this->name;  // nome da tag
        $tag->value = $this->value; // value
        $tag->type  = 'checkbox';   //tipo do input
        
        // se o  campo não é editável
        if (!parent::getEditable()) {
            //desabilita a tag input
            $tag->readonly = "1";
        }
        if ($this->properties) {
            foreach ($$this->properties as $property => $value) {
                $tag->$propety = $value;
            }
        }
        $tag->show(); //exibe a TAG
    }
}