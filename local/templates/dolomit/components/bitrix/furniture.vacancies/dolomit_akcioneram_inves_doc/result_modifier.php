<?
$arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, array(), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
	// echo "<pre>";
	//  print_r($arFields);
	// echo "</pre>";

    foreach ($arResult["ITEMS"] as $val => $arItem) {
        if ($arItem["ID"] == $arFields["ID"]) {
            $arProps = $ob->GetProperties();

            $arResult["ITEMS"][$val] = $arItem + $arProps;

            foreach ($arProps["DOK_YEAR"]["VALUE"] as $count_id => $arDOK_ID) {
                $arFilter1 = array( 'ID' => $arDOK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                $res_doc = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter1, false, array(), array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*"));
                while ($ob = $res_doc->GetNextElement()) {
                    //$arFields1 = $ob->GetFields();
                    $arProps1 = $ob->GetProperties();
                    $arResult["ITEMS"][$val]["DOCKS_INFO"][] = $arProps1;
                }
            }
        }

    }
}

?>
