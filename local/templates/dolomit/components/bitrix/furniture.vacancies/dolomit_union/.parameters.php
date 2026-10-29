<?
 if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

 $arTemplateParameters = array(
     'SLIDER_EFFECT' =>  array(
         'NAME'      =>  'Эффект смены слайдов',
         'TYPE'      =>  'LIST',
         'SORT'      =>  '10',
         'VALUES'    =>  array(
             'sliding'   =>  'Скольжение',
             'fading'    =>  'Затухание',
         ),
         'MULTIPLE'  =>  'N',
     ),
     'SLIDER_TIME'   =>  array(
         'NAME'      =>  'Скорочть смены слайдов (мс)',
         'TYPE'      =>  'STRING',
         'SORT'      =>  '20',
         'DEFAULT'   =>  '5000',
     ),
 );
 ?>