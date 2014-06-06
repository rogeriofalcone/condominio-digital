<?php

/* layout.html.twig */
class __TwigTemplate_058aff29272bae10e2774d8cd2f89cc2ac8113712887785375632ab54c0942c5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'secondaryNavigation' => array($this, 'block_secondaryNavigation'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Administração de Condomínio"), "html", null, true);
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
    <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/bootstrap.css\" rel=\"stylesheet\" media=\"screen\">
    <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/theme.min.css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/main.css\" rel=\"stylesheet\" type='text/css'>
</head>
<body role=\"document\">
    ";
        // line 12
        $context["active"] = ((array_key_exists("active", $context)) ? (_twig_default_filter((isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")), null)) : (null));
        // line 13
        echo "    <div class=\"navbar navbar-fixed-top navbar-inverse\">
        <div class=\"navbar-inner\">
            <ul  class=\"nav navbar-nav\">
                <li ";
        // line 16
        if (("homepage" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\"><i class=\"icon-home\"></i>  ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Principal"), "html", null, true);
        echo "</a></li>
                
                ";
        // line 18
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 19
            echo "                    <li ";
            if (("homepage" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("homepage");
            echo "\"><i class=\"icon-dashboard\"></i>  ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Administration"), "html", null, true);
            echo "</a></li>
                    <li ";
            // line 20
            if (("morador" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("admin_morador");
            echo "\"><i class=\"icon-user\"></i>  ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Morador"), "html", null, true);
            echo "</a></li>                
                ";
        }
        // line 21
        echo "    
             
            </ul>
            <ul class=\"nav pull-right\">
                ";
        // line 25
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 26
            echo "                    <li ";
            if (("me" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("me");
            echo "\"><i class=\"icon-user\"></i>Meus Dados</a></li>
                    <li><a href=\"";
            // line 27
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\"><i class=\"icon-lock\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Sair"), "html", null, true);
            echo "</a></li>
                ";
        } else {
            // line 29
            echo "                    <li ";
            if (("login" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\"><i class=\"icon-upload\"></i> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Entrar"), "html", null, true);
            echo "</a></li>
                ";
        }
        // line 30
        echo "                    
            </ul>
        </div>
    </div>

    ";
        // line 35
        $this->displayBlock('secondaryNavigation', $context, $blocks);
        // line 37
        echo "        <div class=\"container\">
            ";
        // line 38
        $this->displayBlock('content', $context, $blocks);
        // line 41
        echo "
    <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/jquery.js\"></script>
    <script src=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/main.js\"></script>
    <script src=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap.min.js\"></script>
    <script type=\"text/javascript\" src=\"http://platform.twitter.com/widgets.js\"></script>
    <script src=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-transition.js\"></script>
    <script src=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-alert.js\"></script>
    <script src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-modal.js\"></script>
    <script src=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-dropdown.js\"></script>
    <script src=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-scrollspy.js\"></script>
    <script src=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-tab.js\"></script>
    <script src=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-tooltip.js\"></script>
    <script src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-popover.js\"></script>
    <script src=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-button.js\"></script>
    <script src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-collapse.js\"></script>
    <script src=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-carousel.js\"></script>
    <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-typeahead.js\"></script>
    <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-affix.js\"></script>
    <script src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/holder/holder.js\"></script>
    <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/google-code-prettify/prettify.js\"></script>
</body>
</html>
";
    }

    // line 35
    public function block_secondaryNavigation($context, array $blocks = array())
    {
        // line 36
        echo "    ";
    }

    // line 38
    public function block_content($context, array $blocks = array())
    {
        // line 39
        echo "        </div>
    ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 39,  225 => 38,  221 => 36,  218 => 35,  210 => 60,  206 => 59,  202 => 58,  198 => 57,  194 => 56,  190 => 55,  186 => 54,  182 => 53,  178 => 52,  174 => 51,  170 => 50,  166 => 49,  162 => 48,  158 => 47,  154 => 46,  149 => 44,  145 => 43,  141 => 42,  138 => 41,  136 => 38,  133 => 37,  131 => 35,  124 => 30,  112 => 29,  105 => 27,  96 => 26,  94 => 25,  88 => 21,  77 => 20,  66 => 19,  64 => 18,  53 => 16,  48 => 13,  46 => 12,  40 => 9,  36 => 8,  32 => 7,  26 => 4,  21 => 1,);
    }
}
