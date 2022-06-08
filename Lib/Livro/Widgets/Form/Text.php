<?php
namespace Livro\Widgets\Form;
use Livro\Widgets\Base\Element;

class Text extends FIeld implements FormElementInterface
{
    private $width;
    private $height = 100;

    public function setSize($whidth, $height = NULL)
    {
        $this->size = $whidth;
        if (isset($height)) {
            $this->height = $height;
        }
    }
    public function show(){
        $tag = new Element('textarea');
        $tag->class = 'field';      // classe css
        $tag->name = $this->name;   // nome da tag
        $tag->style = "width:{$this->size};height:{$this->height}"; // tamanho em pixels
        // se o campo não é editável
        if (!parent::getEditable()) {
            // desabilita a tag input
            $tag->readonly = "1";
        }
        $tag->add(htmlspecialchars($this->value)); // adiciona conteúdo ao textarea 
       
        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->property = $value;
            }
        }
        $tag->show(); // exibe a TAG
    }
}
