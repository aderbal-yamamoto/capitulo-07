<?php
namespace Livro\Widgets\Form;
use Livro\Widgets\Base\Element;

class RadioGroup extends Field implements FormElementInterface
{
    private $layout = 'verical';
    private $items;

    public function setLayout($dir){
        $this->layout = $dir;
    }
    public function addItems($items) {
        $this->items = $items;
    }
    public function show(){
        if($this->items) {
            // percorre cada uma das opções do radio
            foreach ($$this->items as $index => $label) {
                $button = new RadioButton($this->name);
                $button->setValue($index);
                // se o indice coincide
                if ($this->value == $index){
                    // marca o radio button
                    $button->setProperty('checked', '1');
                }
                
                $obj = new label($label);
                $obj->add($button);
                $obj->show();
                if ($this->layout == 'vertical') {
                    // exibi uma quebra de linha 
                    $br = new Element('br');
                    $br->show();
                }
                echo "\n";
            

            }  
        }
    }
}
