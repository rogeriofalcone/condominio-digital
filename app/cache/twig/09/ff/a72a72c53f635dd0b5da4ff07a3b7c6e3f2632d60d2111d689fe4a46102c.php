<?php

/* admin_layout.html.twig */
class __TwigTemplate_09ffa72a72c53f635dd0b5da4ff07a3b7c6e3f2632d60d2111d689fe4a46102c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'secondaryNavigation' => array($this, 'block_secondaryNavigation'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_secondaryNavigation($context, array $blocks = array())
    {
        // line 4
        echo "     <div class=\"container\">
        <ul class=\"nav nav-tabs\">
            <li ";
        // line 6
        if (("admin_morador" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"/admin/morador\">Listar</a></li>
            <li ";
        // line 7
        if (("admin_morador_email" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"/admin/morador/email\">Email</a></li>
          </ul>

    </div> 
";
    }

    public function getTemplateName()
    {
        return "admin_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 7,  35 => 6,  102 => 31,  100 => 30,  97 => 29,  88 => 26,  84 => 25,  81 => 24,  77 => 23,  65 => 13,  59 => 12,  50 => 9,  44 => 7,  39 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
