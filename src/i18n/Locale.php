<?php
//TODO: Finish i18n implementation.
namespace MPWAR\i18n;

class Locale
{
    public function __construct()
    {
        // Set language to defaultLocale
        putenv('LANG='.\MPWAR\AppConfig::defaultLocale());

    }
}
