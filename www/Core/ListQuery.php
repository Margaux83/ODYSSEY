<?php

namespace App\Core;

class ListQuery
{
    public static function getSimpleList($elementQuery) {
        $legendHtml = '<li class="legend">';

        $elementClass = "App\\Models\\".$elementQuery['element'];
            
        if (class_exists($elementClass)){
            $entity = new $elementClass;

            $resultsQuery = $entity->query(array_keys($elementQuery['columns']));
        }else {
            return [];
        }

        $resultsList = [];

        foreach ($resultsQuery as $keyResult => $result) {
            $index = 0;
            $resultHtml = '<li class="listItem">';

            foreach ($elementQuery['columns'] as $keyColumn => $column) {
                if ($keyResult === 0){
                    $legendHtml .= '<p class="flex-weight-'.($column['size'] ? $column['size'] : 1).'">'.$column['label'].'</p>';
                }

                if (array_key_exists('combo', $column)){
                    $elementClass = "App\\Models\\".$column['combo']['element'];

                    if (class_exists($elementClass)){
                        $entity = new $elementClass;
            
                        $resultCombo = $entity->query(
                            $column['combo']['columns'], 
                            [
                                $column['combo']['filterKey'] => $result[$index]
                            ]
                        )[0];

                        $resultComboString = [];
                        
                        foreach ($column['combo']['columns'] as $comboColumn) {
                            array_push($resultComboString, $resultCombo[$comboColumn]);
                        } 
                        
                        $resultHtml .= '<p class="flex-weight-'.($column['size'] ? $column['size'] : 1).'">'
                                .implode(' ', $resultComboString)
                            .'</p>';
                    }
                }else {
                    $resultHtml .= '<p class="flex-weight-'.($column['size'] ? $column['size'] : 1).'">'
                            .$result[$index]
                        .'</p>';
                }
                $index ++;
            }
            $resultHtml .= '</li>';
            array_push($resultsList, $resultHtml);
        }

        $legendHtml .= '</li>';

        return array_merge([$legendHtml], $resultsList);
    }
}