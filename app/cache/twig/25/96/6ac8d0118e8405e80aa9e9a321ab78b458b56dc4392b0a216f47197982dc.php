<?php

/* common/form_div_layout.html.twig */
class __TwigTemplate_25966ac8d0118e8405e80aa9e9a321ab78b458b56dc4392b0a216f47197982dc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("form_div_layout.html.twig");

        $this->blocks = array(
            'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
            'datetime_widget' => array($this, 'block_datetime_widget'),
            'date_widget' => array($this, 'block_date_widget'),
            'time_widget' => array($this, 'block_time_widget'),
            'money_widget' => array($this, 'block_money_widget'),
            'percent_widget' => array($this, 'block_percent_widget'),
            'form_label' => array($this, 'block_form_label'),
            'form_row' => array($this, 'block_form_row'),
            'form_errors' => array($this, 'block_form_errors'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_div_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        // line 6
        ob_start();
        // line 7
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 8
            echo "        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), 'label', array("in_choice_list" => true, "widget" =>             // line 13
$this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), 'widget'), "multiple" => (isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))));
            // line 16
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 21
    public function block_datetime_widget($context, array $blocks = array())
    {
        // line 22
        ob_start();
        // line 23
        echo "    ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 24
            echo "        ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
    ";
        } else {
            // line 26
            echo "        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
            ";
            // line 27
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date"), 'errors');
            echo "
            ";
            // line 28
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "time"), 'errors');
            echo "
            ";
            // line 29
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date"), 'widget', array("datetime" => true));
            echo "&nbsp;
            ";
            // line 30
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "time"), 'widget', array("datetime" => true));
            echo "
        </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 36
    public function block_date_widget($context, array $blocks = array())
    {
        // line 37
        ob_start();
        // line 38
        echo "    ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 39
            echo "        ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
    ";
        } else {
            // line 41
            echo "        ";
            if (((!array_key_exists("datetime", $context)) || (false == (isset($context["datetime"]) ? $context["datetime"] : $this->getContext($context, "datetime"))))) {
                // line 42
                echo "        <div ";
                $this->displayBlock("widget_container_attributes", $context, $blocks);
                echo ">
        ";
            }
            // line 44
            echo "            ";
            echo strtr((isset($context["date_pattern"]) ? $context["date_pattern"] : $this->getContext($context, "date_pattern")), array("{{ year }}" =>             // line 45
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "year"), 'widget', array("attr" => array("class" => "span1"))), "{{ month }}" =>             // line 46
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "month"), 'widget', array("attr" => array("class" => "span1"))), "{{ day }}" =>             // line 47
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "day"), 'widget', array("attr" => array("class" => "span1")))));
            // line 48
            echo "
        ";
            // line 49
            if (((!array_key_exists("datetime", $context)) || (false == (isset($context["datetime"]) ? $context["datetime"] : $this->getContext($context, "datetime"))))) {
                // line 50
                echo "        </div>
        ";
            }
            // line 52
            echo "    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 56
    public function block_time_widget($context, array $blocks = array())
    {
        // line 57
        ob_start();
        // line 58
        echo "    ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 59
            echo "        ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
    ";
        } else {
            // line 61
            echo "        ";
            if (((!array_key_exists("datetime", $context)) || (false == (isset($context["datetime"]) ? $context["datetime"] : $this->getContext($context, "datetime"))))) {
                // line 62
                echo "        <div ";
                $this->displayBlock("widget_container_attributes", $context, $blocks);
                echo ">
        ";
            }
            // line 64
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "hour"), 'widget', array("attr" => array("class" => "span1")));
            echo ":";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "minute"), 'widget', array("attr" => array("class" => "span1")));
            if ((isset($context["with_seconds"]) ? $context["with_seconds"] : $this->getContext($context, "with_seconds"))) {
                echo ":";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'widget', array("attr" => array("class" => "span1")));
            }
            // line 65
            echo "        ";
            if (((!array_key_exists("datetime", $context)) || (false == (isset($context["datetime"]) ? $context["datetime"] : $this->getContext($context, "datetime"))))) {
                // line 66
                echo "        </div>
        ";
            }
            // line 68
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 73
    public function block_money_widget($context, array $blocks = array())
    {
        // line 74
        ob_start();
        // line 75
        echo "    ";
        $context["append"] = ("{{" == twig_slice($this->env, (isset($context["money_pattern"]) ? $context["money_pattern"] : $this->getContext($context, "money_pattern")), 0, 2));
        // line 76
        echo "    <div class=\"";
        echo (((isset($context["append"]) ? $context["append"] : $this->getContext($context, "append"))) ? ("input-append") : ("input-prepend"));
        echo "\">
        ";
        // line 77
        if ((!(isset($context["append"]) ? $context["append"] : $this->getContext($context, "append")))) {
            // line 78
            echo "            <span class=\"add-on\">
                ";
            // line 79
            echo twig_escape_filter($this->env, strtr((isset($context["money_pattern"]) ? $context["money_pattern"] : $this->getContext($context, "money_pattern")), array("{{ widget }}" => "")), "html", null, true);
            echo "
            </span>
        ";
        }
        // line 82
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
        ";
        // line 83
        if ((isset($context["append"]) ? $context["append"] : $this->getContext($context, "append"))) {
            // line 84
            echo "            <span class=\"add-on\">
                ";
            // line 85
            echo twig_escape_filter($this->env, strtr((isset($context["money_pattern"]) ? $context["money_pattern"] : $this->getContext($context, "money_pattern")), array("{{ widget }}" => "")), "html", null, true);
            echo "
            </span>
        ";
        }
        // line 88
        echo "    </div>

";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 93
    public function block_percent_widget($context, array $blocks = array())
    {
        // line 94
        ob_start();
        // line 95
        echo "    <div class=\"input-append\">
        ";
        // line 96
        $this->displayParentBlock("percent_widget", $context, $blocks);
        echo "
        <span class=\"add-on\">%</span>
    </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 104
    public function block_form_label($context, array $blocks = array())
    {
        // line 105
        ob_start();
        // line 106
        echo "    ";
        if (((array_key_exists("in_choice_list", $context) && (isset($context["in_choice_list"]) ? $context["in_choice_list"] : $this->getContext($context, "in_choice_list"))) && array_key_exists("widget", $context))) {
            // line 107
            echo "        ";
            if ((!(isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound")))) {
                // line 108
                echo "            ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("for" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
                // line 109
                echo "        ";
            }
            // line 110
            echo "        ";
            if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
                // line 111
                echo "            ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class"), "")) : ("")) . " required"))));
                // line 112
                echo "        ";
            }
            // line 113
            echo "        ";
            if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                // line 114
                echo "            ";
                $context["label"] = call_user_func_array($this->env->getFilter('humanize')->getCallable(), array((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"))));
                // line 115
                echo "        ";
            }
            // line 116
            echo "
        ";
            // line 117
            if ((array_key_exists("multiple", $context) && (isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple")))) {
                // line 118
                echo "            ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class"), "")) : ("")) . " checkbox"))));
                // line 119
                echo "        ";
            } elseif ((array_key_exists("multiple", $context) && (!(isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))))) {
                // line 120
                echo "            ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class"), "")) : ("")) . " radio"))));
                // line 121
                echo "        ";
            }
            // line 122
            echo "        <label";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, (isset($context["attrname"]) ? $context["attrname"] : $this->getContext($context, "attrname")), "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, (isset($context["attrvalue"]) ? $context["attrvalue"] : $this->getContext($context, "attrvalue")), "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">
            ";
            // line 123
            echo (isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget"));
            echo "
            <span>
                ";
            // line 125
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
            </span>
        </label>
    ";
        } else {
            // line 129
            echo "        ";
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class"), "")) : ("")) . " control-label"))));
            // line 130
            echo "        ";
            $this->displayParentBlock("form_label", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 137
    public function block_form_row($context, array $blocks = array())
    {
        // line 138
        ob_start();
        // line 139
        echo "    <div class=\"control-group";
        if ((!$this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "valid"))) {
            echo " error";
        }
        echo "\">
        ";
        // line 140
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "
        <div class=\"controls\">
            ";
        // line 142
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
            ";
        // line 143
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
        </div>
    </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 149
    public function block_form_errors($context, array $blocks = array())
    {
        // line 150
        ob_start();
        // line 151
        echo "    ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 152
            echo "    ";
            if ($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent")) {
                echo "<span class=\"help-inline\">";
            } else {
                echo "<div class=\"alert alert-error error\" >";
            }
            // line 153
            echo "        ";
            $this->displayParentBlock("form_errors", $context, $blocks);
            echo "
    ";
            // line 154
            if ($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent")) {
                echo "</span>";
            } else {
                echo "</div>";
            }
            // line 155
            echo "    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "common/form_div_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  402 => 155,  396 => 154,  391 => 153,  384 => 152,  381 => 151,  379 => 150,  376 => 149,  367 => 143,  363 => 142,  358 => 140,  351 => 139,  349 => 138,  346 => 137,  337 => 130,  334 => 129,  327 => 125,  322 => 123,  306 => 122,  303 => 121,  300 => 120,  297 => 119,  294 => 118,  292 => 117,  289 => 116,  286 => 115,  283 => 114,  280 => 113,  277 => 112,  274 => 111,  271 => 110,  268 => 109,  265 => 108,  262 => 107,  259 => 106,  257 => 105,  254 => 104,  245 => 96,  242 => 95,  240 => 94,  237 => 93,  230 => 88,  224 => 85,  221 => 84,  219 => 83,  214 => 82,  208 => 79,  205 => 78,  203 => 77,  198 => 76,  195 => 75,  193 => 74,  190 => 73,  183 => 68,  179 => 66,  176 => 65,  167 => 64,  161 => 62,  158 => 61,  152 => 59,  149 => 58,  147 => 57,  144 => 56,  138 => 52,  134 => 50,  132 => 49,  129 => 48,  127 => 47,  126 => 46,  125 => 45,  123 => 44,  117 => 42,  114 => 41,  108 => 39,  105 => 38,  103 => 37,  100 => 36,  91 => 30,  87 => 29,  83 => 28,  79 => 27,  74 => 26,  68 => 24,  65 => 23,  63 => 22,  50 => 16,  48 => 13,  46 => 8,  41 => 7,  39 => 6,  60 => 21,  54 => 13,  51 => 12,  45 => 9,  42 => 8,  40 => 7,  36 => 5,  33 => 5,  30 => 4,  25 => 2,);
    }
}
