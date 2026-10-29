<?php

//var_dump($arResult);

$arResult["DOCUMENT"] = array();
if (isset($arResult["PROPERTIES"]["DOCUMENT"]["VALUE"]) && is_array($arResult["PROPERTIES"]["DOCUMENT"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["DOCUMENT"]["VALUE"] as $FILE) {
        $FILE = CFile::GetFileArray(7);
        if (is_array($FILE))
            $arResult["DOCUMENT"][] = $FILE;

    }
}

/*if(CModule::IncludeModule('iblock'))
{
  $rsElement = CIBlockElement::GetList(
    array(),
    array("=ID"=>121),
    false,
    false,
    array("*")
  );
  if($arElement = $rsElement->Fetch())
  {
    $arFile = CFile::GetFileArray($arElement["DOCUMENT"]);
	  //var_dump($arElement);

  }
}*/


/* $rsProps = CIBlockElement::GetProperty(7,  121, [], []);
  while($arrProps = $rsProps->Fetch()) {
if ($arrProps['PROPERTY_TYPE'] == 'F') {
      $result[$arrProps['CODE']][] = CFile::GetPath($arrProps['VALUE']);
    } 
}*/
//var_dump($result['DOCUMENT'][0]);
?>