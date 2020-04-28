<?php

/* settings-ui.twig */
class __TwigTemplate_557cbc4c5acf24bef01bf76649ff183265164711f8995b9be56b27812a877929 extends Twig_Template
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
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["form"] ?? null), "action", array()), "html", null, true);
        echo "\">

    <div class=\"wcml-section\">
        <div class=\"wcml-section-header\">
            <h3>
                ";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "translation_interface", array()), "heading", array()), "html", null, true);
        echo "
                <i class=\"otgs-ico-help wcml-tip\" data-tip=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "translation_interface", array()), "tip", array()), "html", null, true);
        echo "\"></i>
            </h3>
        </div>
        <div class=\"wcml-section-content\">

            <ul>
                <li>
                    <input type=\"radio\" name=\"trnsl_interface\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["wpml_translation"] ?? null), "html", null, true);
        echo "\"
                            ";
        // line 15
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "translation_interface", array()), "controls_value", array()) == ($context["wpml_translation"] ?? null))) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_trsl_interface_wcml\" />
                    <label for=\"wcml_trsl_interface_wcml\">";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "translation_interface", array()), "wcml", array()), "label", array()), "html", null, true);
        echo "</label>
                </li>
                <li>
                    <input type=\"radio\" name=\"trnsl_interface\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["native_translation"] ?? null), "html", null, true);
        echo "\"
                            ";
        // line 20
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "translation_interface", array()), "controls_value", array()) == ($context["native_translation"] ?? null))) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_trsl_interface_native\" />
                    <label for=\"wcml_trsl_interface_native\">";
        // line 21
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "translation_interface", array()), "native", array()), "label", array());
        echo "</label>
                </li>
            </ul>

        </div> <!-- .wcml-section-content -->

    </div> <!-- .wcml-section -->

    <div class=\"wcml-section\">

        <div class=\"wcml-section-header\">
            <h3>
                ";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "synchronization", array()), "heading", array()), "html", null, true);
        echo "
                <i class=\"otgs-ico-help wcml-tip\" data-tip=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "synchronization", array()), "tip", array()), "html", null, true);
        echo "\"></i>
            </h3>
        </div>

        <div class=\"wcml-section-content\">

            <ul>
                <li>
                    <input type=\"checkbox\" name=\"products_sync_date\" value=\"1\"
                            ";
        // line 43
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "synchronization", array()), "sync_date", array()), "value", array()) == 1)) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_products_sync_date\" />
                    <label for=\"wcml_products_sync_date\">";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "synchronization", array()), "sync_date", array()), "label", array()), "html", null, true);
        echo "</label>
                </li>
                <li>
                    <input type=\"checkbox\" name=\"products_sync_order\" value=\"1\"
                            ";
        // line 48
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "synchronization", array()), "sync_order", array()), "value", array()) == 1)) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_products_sync_order\" />
                    <label for=\"wcml_products_sync_order\">";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "synchronization", array()), "sync_order", array()), "label", array()), "html", null, true);
        echo "</label>
                </li>
            </ul>

        </div>

    </div>


    <div class=\"wcml-section\">

        <div class=\"wcml-section-header\">
            <h3>
                ";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "file_sync", array()), "heading", array()), "html", null, true);
        echo "
                <i class=\"otgs-ico-help wcml-tip\" data-tip=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "file_sync", array()), "tip", array()), "html", null, true);
        echo "\"></i>
            </h3>
        </div>

        <div class=\"wcml-section-content\">

            <ul>
                <li>
                    <input type=\"radio\" name=\"wcml_file_path_sync\" value=\"1\"
                            ";
        // line 72
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "file_sync", array()), "value", array()) == 1)) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_file_path_sync_auto\" />
                    <label for=\"wcml_file_path_sync_auto\">";
        // line 73
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "file_sync", array()), "label_same", array()), "html", null, true);
        echo "</label>
                </li>
                <li>
                    <input type=\"radio\" name=\"wcml_file_path_sync\" value=\"0\"
                            ";
        // line 77
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "file_sync", array()), "value", array()) == 0)) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_file_path_sync_self\" />
                    <label for=\"wcml_file_path_sync_self\">";
        // line 78
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "file_sync", array()), "label_diff", array()), "html", null, true);
        echo "</label>
                </li>
            </ul>


        </div> <!-- .wcml-section-content -->

    </div> <!-- .wcml-section -->


    <div class=\"wcml-section cart-sync-section\">
        <div class=\"wcml-section-header\">
            <h3>
                ";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "heading", array()), "html", null, true);
        echo "
                <i class=\"otgs-ico-help wcml-tip\" data-tip=\"";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "tip", array()), "html", null, true);
        echo "\"></i>
            </h3>
        </div>
        <div class=\"wcml-section-content\">

            ";
        // line 97
        if ( !$this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "wpml_cookie_enabled", array())) {
            // line 98
            echo "                <i class=\"otgs-ico-warning\"></i>
                <strong>";
            // line 99
            echo $this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "cookie_not_enabled_message", array());
            echo "</strong>
            ";
        }
        // line 101
        echo "
            <div class=\"wcml-section-content-inner\">
                <h4>
                    ";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "lang_switch", array()), "heading", array()), "html", null, true);
        echo "
                </h4>
                <ul>
                    <li>
                        <input type=\"radio\" name=\"cart_sync_lang\" value=\"";
        // line 108
        echo twig_escape_filter($this->env, ($context["wcml_cart_sync"] ?? null), "html", null, true);
        echo "\"
                                ";
        // line 109
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "lang_switch", array()), "value", array()) == ($context["wcml_cart_sync"] ?? null))) {
            echo " checked=\"checked\"";
        }
        // line 110
        echo "                                ";
        if ( !$this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "wpml_cookie_enabled", array())) {
            echo " disabled=\"disabled\"";
        }
        // line 111
        echo "                               id=\"wcml_cart_sync_lang_sync\" />
                        <label for=\"wcml_cart_sync_lang_sync\">";
        // line 112
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "lang_switch", array()), "sync_label", array());
        echo "</label>
                    </li>
                    <li>
                        <input type=\"radio\" name=\"cart_sync_lang\" value=\"";
        // line 115
        echo twig_escape_filter($this->env, ($context["wcml_cart_clear"] ?? null), "html", null, true);
        echo "\"
                                ";
        // line 116
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "lang_switch", array()), "value", array()) == ($context["wcml_cart_clear"] ?? null))) {
            echo " checked=\"checked\"";
        }
        // line 117
        echo "                                ";
        if ( !$this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "wpml_cookie_enabled", array())) {
            echo " disabled=\"disabled\"";
        }
        // line 118
        echo "                               id=\"wcml_cart_sync_lang_clear\" />
                        <label for=\"wcml_cart_sync_lang_clear\">";
        // line 119
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "lang_switch", array()), "clear_label", array());
        echo "</label>
                    </li>
                </ul>
            </div>
            <div class=\"wcml-section-content-inner\">
                <h4>
                    ";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "currency_switch", array()), "heading", array()), "html", null, true);
        echo "
                </h4>
                <ul>
                    <li>
                        <input type=\"radio\" name=\"cart_sync_currencies\" value=\"";
        // line 129
        echo twig_escape_filter($this->env, ($context["wcml_cart_sync"] ?? null), "html", null, true);
        echo "\"
                                ";
        // line 130
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "currency_switch", array()), "value", array()) == ($context["wcml_cart_sync"] ?? null))) {
            echo " checked=\"checked\"";
        }
        // line 131
        echo "                                ";
        if ( !$this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "wpml_cookie_enabled", array())) {
            echo " disabled=\"disabled\"";
        }
        // line 132
        echo "                               id=\"wcml_cart_sync_curr_sync\" />
                        <label for=\"wcml_cart_sync_curr_sync\">";
        // line 133
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "currency_switch", array()), "sync_label", array());
        echo "</label>
                    </li>
                    <li>
                        <input type=\"radio\" name=\"cart_sync_currencies\" value=\"";
        // line 136
        echo twig_escape_filter($this->env, ($context["wcml_cart_clear"] ?? null), "html", null, true);
        echo "\"
                                ";
        // line 137
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "currency_switch", array()), "value", array()) == ($context["wcml_cart_clear"] ?? null))) {
            echo " checked=\"checked\"";
        }
        // line 138
        echo "                                ";
        if ( !$this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "wpml_cookie_enabled", array())) {
            echo " disabled=\"disabled\"";
        }
        // line 139
        echo "                               id=\"wcml_cart_sync_curr_clear\" />
                        <label for=\"wcml_cart_sync_curr_clear\">";
        // line 140
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "currency_switch", array()), "clear_label", array());
        echo "</label>
                    </li>
                </ul>
                <p>
                    ";
        // line 144
        echo $this->getAttribute($this->getAttribute(($context["form"] ?? null), "cart_sync", array()), "doc_link", array());
        echo "
                </p>
            </div>
        </div> <!-- .wcml-section-content -->

    </div> <!-- .wcml-section -->

    ";
        // line 151
        echo $this->getAttribute(($context["form"] ?? null), "nonce", array());
        echo "
    <p class=\"wpml-margin-top-sm\">
        <input type='submit' name=\"wcml_save_settings\" value='";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute(($context["form"] ?? null), "save_label", array()), "html", null, true);
        echo "' class='button-primary'/>
    </p>
</form>
<a class=\"alignright\" href=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->getAttribute(($context["troubleshooting"] ?? null), "url", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["troubleshooting"] ?? null), "label", array()), "html", null, true);
        echo "</a>";
    }

    public function getTemplateName()
    {
        return "settings-ui.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  339 => 156,  333 => 153,  328 => 151,  318 => 144,  311 => 140,  308 => 139,  303 => 138,  299 => 137,  295 => 136,  289 => 133,  286 => 132,  281 => 131,  277 => 130,  273 => 129,  266 => 125,  257 => 119,  254 => 118,  249 => 117,  245 => 116,  241 => 115,  235 => 112,  232 => 111,  227 => 110,  223 => 109,  219 => 108,  212 => 104,  207 => 101,  202 => 99,  199 => 98,  197 => 97,  189 => 92,  185 => 91,  169 => 78,  163 => 77,  156 => 73,  150 => 72,  138 => 63,  134 => 62,  118 => 49,  112 => 48,  105 => 44,  99 => 43,  87 => 34,  83 => 33,  68 => 21,  62 => 20,  58 => 19,  52 => 16,  46 => 15,  42 => 14,  32 => 7,  28 => 6,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "settings-ui.twig", "/www/apache/domains/www.aesti.ee/htdocs/wp-content/plugins/woocommerce-multilingual/templates/settings-ui.twig");
    }
}
