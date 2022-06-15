<?php
use Livro\Control\Page;
use Livro\Control\Action;
use Livro\Widgets\Form\Form;
use Livro\Widgets\Dialog\Message;
use Livro\Widgets\Form\Label;
use Livro\Widgets\Form\Entry;
use Livro\Widgets\Form\Combo;
use Livro\Widgets\Form\Text;
use Livro\Widgets\Wrapper\FormWrapper;

class ContatoForm extends Page 
{
    private $form;

    function __construct()
    {
        parent::__construct();
        
        // instancia um formulário
        $this->form = new FormWrapper(new Form('form_contato'));
        $this->form->setTitle('formulario de contato');

        // cria o campo dos formulários 
        $nome     = new Entry ('nome');
        $email    = new Entry ('email');
        $assunto  = new Combo ('assunto');
        $mensagem = new Text ('mensagem');

        $this->form->addField('Nome', $nome, 300 );
        $this->form->addField('Email', $email, 300);
        $this->form->addField('Assunto', $assunto, 300);
        $this->form->addField('Mensagem', $mensagem, 300);

        // define alguns atributos
        $assunto->addItems(array('1' => 'Sugestão',
                                 '2' => 'Reclamação',
                                 '3' => 'Suporte Técnico',
                                 '4' => 'Cobrança',
                                 '5' => 'Outro') );
        $mensagem->setSize(300, 80);

        $this->form->addAction('Enviar', new Action(array($this, 'onSend')));
        
        // adiciona o formulario a pagina
        parent::add($this->form);
    }
    function onSend()
    {
        try {
            // obtem os dados
            $dados = $this->form->getDadta();

            // mantem os dados preenchidos
            $this->form->setData($dados);

            // valida
            if (empty($dados->email)) {
                throw new Exception("Email vazio");
                
            }
            if (empty($dados->assunto)) {
                throw new Exception("assunto vazio");
                
            }
            // monta a mensagem
            $mensagem = "nome: {$dados->nome} <br>";
            $mensagem .= "Email: {$dados->email} <br>";
            $mensagem .= "Assunto: {$dados->assunto} <br>";
            $mensagem .= "Mensagem: {$dados->mensagem} <br>";
            new Message('info', $mensagem);
          
        
        } catch (Exception $e) {
            new message('error', $e->getMessage());
        }
    }
}