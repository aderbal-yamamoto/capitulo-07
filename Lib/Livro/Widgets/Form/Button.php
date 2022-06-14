<?php
namespace Livro\Widgets\Form;
use Livro\Control\Action;
use Livro\Control\ActionInterface;
use Livro\widgets\Base\Element;

class Button extends Field  implements FormElementInterface
{
        private $action;
        private $label;
        private $formName;

        public function setAction(Actioninterface $action, $label){
            $this->action = $action;
            $this->label = $label;
        }
        public function setFormName($name){
            $this->formName = $name;
        }
        public function show(){
            $url = $this->action->serialize();
            //define as propriedades do botão
            $tag = new Element('button');
            $tag->name = $this->name;
            $tag->type = 'button'; // tipo de input
            $tag->add($this->label);
            //define a ação do botão
            $tag->onclick = "document.{$this->formName}.action='{$url}';".
                                        "document.{$this->formName}.submit()";
            if ($this->properties) {
                foreach ($this->properties as $property => $value){
                    $tag->$property = $value;   
                }
            }
            $tag->show(); //exibe o botão
        }        
}