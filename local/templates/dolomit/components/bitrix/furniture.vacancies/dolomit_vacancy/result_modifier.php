<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
echo '<pre>';
var_dump($arResult["ITEMS"]);
echo '</pre>';
*/
/*
if(CModule::IncludeModule("iblock")){



$arR["PROP"] = array();
   $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");                     
   $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y");                           

   $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);  
	$i=0;
	while($ob = $res->GetNextElement()){ 

		 $arProps = $ob->GetProperties(); 
		  if (is_array($arProps["REQUIREMENTS"])){
			$arR["PROP"]["PROPERTIES"]["REQUIREMENTS"] = $arProps["REQUIREMENTS"];
			$arResult["ITEMS"][$i]=array_merge($arResult["ITEMS"][$i], $arR["PROP"]);
		   }
			 if (is_array($arProps["SALARY"])){
			$arR["PROP"]["PROPERTIES"]["SALARY"] = $arProps["SALARY"];
			$arResult["ITEMS"][$i]=array_merge($arResult["ITEMS"][$i], $arR["PROP"]);
		   }
		$i++;
	   }
}
*/
/*  echo '<pre>';
    print_r($arResult["ITEMS"]);
echo '</pre>';*/

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
			//print_r($arResult["ITEMS"][$val]);
			//echo '</pre>';
		}
	}


} 




	
?>