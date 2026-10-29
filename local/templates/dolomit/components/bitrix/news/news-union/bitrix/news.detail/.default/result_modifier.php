<?php
$arResult["IMG_BLOCK_RICHT"] = array();
$res = CIBlockElement::GetProperty($arResult["IBLOCK_ID"] , $arResult["ID"], "sort", "asc", array("CODE" => "IMG_BLOCK_RICHT"));
while($ob = $res->GetNext())
    {			
	$file = CFile::GetFileArray($ob['VALUE']);
	if (is_array($file))
			$arResult["IMG_BLOCK_RICHT"][] = $file;
    }
?>



