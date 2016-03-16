<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PrakruangUtility extends CFormModel {

    public static function getSortData() {
        return array(
            array('field' => 'name', 'by' => 'asc', 'label' => 'ชื่อ ก-ฮ'),
            array('field' => 'name', 'by' => 'desc', 'label' => 'ชื่อ ฮ-ก'),
            array('field' => 'price', 'by' => 'asc', 'label' => 'ราคา น้อย-มาก'),
            array('field' => 'price', 'by' => 'desc', 'label' => 'ราคา มาก-น้อย'),
            array('field' => 'born', 'by' => 'asc', 'label' => 'ปีที่สร้าง น้อย-มาก'),
            array('field' => 'born', 'by' => 'desc', 'label' => ' ปีที่สร้าง มาก-น้อย'),
            array('field' => 'updatedate', 'by' => 'asc', 'label' => 'วันที่ลงประกาศ อดีต-ปัจจุบัน'),
            array('field' => 'updatedate', 'by' => 'desc', 'label' => 'วันที่ลงประกาศ ปัจจุบัน-อดีต'),
        );
    }
    public static function getSortDataByField($field) {
        $fieldSelect = '';
        $sorts = PrakruangUtility::getSortData();
        foreach ($sorts as $index => $sort) {
            if($sort['field'] == $field){
                $fieldSelect = $sort['label'];
            }
        }
        return $fieldSelect;
    }
}
