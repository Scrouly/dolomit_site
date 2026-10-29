<?
$arResult["ATR_FOTOS"] = array();
if(isset($arResult["PROPERTIES"]["ATR_FOTOS"]["VALUE"]) && is_array($arResult["PROPERTIES"]["ATR_FOTOS"]["VALUE"]))
{
foreach($arResult["PROPERTIES"]["ATR_FOTOS"]["VALUE"] as $FILE)
{
$FILE = CFile::GetFileArray($FILE);
if(is_array($FILE))
$arResult["ATR_FOTOS"][]=$FILE;
}
}
?>