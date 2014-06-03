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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Administração Reclame Imóvel"), "html", null, true);
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
        echo "/css/main.css\" rel=\"stylesheet\" type='text/css'>
</head>
<body>
    ";
        // line 11
        $context["active"] = ((array_key_exists("active", $context)) ? (_twig_default_filter((isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")), null)) : (null));
        // line 12
        echo "    <div class=\"navbar navbar-fixed-top navbar-inverse\">
        <div class=\"navbar-inner\">
            <ul  class=\"nav navbar-nav\">
                <li ";
        // line 15
        if (("homepage" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\"><i class=\"icon-home\"></i>  ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Home"), "html", null, true);
        echo "</a></li>
                ";
        // line 16
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 17
            echo "                <li ";
            if (("homepage" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("homepage");
            echo "\"><i class=\"icon-dashboard\"></i>  ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Administration"), "html", null, true);
            echo "</a></li>
                <li ";
            // line 18
            if (("morador" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("admin_morador");
            echo "\"><i class=\"icon-user\"></i>  ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Morador"), "html", null, true);
            echo "</a></li>
                <li  class=\"dropdown\"> 
                     <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Configuração <b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                    <li><a href=\"#\">Action</a></li>
                    <li><a href=\"#\">Another action</a></li>
                    <li><a href=\"#\">Something else here</a></li>
                    <li class=\"divider\"></li>
                    <li><a href=\"#\">Separated link</a></li>
                    <li class=\"divider\"></li>
                    <li><a href=\"#\">One more separated link</a></li>
                  </ul>
                </li>
                ";
        }
        // line 31
        echo "                
            </ul>
            <ul class=\"nav pull-right\">
                ";
        // line 34
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 35
            echo "                    <li ";
            if (("me" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("me");
            echo "\"><i class=\"icon-user\"></i> My Profile</a></li>
                    <li><a href=\"";
            // line 36
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Logout"), "html", null, true);
            echo "</a></li>
                ";
        } else {
            // line 38
            echo "                    <li ";
            if (("login" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\"><i class=\"icon-user\"></i> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Login"), "html", null, true);
            echo "</a></li>
                ";
        }
        // line 40
        echo "            </ul>
        </div>
    </div>
    <div id=\"front_header\">";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Administração Reclame Imóvel"), "html", null, true);
        echo "</div>

    ";
        // line 45
        $this->displayBlock('secondaryNavigation', $context, $blocks);
        // line 47
        echo "        <div class=\"container\">
            ";
        // line 48
        $this->displayBlock('content', $context, $blocks);
        // line 51
        echo "
    <script src=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/jquery.js\"></script>
    <script src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/main.js\"></script>
    <script src=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap.min.js\"></script>
    <script type=\"text/javascript\" src=\"http://platform.twitter.com/widgets.js\"></script>
    <script src=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-transition.js\"></script>
    <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-alert.js\"></script>
    <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-modal.js\"></script>
    <script src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-dropdown.js\"></script>
    <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-scrollspy.js\"></script>
    <script src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-tab.js\"></script>
    <script src=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-tooltip.js\"></script>
    <script src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-popover.js\"></script>
    <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-button.js\"></script>
    <script src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-collapse.js\"></script>
    <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-carousel.js\"></script>
    <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-typeahead.js\"></script>
    <script src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap-affix.js\"></script>
    <script src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/holder/holder.js\"></script>
    <script src=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/google-code-prettify/prettify.js\"></script>
</body>
</html>
";
    }

    // line 45
    public function block_secondaryNavigation($context, array $blocks = array())
    {
        // line 46
        echo "    ";
    }

    // line 48
    public function block_content($context, array $blocks = array())
    {
        // line 49
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
        return array (  237 => 49,  234 => 48,  230 => 46,  227 => 45,  219 => 70,  215 => 69,  211 => 68,  207 => 67,  203 => 66,  199 => 65,  195 => 64,  191 => 63,  187 => 62,  183 => 61,  179 => 60,  175 => 59,  171 => 58,  167 => 57,  163 => 56,  158 => 54,  154 => 53,  150 => 52,  147 => 51,  145 => 48,  142 => 47,  140 => 45,  135 => 43,  130 => 40,  118 => 38,  111 => 36,  102 => 35,  100 => 34,  95 => 31,  72 => 18,  61 => 17,  59 => 16,  49 => 15,  44 => 12,  42 => 11,  36 => 8,  32 => 7,  26 => 4,  21 => 1,  33 => 5,  30 => 4,  25 => 2,);
    }
}
