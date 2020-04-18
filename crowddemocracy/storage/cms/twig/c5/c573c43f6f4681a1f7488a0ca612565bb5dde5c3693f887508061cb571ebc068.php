<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* C:\laragon\www\crowddemocracy/themes/crowddemocracy_vuetober/pages/index.htm */
class __TwigTemplate_d328a12ae64e2cf894b97a4aee2e211a9aa85c6058dd2cad0f724d400ac9f7da extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>

<head>
    
    
    <meta charset=\"utf-8\">
    <meta content=\"IE=edge\" http-equiv=\"X-UA-Compatible\">
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
    <meta name=\"vuetober\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, json_encode(($context["vuetober"] ?? null)), "html", null, true);
        echo "\">

    
    <title>crowddemocracy_vuetober</title>
<link href=\"http://localhost:8080/js/app.js\" rel=\"preload\" as=\"script\"><link href=\"http://localhost:8080/js/chunk-vendors.js\" rel=\"preload\" as=\"script\"></head>

<body>
    <noscript>
        <strong>We're sorry but crowddemocracy_vuetober doesn't work properly without JavaScript enabled. Please enable
            it to continue.</strong>
    </noscript>
    <div id=\"app\"></div>
    
<script type=\"text/javascript\" src=\"http://localhost:8080/js/chunk-vendors.js\"></script><script type=\"text/javascript\" src=\"http://localhost:8080/js/app.js\"></script></body>

</html>";
    }

    public function getTemplateName()
    {
        return "C:\\laragon\\www\\crowddemocracy/themes/crowddemocracy_vuetober/pages/index.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 10,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>

<head>
    
    
    <meta charset=\"utf-8\">
    <meta content=\"IE=edge\" http-equiv=\"X-UA-Compatible\">
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
    <meta name=\"vuetober\" content=\"{{ vuetober | json_encode }}\">

    
    <title>crowddemocracy_vuetober</title>
<link href=\"http://localhost:8080/js/app.js\" rel=\"preload\" as=\"script\"><link href=\"http://localhost:8080/js/chunk-vendors.js\" rel=\"preload\" as=\"script\"></head>

<body>
    <noscript>
        <strong>We're sorry but crowddemocracy_vuetober doesn't work properly without JavaScript enabled. Please enable
            it to continue.</strong>
    </noscript>
    <div id=\"app\"></div>
    
<script type=\"text/javascript\" src=\"http://localhost:8080/js/chunk-vendors.js\"></script><script type=\"text/javascript\" src=\"http://localhost:8080/js/app.js\"></script></body>

</html>", "C:\\laragon\\www\\crowddemocracy/themes/crowddemocracy_vuetober/pages/index.htm", "");
    }
}
