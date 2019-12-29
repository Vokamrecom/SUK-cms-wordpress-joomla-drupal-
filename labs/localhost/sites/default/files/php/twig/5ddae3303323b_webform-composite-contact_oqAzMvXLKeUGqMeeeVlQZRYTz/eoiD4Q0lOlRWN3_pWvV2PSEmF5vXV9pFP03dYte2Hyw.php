<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/webform/templates/webform-composite-contact.html.twig */
class __TwigTemplate_c5baa9aa398b44302e96dd5a6a92e086583c269461dc60e670ed33b434d0dc1a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 16];
        $filters = ["escape" => 21];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 16
        if (($context["flexbox"] ?? null)) {
            // line 17
            echo "
  ";
            // line 18
            if (($this->getAttribute(($context["content"] ?? null), "name", []) || $this->getAttribute(($context["content"] ?? null), "company", []))) {
                // line 19
                echo "    <div class=\"webform-flexbox\">
      ";
                // line 20
                if ($this->getAttribute(($context["content"] ?? null), "name", [])) {
                    // line 21
                    echo "        <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "name", [])), "html", null, true);
                    echo "</div></div>
      ";
                }
                // line 23
                echo "      ";
                if ($this->getAttribute(($context["content"] ?? null), "company", [])) {
                    // line 24
                    echo "        <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "company", [])), "html", null, true);
                    echo "</div></div>
      ";
                }
                // line 26
                echo "    </div>
  ";
            }
            // line 28
            echo "
  ";
            // line 29
            if (($this->getAttribute(($context["content"] ?? null), "email", []) || $this->getAttribute(($context["content"] ?? null), "phone", []))) {
                // line 30
                echo "    <div class=\"webform-flexbox\">
      ";
                // line 31
                if ($this->getAttribute(($context["content"] ?? null), "email", [])) {
                    // line 32
                    echo "        <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "email", [])), "html", null, true);
                    echo "</div></div>
      ";
                }
                // line 34
                echo "      ";
                if ($this->getAttribute(($context["content"] ?? null), "phone", [])) {
                    // line 35
                    echo "        <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "phone", [])), "html", null, true);
                    echo "</div></div>
      ";
                }
                // line 37
                echo "    </div>
  ";
            }
            // line 39
            echo "
  ";
            // line 40
            if ($this->getAttribute(($context["content"] ?? null), "address", [])) {
                // line 41
                echo "    <div class=\"webform-flexbox\">
      <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                // line 42
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "address", [])), "html", null, true);
                echo "</div></div>
    </div>
  ";
            }
            // line 45
            echo "
  ";
            // line 46
            if ($this->getAttribute(($context["content"] ?? null), "address_2", [])) {
                // line 47
                echo "    <div class=\"webform-flexbox\">
      <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                // line 48
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "address_2", [])), "html", null, true);
                echo "</div></div>
    </div>
  ";
            }
            // line 51
            echo "
  <div class=\"webform-flexbox\">
    ";
            // line 53
            if ($this->getAttribute(($context["content"] ?? null), "city", [])) {
                // line 54
                echo "      <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "city", [])), "html", null, true);
                echo "</div></div>
    ";
            }
            // line 56
            echo "    ";
            if ($this->getAttribute(($context["content"] ?? null), "state_province", [])) {
                // line 57
                echo "      <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "state_province", [])), "html", null, true);
                echo "</div></div>
    ";
            }
            // line 59
            echo "    ";
            if ($this->getAttribute(($context["content"] ?? null), "postal_code", [])) {
                // line 60
                echo "      <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "postal_code", [])), "html", null, true);
                echo "</div></div>
    ";
            }
            // line 62
            echo "  </div>

  ";
            // line 64
            if ($this->getAttribute(($context["content"] ?? null), "country", [])) {
                // line 65
                echo "    <div class=\"webform-flexbox\">
      <div class=\"webform-flex webform-flex--1\"><div class=\"webform-flex--container\">";
                // line 66
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "country", [])), "html", null, true);
                echo "</div></div>
    </div>
  ";
            }
            // line 69
            echo "
";
        } else {
            // line 71
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "modules/webform/templates/webform-composite-contact.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 71,  188 => 69,  182 => 66,  179 => 65,  177 => 64,  173 => 62,  167 => 60,  164 => 59,  158 => 57,  155 => 56,  149 => 54,  147 => 53,  143 => 51,  137 => 48,  134 => 47,  132 => 46,  129 => 45,  123 => 42,  120 => 41,  118 => 40,  115 => 39,  111 => 37,  105 => 35,  102 => 34,  96 => 32,  94 => 31,  91 => 30,  89 => 29,  86 => 28,  82 => 26,  76 => 24,  73 => 23,  67 => 21,  65 => 20,  62 => 19,  60 => 18,  57 => 17,  55 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/webform/templates/webform-composite-contact.html.twig", "W:\\domains\\localhost\\modules\\webform\\templates\\webform-composite-contact.html.twig");
    }
}
