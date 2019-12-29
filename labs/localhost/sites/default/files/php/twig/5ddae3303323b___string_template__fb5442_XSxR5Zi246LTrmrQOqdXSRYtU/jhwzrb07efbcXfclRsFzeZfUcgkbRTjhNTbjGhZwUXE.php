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

/* __string_template__fb5442f6839c31902a9641c9ed745b1e7c9e6e658e5f574f5e915fe009b17647 */
class __TwigTemplate_9a319ffd660237cf6ed0c8b62dea9d9c97cd82329eff7484b2f3b792fd677bd1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = [];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
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
        // line 1
        echo "Lenovo Group Limited (произносится Лено́во Груп Лимитед; кит. трад. 聯想, упр. 联想, пиньинь: liánxiǎng, палл.: ляньсян, полное название — кит. 联想集团有限公司) (SEHK: 0992) — китайская компания, выпускающая персональные компьютеры и другую электронику. Является крупнейшим производителем персональных компьютеров в мире с долей на рынке более 20 %[4], а также занимает пятое место по производству мобильных телефонов. Штаб-квартира компании Lenovo расположена в Пекине (КНР), а зарегистрирована компания в Гонконге. Основные исследовательские центры компании расположены в Пекине, Шанхае и Шэньчжэне (КНР), а также в Ямато (Япония).";
    }

    public function getTemplateName()
    {
        return "__string_template__fb5442f6839c31902a9641c9ed745b1e7c9e6e658e5f574f5e915fe009b17647";
    }

    public function getDebugInfo()
    {
        return array (  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__fb5442f6839c31902a9641c9ed745b1e7c9e6e658e5f574f5e915fe009b17647", "");
    }
}
