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

/* themes/corporate_lite/templates/node--article--teaser.html.twig */
class __TwigTemplate_52a00b57c8cb617c0382b8e09bac87bfbad4bfb022571982c67b276c01fcca01 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 8
        $this->parent = $this->loadTemplate("node.html.twig", "themes/corporate_lite/templates/node--article--teaser.html.twig", 8);
        $this->blocks = [
            'node_side' => [$this, 'block_node_side'],
            'meta_area' => [$this, 'block_meta_area'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 11, "trans" => 49];
        $filters = ["escape" => 16, "format_date" => 24, "without" => 57];
        $functions = ["attach_library" => 55];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape', 'format_date', 'without'],
                ['attach_library']
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

    protected function doGetParent(array $context)
    {
        return "node.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 9
    public function block_node_side($context, array $blocks = [])
    {
        // line 10
        echo "  <div class=\"node__side\">
    ";
        // line 11
        if ((($context["display_submitted"] ?? null) || ($this->getAttribute(($context["node"] ?? null), "comment", []) && (($context["comment_count"] ?? null) > 0)))) {
            // line 12
            echo "      ";
            if (($context["display_submitted"] ?? null)) {
                // line 13
                echo "        <div class=\"node__user-info\">
          ";
                // line 14
                if (($context["author_picture"] ?? null)) {
                    // line 15
                    echo "            <div class=\"user-picture\">
              <div";
                    // line 16
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author_attributes"] ?? null)), "html", null, true);
                    echo ">
                ";
                    // line 17
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author_picture"] ?? null)), "html", null, true);
                    echo "
              </div>
            </div>
          ";
                }
                // line 21
                echo "          ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["metadata"] ?? null)), "html", null, true);
                echo "
        </div>
        <div class=\"node__submitted-date\">
          <div class=\"month\">";
                // line 24
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFilter('format_date')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "createdtime", [])), "custom", "M"]), "html", null, true);
                echo "</div>
          <div class=\"day\">";
                // line 25
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFilter('format_date')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "createdtime", [])), "custom", "d"]), "html", null, true);
                echo "</div>
          <div class=\"year\">";
                // line 26
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFilter('format_date')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "createdtime", [])), "custom", "Y"]), "html", null, true);
                echo "</div>
        </div>
      ";
            }
            // line 29
            echo "      ";
            if (($this->getAttribute(($context["node"] ?? null), "comment", []) && (($context["comment_count"] ?? null) > 0))) {
                // line 30
                echo "        <div class=\"node__comments\">
          <i class=\"fa fa-comment\"></i>
          <div class=\"node__comments-count\">";
                // line 32
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["comment_count"] ?? null)), "html", null, true);
                echo "</div>
        </div>
      ";
            }
            // line 35
            echo "    ";
        }
        // line 36
        echo "  </div>
";
    }

    // line 38
    public function block_meta_area($context, array $blocks = [])
    {
        // line 39
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
        echo "
  ";
        // line 40
        if ( !($context["page"] ?? null)) {
            // line 41
            echo "    <h2";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => "node__title"], "method")), "html", null, true);
            echo ">
      <a href=\"";
            // line 42
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null)), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "</a>
    </h2>
  ";
        }
        // line 45
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        echo "
  ";
        // line 46
        if (($context["display_submitted"] ?? null)) {
            // line 47
            echo "    <div class=\"node__meta\">
      <span";
            // line 48
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["author_attributes"] ?? null), "addClass", [0 => "node__submitted-info"], "method")), "html", null, true);
            echo ">
        ";
            // line 49
            echo t("<span class=\"node__submitted-info-text\">By</span> @author_name", array("@author_name" => ($context["author_name"] ?? null), ));
            // line 50
            echo "      </span>
    </div>
  ";
        }
    }

    // line 54
    public function block_content($context, array $blocks = [])
    {
        // line 55
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/node-article"), "html", null, true);
        echo "
  <div class=\"node__main-content-section\">
    ";
        // line 57
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "comment"), "html", null, true);
        echo "
  </div>
  ";
        // line 59
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "comment", [])), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/corporate_lite/templates/node--article--teaser.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 59,  193 => 57,  187 => 55,  184 => 54,  177 => 50,  175 => 49,  171 => 48,  168 => 47,  166 => 46,  161 => 45,  153 => 42,  148 => 41,  146 => 40,  141 => 39,  138 => 38,  133 => 36,  130 => 35,  124 => 32,  120 => 30,  117 => 29,  111 => 26,  107 => 25,  103 => 24,  96 => 21,  89 => 17,  85 => 16,  82 => 15,  80 => 14,  77 => 13,  74 => 12,  72 => 11,  69 => 10,  66 => 9,  22 => 8,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/corporate_lite/templates/node--article--teaser.html.twig", "W:\\domains\\localhost\\themes\\corporate_lite\\templates\\node--article--teaser.html.twig");
    }
}
