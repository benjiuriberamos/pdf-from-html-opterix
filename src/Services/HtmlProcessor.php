<?php

namespace App\Services;

class HtmlProcessor {
    private $html;
    private $css;

    public function __construct($html) {
        $this->html = $html;
        $this->css = '';
    }

    // Método para añadir CSS
    public function addCss($css) {
        $this->css .= "<style>{$css}</style>";
    }

    // Método para eliminar script tags
    public function removeScriptTags() {
        $this->html = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', '', $this->html);
    }

    // Método para reemplazar enlaces de imágenes
    public function replaceImageLinks($oldUrl, $newUrl) {
        $this->html = str_replace($oldUrl, $newUrl, $this->html);
    }

    // Método para obtener el HTML procesado
    public function getProcessedHtml() {
        // Añadir el CSS al HTML
        return $this->html .$this->css;
    }
}

