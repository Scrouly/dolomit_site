<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


$doc_year = array();

$arFilter1 = array("IBLOCK_ID" => '39','ID'=>$arResult["ITEMS"]["DOK_YEAR"]["VALUE"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter1, false, array(), $arSelect1);
while ($ob = $res->GetNextElement()) {
 $arFields1 = $ob->GetFields();
 $arProps = $ob->GetProperties();

$doc_year[]= $arProps["DOKUMENT_YEAR"]["VALUE"];
}

$doc_year=array_values(array_unique($doc_year));
arsort($doc_year);
$doc_year=array_values($doc_year);
?>

 <div class="row">
            <div class="table-responsive tables-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-tr-th" scope="col"><?=GetMessage("DOKUMENT_LABEL")?></th>
<?php 
 foreach ($doc_year as $doc_year_val){	 echo   "<th scope="."col".">". $doc_year_val ."</th>";
 }
?>
</tr>
                    </thead>

                    <tbody>
<?  foreach ($arResult["ITEMS"] as $val=> $arItem){  ?>
                        <tr>
                            <th class="table-tr-th" scope="row"><?=$arItem["NAME"] ?></th>
<?
$flag_year = 0;
foreach ($arItem["DOCKS_INFO"] as $doc_info_val) {



    foreach ($doc_year as $key => $doc_year_val) {
		if ($key== $flag_year){

        if ($doc_year_val == $doc_info_val["DOKUMENT_YEAR"]["VALUE"]) {
          ?>

<td><a href="<? echo CFile::GetPath($doc_info_val["DOKUMENT_SY"]["VALUE"]); ?>" target="_blank"></a></td>

<?
			 $flag_year++;
            break;
        } else {
			echo "<td> </td>";
			$flag_year++;
        }

	}
    }
}
?>
                        </tr>
						<? }?>
                    </tbody>
                </table>
            </div>
        </div>

<?

//   echo "<pre>";
//    print_r($arResult["ITEMS"]);
//    echo "</pre>"; 

