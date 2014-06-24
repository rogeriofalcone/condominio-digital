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
                        1 => 'Manutenção',
                        2 => 'Me sinto Prejudicado (a)',
                        3 => 'Limpeza',
                        4 => 'Financeiro',
                        5 => 'Segurança',
                        6 => 'Outros',
                    ),
                    'label' => 'Tipo da Reclamação',
                    'data' => 1
                ))
                ->add('descricao', 'textarea', array('attr' => array('rows' => '10','class' => 'form-control','placeholder' => 'Preencher todo o seu problema,coloque todas as informações.',),
                    'label' => 'Descrição'
                ))
                ->add('files', 'file', array('label' => 'Imagem','required' => FALSE,"attr" => array("accept" => "image/*","multiple"=>"multiple")))
                ->add('Salvar', 'submit', array('label' =>"Salvar Ocorrência",'attr' => array('class' => 'btn btn-primary separar')));
    }

    public function getName() {
        return 'reclamacao';
    }
}
