<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$arProps = array();

$resElement = SelectOr('*', 12);
$flag = 0;




/*while ($obEl = $resElement->GetNextElement()) {
	$arProps = $obEl->GetProperties();

	if (is_array($arProps["WORKER_STRUCTURE"])) {
		$arR["PROP"]["PROPERTIES"]["WORKER_STRUCTURE"] = $arProps["WORKER_STRUCTURE"];
		$arResult["ITEMS"][$flag] = array_merge($arResult["ITEMS"][$flag], $arR["PROP"]);
	}
	if (is_array($arProps["TELEPHONE_STRUCTURE"])) {
		$arR["PROP"]["PROPERTIES"]["TELEPHONE_STRUCTURE"] = $arProps["TELEPHONE_STRUCTURE"];
		$arResult["ITEMS"][$flag] = array_merge($arResult["ITEMS"][$flag], $arR["PROP"]);
	}

	$flag2 = -1;
	foreach ($arProps['POST_STRUCTURE_ALL']['VALUE'] as $index_swork) {
		$flag2++;
		$resElement2 = SelectOrId('*', $index_swork);

		while ($obEl2 = $resElement2->GetNextElement()) {
			$arProps3 = $obEl2->GetProperties();
			$arResul = $obEl2->GetFields();

			$arR2["PROPERTIES"]["POST_STRUCTURE_ALL"][$flag2]["NAME"] = $arResul["NAME"];

			$flag3 = -1;
			foreach ($arProps3['S_WORKER']['VALUE'] as $index) {
				$flag3++;
				$resElement3 = SelectOrId('*', $index);
				while ($obEl3 = $resElement3->GetNextElement()) {

					$arProps3 = $obEl3->GetProperties();
					$arResul3 = $obEl3->GetFields();
					$arR2["PROPERTIES"]["POST_STRUCTURE_ALL"][$flag2]["WORKER_ALL"][$flag3]["NAME"] = $arResul3["NAME"];
					$arR2["PROPERTIES"]["POST_STRUCTURE_ALL"][$flag2]["WORKER_ALL"][$flag3]["POST_WORKER"]
						= $arProps3["POST_WORKER"];
					$arR2["PROPERTIES"]["POST_STRUCTURE_ALL"][$flag2]["WORKER_ALL"][$flag3]['TELEPHONE_WORKER']
						= $arProps3['TELEPHONE_WORKER'];
				}
			}
		}
}

	$arResult["ITEMS"][$flag]["PROPERTIES"] = array_merge($arResult["ITEMS"][$flag]["PROPERTIES"], $arR2["PROPERTIES"]);
$arR2= array();
	$flag++;
}*/


function SelectOr($Select, $IBLOCK_ID)
{
	$resElement = \CIBlockElement::GetList(
		[],
		[
			'IBLOCK_ID' => $IBLOCK_ID
		],
		false,
		false,
		['' . $Select . '']
	);
	return $resElement;
}

function SelectOrId($Select, $ID)
{
	$resElement5 = \CIBlockElement::GetList(
		[],
		[
			'ID' => $ID,
		],
		false,
		false,
		['' . $Select . '']
	);
	return $resElement5;
}


?>