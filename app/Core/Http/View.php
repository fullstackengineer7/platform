<?php

declare(strict_types=1);

namespace App\Core\Http;

use Smarty;

class View
{
    private Smarty $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('resources/templates/');
        $this->smarty->setCompileDir('storage/cache/templates');
        $this->smarty->setCacheDir('storage/cache/cache');
    }

    public function render(string $template, array $data = []): Response
    {
        $response = new Response();

        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        ob_start();
        $this->smarty->display($template);
        $content = ob_get_clean();

        $response->setContent($content);
        return $response;
    }
}
