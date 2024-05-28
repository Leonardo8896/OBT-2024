<?php

namespace Obt\Iss;

class Render
{
    private string $view_content;

    public function __construct($view)
    {
        $this->view_content = file_get_contents(VIEW_FOLDER.$view.'.view');
    }

    public function replace($find, $replace): Render
    {
        $this->view_content = str_replace($find, $replace, $this->view_content);
        return $this;
    }

    public function renderView(): void
    {
        ob_clean();
        echo $this->view_content;
    }
}