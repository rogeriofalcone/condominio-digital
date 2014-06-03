<?php

/* pagination_reclamacao.html.twig */
class __TwigTemplate_aded17a6dd89f84c3210a2b813447523eb2e361bf8d0c9d886ec089bd102044c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (((isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")) > 1)) {
            // line 2
            echo "        <ul class=\"pager\">
            <li ";
            // line 3
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == 1)) {
                echo "class=\"disabled\"";
            }
            echo ">
                ";
            // line 4
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == 1)) {
                echo "<a href=\"#\">Anterior</a>";
            }
            // line 5
            echo "                ";
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) != 1)) {
                echo "<a href=\"";
                echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, ((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) - 1), "html", null, true);
                echo "\">Anterior</a>";
            }
            // line 6
            echo "            </li>
            ";
            // line 7
            $context["foo1"] = (1 + (2 * (isset($context["adjacentes"]) ? $context["adjacentes"] : $this->getContext($context, "adjacentes"))));
            // line 8
            echo "            ";
            $context["foo2"] = (2 * (isset($context["adjacentes"]) ? $context["adjacentes"] : $this->getContext($context, "adjacentes")));
            // line 9
            echo "            
            ";
            // line 10
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) < (isset($context["foo1"]) ? $context["foo1"] : $this->getContext($context, "foo1")))) {
                // line 11
                echo "                ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages"))));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 12
                    echo "                    ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) < (2 + (2 * (isset($context["adjacentes"]) ? $context["adjacentes"] : $this->getContext($context, "adjacentes")))))) {
                        // line 13
                        echo "                        <li >
                            ";
                        // line 14
                        if ((isset($context["busca"]) ? $context["busca"] : $this->getContext($context, "busca"))) {
                            // line 15
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["busca"]) ? $context["busca"] : $this->getContext($context, "busca")), "html", null, true);
                            echo "\" ";
                            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))) {
                                echo "class=\"active\"";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo " </a>
                            ";
                        } else {
                            // line 17
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo "\" ";
                            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))) {
                                echo "class=\"active\"";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo " </a>
                            ";
                        }
                        // line 19
                        echo "                        </li>
                    ";
                    }
                    // line 21
                    echo "                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "    
            ";
            } elseif ((((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) > (isset($context["foo2"]) ? $context["foo2"] : $this->getContext($context, "foo2"))) && ((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) < ((isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")) - 3)))) {
                // line 23
                echo "                <li><a href=\"";
                echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, (isset($context["idnome"]) ? $context["idnome"] : $this->getContext($context, "idnome")), "html", null, true);
                echo "/1\">1</a></li>
                 ";
                // line 24
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) - (isset($context["adjacentes"]) ? $context["adjacentes"] : $this->getContext($context, "adjacentes"))), (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages"))));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 25
                    echo "                    ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) <= ((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) + (isset($context["adjacentes"]) ? $context["adjacentes"] : $this->getContext($context, "adjacentes"))))) {
                        // line 26
                        echo "                        <li >
                            ";
                        // line 27
                        if ((isset($context["busca"]) ? $context["busca"] : $this->getContext($context, "busca"))) {
                            // line 28
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["busca"]) ? $context["busca"] : $this->getContext($context, "busca")), "html", null, true);
                            echo "\" ";
                            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))) {
                                echo "class=\"active\"";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo " </a>
                            ";
                        } else {
                            // line 30
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo "\" ";
                            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))) {
                                echo "class=\"active\"";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo " </a>
                            ";
                        }
                        // line 32
                        echo "                        </li>                          
                    ";
                    }
                    // line 33
                    echo "                        
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 34
                echo "    
           ";
            } else {
                // line 35
                echo "      
                <li><a href=\"";
                // line 36
                echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, (isset($context["idnome"]) ? $context["idnome"] : $this->getContext($context, "idnome")), "html", null, true);
                echo "/1\">1</a></li>
                ";
                // line 37
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(((isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")) - 2), (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages"))));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 38
                    echo "                    ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) <= (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")))) {
                        // line 39
                        echo "                        <li >
                            ";
                        // line 40
                        if ((isset($context["busca"]) ? $context["busca"] : $this->getContext($context, "busca"))) {
                            // line 41
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["busca"]) ? $context["busca"] : $this->getContext($context, "busca")), "html", null, true);
                            echo "\" ";
                            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))) {
                                echo "class=\"active\"";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo " </a>
                            ";
                        } else {
                            // line 43
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo "\" ";
                            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))) {
                                echo "class=\"active\"";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                            echo " </a>
                            ";
                        }
                        // line 45
                        echo "                        </li>                          
                    ";
                    }
                    // line 46
                    echo "                        
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "   
                        
            ";
            }
            // line 50
            echo "            <li ";
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")))) {
                echo "class=\"disabled\"";
            }
            echo ">
                ";
            // line 51
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) != (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")))) {
                echo "<a href=\"";
                echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : $this->getContext($context, "uri")), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, (isset($context["here"]) ? $context["here"] : $this->getContext($context, "here")), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, ((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) + 1), "html", null, true);
                echo "\">Próximo</a>";
            }
            // line 52
            echo "                ";
            if (((isset($context["currentPage"]) ? $context["currentPage"] : $this->getContext($context, "currentPage")) == (isset($context["numPages"]) ? $context["numPages"] : $this->getContext($context, "numPages")))) {
                echo "<a href=\"#\">Próximo</a>";
            }
            // line 53
            echo "            </li>
        </ul>
";
        }
    }

    public function getTemplateName()
    {
        return "pagination_reclamacao.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  279 => 53,  274 => 52,  264 => 51,  257 => 50,  252 => 47,  245 => 46,  241 => 45,  225 => 43,  207 => 41,  205 => 40,  202 => 39,  199 => 38,  195 => 37,  189 => 36,  186 => 35,  182 => 34,  175 => 33,  171 => 32,  155 => 30,  137 => 28,  135 => 27,  132 => 26,  129 => 25,  125 => 24,  118 => 23,  109 => 21,  105 => 19,  89 => 17,  71 => 15,  69 => 14,  66 => 13,  63 => 12,  58 => 11,  56 => 10,  53 => 9,  48 => 7,  45 => 6,  30 => 4,  24 => 3,  21 => 2,  19 => 1,  41 => 7,  35 => 6,  102 => 31,  100 => 30,  97 => 29,  88 => 26,  84 => 25,  81 => 24,  77 => 23,  65 => 13,  59 => 12,  50 => 8,  44 => 7,  39 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
