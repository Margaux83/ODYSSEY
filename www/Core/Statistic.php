<?php

namespace App\Core;

class Statistic {

    /**
     * @param $elements
     * @param string $intervalDays
     * @return array
     * TODO : Mettre un commentaire d'explication
     */
    public static function getSimpleStatistics($elements, $intervalDays = '15') {
        $listStatistics = [];
        foreach ($elements as $key => $element) {
            $elementClass = "App\\Models\\".$element['element'];

            $newElement = new $elementClass;

            $date = date_create(date("y-m-d"));
            date_sub($date, date_interval_create_from_date_string($intervalDays . ' days'));
            $firstDate = date_format($date, 'Y-m-d');
            
            $queryResults = $newElement->query(['id', 'creationDate'], $element['filter'], "creationDate BETWEEN '" . $firstDate . "' AND '".date("y-m-d")."'");
            $queryAllResults = $newElement->query(['id', 'creationDate'], $element['filter']);

            $averageResults = self::averageStat(count($queryAllResults), $intervalDays);

            array_push($listStatistics, '<article id="'.$key.'" class="statisticsBasic">'
                .'<h1>'.$element["label"].'</h1>'
                .'<div>'
                    .'<h2 class="numberStat numberStat-' . (count($queryResults) > $averageResults ? 'positive' : (count($queryResults) == $averageResults ? 'neutral' : 'negative')) .'">'.count($queryResults).'</h2>'
                    .'<p>Depuis ' . $intervalDays . ' jour' . ($intervalDays > 1 ? 's' : '') . '</p>'
                    .'<p>Moyenne : '. $averageResults .'</p>'
                .'</div>'
        .   '</article>');
        }
        return $listStatistics;
    }

    public function averageStat($somme, $interval) {
        return round($somme / $interval, 2);
    }
}