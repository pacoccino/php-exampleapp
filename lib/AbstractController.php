<?php

namespace Lib;

abstract class AbstractController {
    protected function renderView(string $templateName, array $data = [], array $seo = []): string {
        $templatePath = dirname(__DIR__, 1).'/templates/pages/'.$templateName.'.php';
        return require_once dirname(__DIR__, 1).'/templates/layout.php';
    }

    protected function redirect(string $page, array $params = []) {
        $uri = $_SERVER['SCRIPT_NAME']."?page=".$page;

        if(!empty($params)) {
            foreach($params as $key => $val) {
                $uri .= '&'.urlencode((string)$key).'='.urlencode((string)$val);
            }
        }

        header("Location: ".$uri);
        die;
    }
}

?>