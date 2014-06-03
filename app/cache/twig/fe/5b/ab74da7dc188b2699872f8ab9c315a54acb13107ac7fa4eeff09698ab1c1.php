<?php

/* admin_morador_listar.html.twig */
class __TwigTemplate_fe5bab74da7dc188b2699872f8ab9c315a54acb13107ac7fa4eeff09698ab1c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("admin_layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "        ";
        $context["alertTypeAvaillable"] = array(0 => "info", 1 => "success", 2 => "warning", 3 => "error");
        // line 5
        echo "                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["alertTypeAvaillable"]) ? $context["alertTypeAvaillable"] : $this->getContext($context, "alertTypeAvaillable")));
        foreach ($context['_seq'] as $context["_key"] => $context["alert"]) {
            // line 6
            echo "                    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "getFlashBag"), "get", array(0 => (isset($context["alert"]) ? $context["alert"] : $this->getContext($context, "alert"))), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 7
                echo "                        <div class=\"alert alert-";
                echo twig_escape_filter($this->env, (isset($context["alert"]) ? $context["alert"] : $this->getContext($context, "alert")), "html", null, true);
                echo "\" >
                            <button class=\"close\" data-dismiss=\"alert\">×</button>
                            ";
                // line 9
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["message"]) ? $context["message"] : $this->getContext($context, "message"))), "html", null, true);
                echo "
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['alert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "            <div class=\"panel panel-default\">
                <div class=\"panel-heading\"><b>Morador</b></div>
                <div class=\"panel-body\">
                    <div class=\"col-md-5\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <tr>
                                    <td>Nome</td>
                                    <td>Email</td>
                                </tr>
                            ";
        // line 23
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["aLista"]) ? $context["aLista"] : $this->getContext($context, "aLista")));
        foreach ($context['_seq'] as $context["_key"] => $context["morador"]) {
            // line 24
            echo "                                <tr>
                                    <td>";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["morador"]) ? $context["morador"] : $this->getContext($context, "morador")), "name"), "html", null, true);
            echo "</td>
                                    <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["morador"]) ? $context["morador"] : $this->getContext($context, "morador")), "email"), "html", null, true);
            echo "</td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['morador'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "                            </table>
                        ";
        // line 30
        $this->env->loadTemplate("pagination_reclamacao.html.twig")->display($context);
        // line 31
        echo "                        </div>
                    </div>
                </div>
            </div>
";
    }

    public function getTemplateName()
    {
        return "admin_morador_listar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 31,  100 => 30,  97 => 29,  88 => 26,  84 => 25,  81 => 24,  77 => 23,  65 => 13,  59 => 12,  50 => 9,  44 => 7,  39 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
