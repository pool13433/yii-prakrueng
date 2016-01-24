<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utilities {

    public static function getYear($length = 50) {
        $listYear = array();
        $currentYear = date('Y');
        for ($i = $currentYear; $i > ($currentYear - $length); $i--) {
            $listYear[] = $i;
        }
        return $listYear;
    }

}
