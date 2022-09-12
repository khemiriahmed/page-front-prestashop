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

/* @PrestaShop/Admin/Improve/International/Translations/Blocks/export_language.html.twig */
class __TwigTemplate_a02ec10f2728d4e53a2fbc174e2ec955a9efc8aec194a37d4adfaa47c1ce2f04 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/International/Translations/Blocks/export_language.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/International/Translations/Blocks/export_language.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->env->getRuntime("Symfony\\Component\\Form\\FormRenderer")->setTheme(($context["exportCataloguesForm"] ?? $this->getContext($context, "exportCataloguesForm")), [0 => "PrestaShopBundle:Admin/TwigTemplateForm:prestashop_ui_kit.html.twig"], true);
        // line 28
        echo "
";
        // line 29
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["exportCataloguesForm"] ?? $this->getContext($context, "exportCataloguesForm")), 'form_start', ["action" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_international_translations_export_catalogues")]);
        echo "

<div class=\"card export-translations\">
  <h3 class=\"card-header\">
    <i class=\"material-icons\">cloud_upload</i> ";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Export a language", [], "Admin.International.Feature"), "html", null, true);
        echo "

    <span
      class=\"help-box\"
      data-container=\"body\"
      data-toggle=\"popover\"
      data-trigger=\"hover\"
      data-placement=\"right\"
      data-content=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Export data from one language to a file (language pack).", [], "Admin.International.Help"), "html", null, true);
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Select which theme you would like to export your translations to.", [], "Admin.International.Help"), "html", null, true);
        echo "\"
      title=\"\"
    >
    </span>
  </h3>
  <div class=\"card-block row\">
    <div class=\"card-text\">
      ";
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["exportCataloguesForm"] ?? $this->getContext($context, "exportCataloguesForm")), 'rest');
        echo "
    </div>
  </div>

  <div class=\"card-footer\">
    <div class=\"d-flex justify-content-end\">
      <button class=\"btn btn-primary\" id=\"form-export-language-button\">
        <i class=\"material-icons\">cloud_download</i>
        <span>";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Export", [], "Admin.Actions"), "html", null, true);
        echo "</span>
      </button>
    </div>
  </div>
</div>

";
        // line 62
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["exportCataloguesForm"] ?? $this->getContext($context, "exportCataloguesForm")), 'form_end');
        echo "
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/International/Translations/Blocks/export_language.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 62,  84 => 56,  73 => 48,  62 => 41,  51 => 33,  44 => 29,  41 => 28,  39 => 26,  36 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *#}

{% form_theme exportCataloguesForm 'PrestaShopBundle:Admin/TwigTemplateForm:prestashop_ui_kit.html.twig' %}
{% trans_default_domain 'Admin.International.Feature' %}

{{ form_start(exportCataloguesForm, {action: path('admin_international_translations_export_catalogues')}) }}

<div class=\"card export-translations\">
  <h3 class=\"card-header\">
    <i class=\"material-icons\">cloud_upload</i> {{ 'Export a language'|trans }}

    <span
      class=\"help-box\"
      data-container=\"body\"
      data-toggle=\"popover\"
      data-trigger=\"hover\"
      data-placement=\"right\"
      data-content=\"{{ 'Export data from one language to a file (language pack).'|trans({}, 'Admin.International.Help') }}{{ 'Select which theme you would like to export your translations to.'|trans({}, 'Admin.International.Help') }}\"
      title=\"\"
    >
    </span>
  </h3>
  <div class=\"card-block row\">
    <div class=\"card-text\">
      {{ form_rest(exportCataloguesForm) }}
    </div>
  </div>

  <div class=\"card-footer\">
    <div class=\"d-flex justify-content-end\">
      <button class=\"btn btn-primary\" id=\"form-export-language-button\">
        <i class=\"material-icons\">cloud_download</i>
        <span>{{ 'Export'|trans({}, 'Admin.Actions') }}</span>
      </button>
    </div>
  </div>
</div>

{{ form_end(exportCataloguesForm) }}
", "@PrestaShop/Admin/Improve/International/Translations/Blocks/export_language.html.twig", "D:\\webbax\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\International\\Translations\\Blocks\\export_language.html.twig");
    }
}
