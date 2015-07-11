<?php

namespace MPWAR\Utils;

class Url
{
    const VARIABLE_PATTERN = "/\{(\w+)\}/";

    const DEFAULT_PATTERN = "\w+";

    private $url;
    private $patterns;

    public function __construct($url)
    {
        $this->url = $url;
        $this->patterns = [];
    }

    public function addPattern($var, $pattern)
    {
        $this->patterns[$var] = $pattern;
    }

    private function convertSlashes($route)
    {
        return "/^" . str_replace("/", "\/", $route) . "$/";
    }

    private function hasVariables($url, &$matches)
    {
        return preg_match_all(self::VARIABLE_PATTERN, $url, $matches);
    }

    private function getVariables($url, array $var_patterns)
    {
        if ($this->hasVariables($url, $matches)) {
            $variables = $matches[1];
            $url_variables = [];
            foreach ($variables as $v) {
                if (isset($var_patterns) && isset($var_patterns[$v])) {
                    $url_variables[$v] = $var_patterns[$v];
                } else {
                    $url_variables[$v] = self::DEFAULT_PATTERN;
                }
            }
            return $url_variables;
        }
        return null;
    }

    private function convertVarsToPatterns($url_preg, $vars)
    {
        if (isset($vars)) {
            foreach ($vars as $var => $pattern) {
                $url_preg = preg_replace("/\{$var\}/", "($pattern)", $url_preg);
            }
        }
        return $url_preg;
    }

    public function convertToRegex()
    {
        $vars = $this->getVariables($this->url, $this->patterns);
        $url_preg = $this->convertSlashes($this->url);
        $url_preg = $this->convertVarsToPatterns($url_preg, $vars);
        return $url_preg;
    }

    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->$property;
        }
        return null;
    }
}
