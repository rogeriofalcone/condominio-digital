<?php

namespace Condominio\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ReclamacaoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('id', 'hidden')
                ->add('idcond', 'hidden')
                ->add('idu', 'hidden')
                ->add('titulo', 'text', array('attr' => array('class' => 'form-control','placeholder' => 'Título da reclamação',),'label' => 'Título'))
                ->add('idassunto', 'choice', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'choices' => array(
                        1 => 'Atraso no empreendimento',
                        2 => 'Me sinto Prejudicado (a)',
                        3 => 'Mau atendimento do SAC',
                        4 => 'Cobrança Indevida',
                        5 => 'Demora na devolução do meu Dinheiro',
                        6 => 'Outros',
                        7 => 'Propaganda enganosa',
                        8 => 'Elogio a empresa',
                    ),
                    'label' => 'Tipo da Reclamação',
                    'data' => 1
                ))
                ->add('descricao', 'textarea', array('attr' => array('rows' => '10','class' => 'form-control','placeholder' => 'Preencher todo o seu problema,coloque todas as informações.',),
                    'label' => 'Descrição'
                ))->add('youtube', 'text', array('attr' => array('class' => 'form-control addDiv','placeholder' => 'http://youtu.be/W1CSdYsJIWQ',),'required' => FALSE,
                    'label' => 'Copie e cole o link do youtube com seu vídeo, basta clicar em compartilhar la no youtube.'
                ))
                ->add('files', 'file', array('label' => 'Imagem','required' => FALSE,"attr" => array("accept" => "image/*","multiple"=>"multiple")))
                ->add('Salvar', 'submit', array('label' =>"Enviar reclamação",'attr' => array('class' => 'btn btn-primary separar')));
    }

    public function getName() {
        return 'reclamacao';
    }
}
