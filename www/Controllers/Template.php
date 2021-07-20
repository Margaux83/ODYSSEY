<?php

namespace App;

use App\Core\View;
use App\Core\Error;
use App\Core\Template as CoreTemplate;
use App\Core\ConstantManager;

class Template
{
    private static $templatesPath = './public/styles/themes';


    private function getTemplatesDescriptions() {
        $templatesDescription = [];
        foreach(scandir(self::$templatesPath) as $key=> $founded) {
            if (is_dir(self::$templatesPath . '/' . $founded) && strpos($founded, 'theme_') !== false) {
                if (file_exists(self::$templatesPath . '/' . $founded . '/theme_desc.yml')){
                    $fileDescription = yaml_parse_file(self::$templatesPath . '/' . $founded . '/theme_desc.yml');
                    
                    $templatesDescription[$founded] = $fileDescription;
                }
            }
        };

        return $templatesDescription;
    }
    public function defaultAction() {
        $templates = [];

        foreach ($this->getTemplatesDescriptions() as $key => $templateDescription) {
            $html = '<div>
                <h2 class="templateName' . ($key . '/' === CoreTemplate::getSelectedTheme() ? " selected" :"") . '">' . $templateDescription['name'] . '</h2>
                <p class="templateDesc">' . $templateDescription['description'] . '</p>
                <p class="templateCreators">Créateurs : ' . implode(', ', $templateDescription['creators']) . '</p>
                <div class="templateStatusSection">
                    <p class="templateVersion">Version : ' . $templateDescription['version'] . '</p>
                    ' . ($key . '/' === CoreTemplate::getSelectedTheme() 
                    ? '<p>Sélectionné</p>' 
                    : '<a href="/admin/template-select?selected=' . $key . '">
                        <button>Choisir</button>
                        </a>') . '
                </div>
            </div>';

            if ($key . '/' === CoreTemplate::getSelectedTheme()) {
                array_unshift($templates, $html);
            }else {
                array_push($templates, $html);
            }
        }


        $view = new View("template", "back");
        $view->assign("templates", $templates);
    }

    public function changeAction() {
        $result = CoreTemplate::changeSelectedTheme($_GET['selected'] . '/');

        if ($result) {
            header("Location: /admin/template");
        }else {
            Error::errorPage(400, 'Le changement de template a échouée.');
        }
    }
}