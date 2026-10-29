<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

// ID элемента => ключ в $arResult["ITEMS"]
$idToKey = [];
foreach ($arResult["ITEMS"] as $key => $item) {
	$idToKey[$item["ID"]] = $key;
}

$resElement = SelectOr('*', $arParams["IBLOCK_ID"]);
while ($obEl = $resElement->GetNextElement()) {
	$fields = $obEl->GetFields();
	if (!isset($idToKey[$fields["ID"]])) {
		continue; // нет в выборке компонента (неактивен и т.п.)
	}
	$key = $idToKey[$fields["ID"]];
	$arProps = $obEl->GetProperties();

	if (!isset($arResult["ITEMS"][$key]["PROPERTIES"]) || !is_array($arResult["ITEMS"][$key]["PROPERTIES"])) {
		$arResult["ITEMS"][$key]["PROPERTIES"] = [];
	}
	$props = &$arResult["ITEMS"][$key]["PROPERTIES"];

	if (is_array($arProps["WORKER_STRUCTURE"])) {
		$props["WORKER_STRUCTURE"] = $arProps["WORKER_STRUCTURE"];
	}
	if (is_array($arProps["TELEPHONE_STRUCTURE"])) {
		$props["TELEPHONE_STRUCTURE"] = $arProps["TELEPHONE_STRUCTURE"];
	}

	$posts = [];
	$flag2 = -1;
	foreach ((array)$arProps['POST_STRUCTURE_ALL']['VALUE'] as $postId) {
		$resElement2 = SelectOrId('*', $postId);
		while ($obEl2 = $resElement2->GetNextElement()) {
			$flag2++;
			$postProps  = $obEl2->GetProperties();
			$postFields = $obEl2->GetFields();

			$posts[$flag2]["NAME"] = $postFields["NAME"];
			$posts[$flag2]["WORKER_ALL"] = [];

			$flag3 = -1;
			foreach ((array)$postProps['S_WORKER']['VALUE'] as $workerId) {
				$resElement3 = SelectOrId('*', $workerId);
				while ($obEl3 = $resElement3->GetNextElement()) {
					$flag3++;
					$workerProps  = $obEl3->GetProperties();
					$workerFields = $obEl3->GetFields();

					$posts[$flag2]["WORKER_ALL"][$flag3] = [
						"NAME"             => $workerFields["NAME"],
						"POST_WORKER"      => $workerProps["POST_WORKER"],
						"TELEPHONE_WORKER" => $workerProps["TELEPHONE_WORKER"],
					];
				}
			}
		}
	}
	$props["POST_STRUCTURE_ALL"] = $posts;
	unset($props);
}

function SelectOr($Select, $IBLOCK_ID)
{
	return \CIBlockElement::GetList(
		[],
		['IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'],
		false,
		false,
		[$Select]
	);
}

function SelectOrId($Select, $ID)
{
	return \CIBlockElement::GetList(
		[],
		['ID' => $ID, 'ACTIVE' => 'Y'],
		false,
		false,
		[$Select]
	);
}
?>