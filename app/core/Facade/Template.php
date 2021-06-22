<?php

namespace App\Core\Facade;

use App\Core\Utils\Template as TemplateServer;

class Template
{
    public static $Path;

    protected $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public static function build()
    {
        return new static(new TemplateServer());
    }

    public function render($file, $variables)
    {
        return $this->template->setPath(self::$Path.$file)
                              ->setVariables($variables)
                              ->render();
    }
}
