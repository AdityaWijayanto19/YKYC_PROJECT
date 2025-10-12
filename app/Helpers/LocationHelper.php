<?php

namespace App\Helpers;

class LocationHelper
{
   
    public static function isPointInPolygon(array $point, array $polygon): bool
    {
        $isInside = false;
        $latitude = $point[0];
        $longitude = $point[1];
        $vertices = count($polygon);

        for ($i = 0, $j = $vertices - 1; $i < $vertices; $j = $i++) {
            $vertexI_lat = $polygon[$i][0];
            $vertexI_lng = $polygon[$i][1];
            $vertexJ_lat = $polygon[$j][0];
            $vertexJ_lng = $polygon[$j][1];

            $intersect = (($vertexI_lng > $longitude) != ($vertexJ_lng > $longitude))
                && ($latitude < ($vertexJ_lat - $vertexI_lat) * ($longitude - $vertexI_lng) / ($vertexJ_lng - $vertexI_lng) + $vertexI_lat);

            if ($intersect) {
                $isInside = !$isInside;
            }
        }

        return $isInside;
    }
}