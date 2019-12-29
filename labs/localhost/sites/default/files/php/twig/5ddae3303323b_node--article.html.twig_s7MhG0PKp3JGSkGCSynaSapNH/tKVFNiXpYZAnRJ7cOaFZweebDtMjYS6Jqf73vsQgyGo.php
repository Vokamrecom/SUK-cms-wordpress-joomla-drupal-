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

/* themes/corporate_lite/templates/node--article.html.twig */
class __TwigTemplate_d5061f5550c9a0251855b419f7efa9d044f83602d3fa443e0ae7b347e9fc4d77 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 8
        $this->parent = $this->loadTemplate("node.html.twig", "themes/corporate_lite/templates/node--article.html.twig", 8);
        $this->blocks = [
            'node_side' => [$this, 'block_node_side'],
            'meta_area' => [$this, 'block_meta_area'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 11, "trans" => 41];
        $filters = ["escape" => 17, "format_date" => 25, "url_encode" => 78, "without" => 164];
        $functions = ["attach_library" => 38, "url" => 78];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape', 'format_date', 'url_encode', 'without'],
                ['attach_library', 'url']
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
        if (((((((($context["display_submitted"] ?? null) || $this->getAttribute(($context["mt_setting"] ?? null), "reading_time", [])) || $this->getAttribute(($context["mt_setting"] ?? null), "share_links", [])) || $this->getAttribute(($context["mt_setting"] ?? null), "font_resize", [])) || $this->getAttribute(($context["mt_setting"] ?? null), "post_progress", [])) || $this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) || ($this->getAttribute(($context["node"] ?? null), "comment", []) && (($context["comment_count"] ?? null) > 0)))) {
            // line 12
            echo "      ";
            if ((($context["display_submitted"] ?? null) || ($this->getAttribute(($context["node"] ?? null), "comment", []) && (($context["comment_count"] ?? null) > 0)))) {
                // line 13
                echo "        ";
                if (($context["display_submitted"] ?? null)) {
                    // line 14
                    echo "          <div class=\"node__user-info\">
            ";
                    // line 15
                    if (($context["author_picture"] ?? null)) {
                        // line 16
                        echo "              <div class=\"user-picture\">
                <div";
                        // line 17
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author_attributes"] ?? null)), "html", null, true);
                        echo ">
                  ";
                        // line 18
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author_picture"] ?? null)), "html", null, true);
                        echo "
                </div>
              </div>
            ";
                    }
                    // line 22
                    echo "            ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["metadata"] ?? null)), "html", null, true);
                    echo "
          </div>
          <div class=\"node__submitted-date\">
            <div class=\"month\">";
                    // line 25
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFilter('format_date')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "createdtime", [])), "custom", "M"]), "html", null, true);
                    echo "</div>
            <div class=\"day\">";
                    // line 26
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFilter('format_date')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "createdtime", [])), "custom", "d"]), "html", null, true);
                    echo "</div>
            <div class=\"year\">";
                    // line 27
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFilter('format_date')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "createdtime", [])), "custom", "Y"]), "html", null, true);
                    echo "</div>
          </div>
        ";
                }
                // line 30
                echo "        ";
                if (($this->getAttribute(($context["node"] ?? null), "comment", []) && (($context["comment_count"] ?? null) > 0))) {
                    // line 31
                    echo "          <div class=\"node__comments\">
            <i class=\"fa fa-comment\"></i>
            <div class=\"node__comments-count\">";
                    // line 33
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["comment_count"] ?? null)), "html", null, true);
                    echo "</div>
          </div>
        ";
                }
                // line 36
                echo "      ";
            }
            // line 37
            echo "      ";
            if ($this->getAttribute(($context["mt_setting"] ?? null), "reading_time", [])) {
                // line 38
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/reading-time"), "html", null, true);
                echo "
        <div class=\"reading-time\">
          ";
                // line 40
                if ((($context["minutes"] ?? null) < 1)) {
                    // line 41
                    echo "            ";
                    echo t("1<div class=\"reading-time__text\">min read</div>", array());
                    // line 44
                    echo "          ";
                } else {
                    // line 45
                    echo "            ";
                    echo t("@minutes<div class=\"reading-time__text\">min read</div>", array("@minutes" =>                     // line 46
($context["minutes"] ?? null), ));
                    // line 48
                    echo "          ";
                }
                // line 49
                echo "        </div>
      ";
            }
            // line 51
            echo "      ";
            if ($this->getAttribute(($context["mt_setting"] ?? null), "affix_side", [])) {
                // line 52
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/node-side-affix"), "html", null, true);
                echo "
        <div id=\"affix\">
      ";
            }
            // line 55
            echo "      ";
            if ($this->getAttribute(($context["mt_setting"] ?? null), "font_resize", [])) {
                // line 56
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/font-resize"), "html", null, true);
                echo "
        <div class=\"content-font-settings\">
            <div class=\"font-resize\">
              <a href=\"#\" id=\"decfont\">A-</a>
              <a href=\"#\" id=\"incfont\">A+</a>
            </div>
        </div>
      ";
            }
            // line 64
            echo "      ";
            if ($this->getAttribute(($context["mt_setting"] ?? null), "post_progress", [])) {
                // line 65
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/post-progress"), "html", null, true);
                echo "
        <div class=\"post-progress\">
          <div class=\"post-progress__value\"></div>
          <div class=\"post-progress__text\">";
                // line 68
                echo t("read", array());
                echo "</div>
          <div class=\"post-progress__bar\"></div>
        </div>
      ";
            }
            // line 72
            echo "      ";
            if ((($this->getAttribute(($context["mt_setting"] ?? null), "share_links_print_position", []) == "node-side") && ($this->getAttribute(($context["mt_setting"] ?? null), "share_links", []) || $this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])))) {
                // line 73
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/share-links"), "html", null, true);
                echo "
        <div class=\"share-links\">
          <ul>
            ";
                // line 76
                if ($this->getAttribute(($context["mt_setting"] ?? null), "share_links", [])) {
                    // line 77
                    echo "              <li class=\"facebook";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) ? (" print-button-enabled") : ("")));
                    echo "\">
                <a href=\"https://www.facebook.com/sharer/sharer.php?u=";
                    // line 78
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]), "html", null, true);
                    echo "&t=";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), true), "html", null, true);
                    echo "\" onclick=\"window.open(this.href, 'facebook-share','width=580,height=296');return false;\">
                    <i class=\"fa fa-facebook\"><span class=\"sr-only\">facebook</span></i>
                </a>
              </li>
              <li class=\"twitter";
                    // line 82
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) ? (" print-button-enabled") : ("")));
                    echo "\">
                <a href=\"http://twitter.com/share?text=";
                    // line 83
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), true), "html", null, true);
                    echo "&url=";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]), "html", null, true);
                    echo "\" onclick=\"window.open(this.href, 'twitter-share', 'width=550,height=235');return false;\">
                    <i class=\"fa fa-twitter\"><span class=\"sr-only\">twitter</span></i>
                </a>
              </li>
              <li class=\"email";
                    // line 87
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) ? (" print-button-enabled") : ("")));
                    echo "\">
                <a href=\"mailto:?Subject=";
                    // line 88
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), true), "html", null, true);
                    echo "&amp;Body=";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]), "html", null, true);
                    echo "\">
                    <i class=\"fa fa-envelope-o\"><span class=\"sr-only\">email</span></i>
                </a>
              </li>
            ";
                }
                // line 93
                echo "            ";
                if ($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) {
                    // line 94
                    echo "              <li class=\"print";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "share_links", [])) ? (" share-links-enabled") : ("")));
                    echo "\">
                <div class=\"print\">
                  <a href=\"javascript:window.print()\" class=\"print-button\">
                    <i class=\"fa fa-print\"><span class=\"sr-only\">print</span></i>
                  </a>
                </div>
              </li>
            ";
                }
                // line 102
                echo "          </ul>
        </div>
      ";
            }
            // line 105
            echo "      ";
            if ($this->getAttribute(($context["mt_setting"] ?? null), "affix_side", [])) {
                // line 106
                echo "        </div>
      ";
            }
            // line 108
            echo "      ";
            if ((($this->getAttribute(($context["mt_setting"] ?? null), "share_links_print_position", []) == "bottom") && ($this->getAttribute(($context["mt_setting"] ?? null), "share_links", []) || $this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])))) {
                // line 109
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/share-links"), "html", null, true);
                echo "
        ";
                // line 110
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/fixed-share-links"), "html", null, true);
                echo "
        <div class=\"share-links\">
          <ul>
            ";
                // line 113
                if ($this->getAttribute(($context["mt_setting"] ?? null), "share_links", [])) {
                    // line 114
                    echo "              <li class=\"facebook";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) ? (" print-button-enabled") : ("")));
                    echo "\">
                <a href=\"https://www.facebook.com/sharer/sharer.php?u=";
                    // line 115
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]), "html", null, true);
                    echo "&t=";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), true), "html", null, true);
                    echo "\" onclick=\"window.open(this.href, 'facebook-share','width=580,height=296');return false;\">
                    <i class=\"fa fa-facebook\"><span class=\"sr-only\">facebook</span></i>
                </a>
              </li>
              <li class=\"twitter";
                    // line 119
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) ? (" print-button-enabled") : ("")));
                    echo "\">
                <a href=\"http://twitter.com/share?text=";
                    // line 120
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), true), "html", null, true);
                    echo "&url=";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]), "html", null, true);
                    echo "\" onclick=\"window.open(this.href, 'twitter-share', 'width=550,height=235');return false;\">
                    <i class=\"fa fa-twitter\"><span class=\"sr-only\">twitter</span></i>
                </a>
              </li>
              <li class=\"email";
                    // line 124
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) ? (" print-button-enabled") : ("")));
                    echo "\">
                <a href=\"mailto:?Subject=";
                    // line 125
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_urlencode_filter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), true), "html", null, true);
                    echo "&amp;Body=";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]), "html", null, true);
                    echo "\">
                    <i class=\"fa fa-envelope-o\"><span class=\"sr-only\">email</span></i>
                </a>
              </li>
            ";
                }
                // line 130
                echo "            ";
                if ($this->getAttribute(($context["mt_setting"] ?? null), "print_button", [])) {
                    // line 131
                    echo "              <li class=\"print";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute(($context["mt_setting"] ?? null), "share_links", [])) ? (" share-links-enabled") : ("")));
                    echo "\">
                <div class=\"print\">
                  <a href=\"javascript:window.print()\" class=\"print-button\">
                    <i class=\"fa fa-print\"><span class=\"sr-only\">print</span></i>
                  </a>
                </div>
              </li>
            ";
                }
                // line 139
                echo "          </ul>
        </div>
      ";
            }
            // line 142
            echo "    ";
        }
        // line 143
        echo "  </div>
";
    }

    // line 145
    public function block_meta_area($context, array $blocks = [])
    {
        // line 146
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
        echo "
  ";
        // line 147
        if ( !($context["page"] ?? null)) {
            // line 148
            echo "    <h2";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => "node__title"], "method")), "html", null, true);
            echo ">
      <a href=\"";
            // line 149
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null)), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "</a>
    </h2>
  ";
        }
        // line 152
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        echo "
  ";
        // line 153
        if (($context["display_submitted"] ?? null)) {
            // line 154
            echo "    <div class=\"node__meta\">
      <span";
            // line 155
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["author_attributes"] ?? null), "addClass", [0 => "node__submitted-info"], "method")), "html", null, true);
            echo ">
        ";
            // line 156
            echo t("<span class=\"node__submitted-info-text\">By</span> @author_name", array("@author_name" => ($context["author_name"] ?? null), ));
            // line 157
            echo "      </span>
    </div>
  ";
        }
    }

    // line 161
    public function block_content($context, array $blocks = [])
    {
        // line 162
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("corporate_lite/node-article"), "html", null, true);
        echo "
  <div class=\"node__main-content-section\">
    ";
        // line 164
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "comment"), "html", null, true);
        echo "
  </div>
  ";
        // line 166
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "comment", [])), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/corporate_lite/templates/node--article.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  431 => 166,  426 => 164,  420 => 162,  417 => 161,  410 => 157,  408 => 156,  404 => 155,  401 => 154,  399 => 153,  394 => 152,  386 => 149,  381 => 148,  379 => 147,  374 => 146,  371 => 145,  366 => 143,  363 => 142,  358 => 139,  346 => 131,  343 => 130,  333 => 125,  329 => 124,  320 => 120,  316 => 119,  307 => 115,  302 => 114,  300 => 113,  294 => 110,  289 => 109,  286 => 108,  282 => 106,  279 => 105,  274 => 102,  262 => 94,  259 => 93,  249 => 88,  245 => 87,  236 => 83,  232 => 82,  223 => 78,  218 => 77,  216 => 76,  209 => 73,  206 => 72,  199 => 68,  192 => 65,  189 => 64,  177 => 56,  174 => 55,  167 => 52,  164 => 51,  160 => 49,  157 => 48,  155 => 46,  153 => 45,  150 => 44,  147 => 41,  145 => 40,  139 => 38,  136 => 37,  133 => 36,  127 => 33,  123 => 31,  120 => 30,  114 => 27,  110 => 26,  106 => 25,  99 => 22,  92 => 18,  88 => 17,  85 => 16,  83 => 15,  80 => 14,  77 => 13,  74 => 12,  72 => 11,  69 => 10,  66 => 9,  22 => 8,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/corporate_lite/templates/node--article.html.twig", "W:\\domains\\localhost\\themes\\corporate_lite\\templates\\node--article.html.twig");
    }
}
