<?php

namespace Condominio\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class EmpreendimentoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idu', 'hidden')
                ->add('nomecons', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Nome da Construtora',
                    ),                   
                    'label' => 'Nome da Construtora',
                ))
                ->add('nome', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Nome do condomínio',
                    ),                   
                    'label' => 'Nome do Condomínio',
                ))
                ->add('rua',  'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Rua x número 10',
                    ),
                    'label' => 'Logradouro',
                    'required' => FALSE,
                ))
                ->add('bairro', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Centro',
                    ),
                    'label' => 'Bairro',
                    'required' => FALSE,
                ))
                ->add('uf', 'choice', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'choices' => array(
                        "AC"=> "Acre",
                        "AL"=> "Alagoas",
                        "AM"=> "Amazonas",
                        "AP"=> "Amapá",
                        "BA"=> "Bahia",
                        "CE"=> "Ceará",
                        "DF"=> "Distrito Federal",
                        "ES"=> "Espirito Santo",
                        "GO"=> "Goiás",
                        "MA"=> "Maranhão",
                        "MG"=> "Minas Gerais",
                        "MS"=> "Mato Grosso do Sul",
                        "MT"=> "Mato Grosso",
                        "PA"=> "Pará",
                        "PB"=> "Paraíba",
                        "PE"=> "Pernambuco",
                        "PI"=> "Piauí",
                        "PR"=> "Paraná",
                        "RJ"=> "Rio de Janeiro",
                        "RN"=> "Rio Grande do Norte",
                        "RO"=> "Rondônia",
                        "RR"=> "Roraima",
                        "RS"=> "Rio Grande do Sul",
                        "SC"=> "Santa Catarina",
                        "SE"=> "Sergipe",
                        "SP"=> "São Paulo",
                        "TO"=> "Tocantins",
                    ),
                    'label' => 'Estado',
                    'data' => 'RJ',
                    'required' => true,
                ))
                ->add('cidade', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Rio de Janeiro',
                    ),
                    'required' => FALSE,
                    'label' => 'Cidade'
                ))
                ->add('Salvar', 'submit', array('label' => "Salvar informação", 'attr' => array('class' => 'btn btn-primary separar','style'=>'margin-top:20px')));
    }

    public function getName() {
        return 'emp';
    }

}
