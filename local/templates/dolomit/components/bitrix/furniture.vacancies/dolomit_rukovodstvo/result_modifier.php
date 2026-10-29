<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*$arProps = array(); 


	$dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE"=>"management", "IBLOCK_ID"=> $arParams["IBLOCK_ID"]));
	$index=0;
	while ($obEl = $dbEl->GetNextElement())
	{

	 $arProps = $obEl->GetProperties(); 

	
		 if (is_array($arProps["RUKOVODSTVO_FOTO"])){
            $arR["PROP"]["PROPERTIES"]["RUKOVODSTVO_FOTO"] = $arProps["RUKOVODSTVO_FOTO"];
            $arResult["ITEMS"][$index]=array_merge($arResult["ITEMS"][$index], $arR["PROP"]);
           }
         if (is_array($arProps["RUKOVODSTVO_NAME"])){
            $arR["PROP"]["PROPERTIES"]["RUKOVODSTVO_NAME"] = $arProps["RUKOVODSTVO_NAME"];
            $arResult["ITEMS"][$index]=array_merge($arResult["ITEMS"][$index], $arR["PROP"]);
           }
         if (is_array($arProps["RUKOVODSTVO_POST"])){
            $arR["PROP"]["PROPERTIES"]["RUKOVODSTVO_POST"] = $arProps["RUKOVODSTVO_POST"];
            $arResult["ITEMS"][$index]=array_merge($arResult["ITEMS"][$index], $arR["PROP"]);
           }
		 if (is_array($arProps["RUKOVODSTVO_PHONE"])){
            $arR["PROP"]["PROPERTIES"]["RUKOVODSTVO_PHONE"] = $arProps["RUKOVODSTVO_PHONE"];
            $arResult["ITEMS"][$index]=array_merge($arResult["ITEMS"][$index], $arR["PROP"]);
           }
        $index++;
      }
*/
$arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*"); 

$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, array(), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    foreach ($arResult["ITEMS"] as $val=> $arItem){
        if($arItem["ID"] == $arFields["ID"] ){
            $arProps = $ob->GetProperties();

            $arResult["ITEMS"][$val]=$arItem+$arProps;
			//echo '<pre>';
			// print_r($arResult["ITEMS"][$val]);
			// echo '</pre>';
        }
    }


} 






?>
