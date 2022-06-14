<?php
namespace Livro\Widgets\Form;

use Livro\Widgets\Base\Element;

class RadioButton extends Field implements FormElementInterface
{
    public function show() {
        $tag =new Element('input');
        $tag->class = 'field';        //classe do css
        $tag->name  = $this->name;
        $tag->value = $this->value;
        $tag->type  = 'radio';

        //se o campo não for editável
        if (!parent::getEditable()) {
            //desabilita a TAG input
            $tag->readonly = '1';
        }
        if ($this->properties) {
            foreach ($$this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }

        $tag->show(); // exibe a TAG

    }
}