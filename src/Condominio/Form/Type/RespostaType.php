<?php

namespace Condominio\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RespostaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idr', 'hidden')
                ->add('ide', 'hidden')
                ->add('iduser', 'hidden')
                ->add('resposta', 'textarea', array(
                    'attr' => array(
                        'rows' => '10',
                        'class' => 'form-control',
                        'style'=>'width:100%',
                        'placeholder' => 'Descrição da resposta',
                    ),                   
                    'label' => 'Reposta',
                ))
                ->add('Salvar', 'submit', array('label' => "Salvar informação", 'attr' => array('class' => 'btn btn-primary separar','style'=>'margin-top:20px')));
    }

    public function getName() {
        return 'resp';
    }

}
