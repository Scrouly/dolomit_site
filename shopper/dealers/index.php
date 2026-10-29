<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Дилеры");
?>
<div class="banner-dealers"></div>

<section class="wrapper-vacancy">

	<div class="dealersv-header">
		<h1>Дилеры</h1>
	</div>

	<div class="dealers-all">
		<?php
		if (CModule::IncludeModule("iblock")) {
			$arFilter = array('IBLOCK_ID' => 21, 'GLOBAL_ACTIVE' => 'Y', );
			$db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
			while ($ar_result = $db_list->GetNext()) { ?>

				<div class="dealers-country">
					<div class="dealers-country-header ">
						<img src="<?= CFile::GetPath($ar_result["PICTURE"]) ?>">
						<h3>
							<?= $ar_result['NAME'] . ':' ?>
						</h3>
					</div>
					<div class="dealers-country-section">
						<?php
						$arFilterProducts = array("IBLOCK_ID" => 21, "IBLOCK_SECTION_ID" => $ar_result['ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
						$res = CIBlockElement::GetList(array(), $arFilterProducts, false, array());

						while ($ob = $res->GetNextElement()) {
							$arFields = $ob->GetFields(); ?>

							<div class="dealers-country-box ">
								<h6>
									<?= $arFields['NAME'] ?>
								</h6>
								<div class="dealers-country-item ">
									<?php
									$dbEll = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 21, 'ID' => $arFields['ID']));
									while ($obEll = $dbEll->GetNextElement()) {
										$propsr = $obEll->GetProperties();
										if ($propsr['SALES_TERRITORY']["CODE"] == "SALES_TERRITORY") {
											?>
											<div class="dealers-item">
												<svg width="24" height="24" flex-shrink: "0" viewBox="0 0 24 24" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<g id="Location_on">
														<path id="Vector"
															d="M20.5 3L20.34 3.03L15 5.1L9 3L3.36 4.9C3.15 4.97 3 5.15 3 5.38V20.5C3 20.78 3.22 21 3.5 21L3.66 20.97L9 18.9L15 21L20.64 19.1C20.85 19.03 21 18.85 21 18.62V3.5C21 3.22 20.78 3 20.5 3ZM10 5.47L14 6.87V18.53L10 17.13V5.47ZM5 6.46L8 5.45V17.15L5 18.31V6.46ZM19 17.54L16 18.55V6.86L19 5.7V17.54Z"
															fill="white" />
													</g>
												</svg>
												<span>
													Территория продаж:
													<?php
													foreach ($propsr['SALES_TERRITORY']['VALUE'] as &$value) {

														echo $value . ' ';
													}
													unset($value); ?>
												</span>
											</div>
										<? }
										if ($propsr['TYPES_PRODUCTS']["CODE"] == "TYPES_PRODUCTS") {
											?>
											<div class="dealers-item">

												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
													fill="none">
													<path
														d="M22 7.53484H13V9.53484H22V7.53484ZM22 15.5348H13V17.5348H22V15.5348ZM5.54 11.5348L2 7.99484L3.41 6.58484L5.53 8.70484L9.77 4.46484L11.18 5.87484L5.54 11.5348ZM5.54 19.5348L2 15.9948L3.41 14.5848L5.53 16.7048L9.77 12.4648L11.18 13.8748L5.54 19.5348Z"
														fill="white" />
												</svg>
												<span> Виды продукции:
													<?php
													foreach ($propsr['TYPES_PRODUCTS']['VALUE'] as &$value) {
														if (count($propsr['TYPES_PRODUCTS']['VALUE']) > 1) {
															echo $value . ', ';
														} else {
															echo $value . ' ';
														}
													}
													unset($value); ?>
												</span>
											</div>
										<? }
										if ($propsr['ADDRESS_DEALER']["CODE"] == "ADDRESS_DEALER") {
											?>
											<div class="dealers-item">

												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<g id="Location_on">
														<g id="Vector">
															<path
																d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM7 9C7 6.24 9.24 4 12 4C14.76 4 17 6.24 17 9C17 11.88 14.12 16.19 12 18.88C9.92 16.21 7 11.85 7 9Z"
																fill="white" />
															<path
																d="M12 11.5C13.3807 11.5 14.5 10.3807 14.5 9C14.5 7.61929 13.3807 6.5 12 6.5C10.6193 6.5 9.5 7.61929 9.5 9C9.5 10.3807 10.6193 11.5 12 11.5Z"
																fill="white" />
														</g>
													</g>
												</svg>
												<span>
													<?php
													foreach ($propsr['ADDRESS_DEALER']['VALUE'] as &$value) {
														if (count($propsr['ADDRESS_DEALER']['VALUE']) > 1) {
															echo $value . ', ';
														} else {
															echo $value . ' ';
														}
													}
													unset($value); ?>
												</span>
											</div>
										<? }
										if ($propsr['TELEPHONE_DEALER']["CODE"] == "TELEPHONE_DEALER") {
											?>
											<div class="dealers-item">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
													fill="none">
													<path
														d="M6.54 5C6.6 5.89 6.75 6.76 6.99 7.59L5.79 8.79C5.38 7.59 5.12 6.32 5.03 5H6.54ZM16.4 17.02C17.25 17.26 18.12 17.41 19 17.47V18.96C17.68 18.87 16.41 18.61 15.2 18.21L16.4 17.02ZM7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.51C21 15.96 20.55 15.51 20 15.51C18.76 15.51 17.55 15.31 16.43 14.94C16.33 14.9 16.22 14.89 16.12 14.89C15.86 14.89 15.61 14.99 15.41 15.18L13.21 17.38C10.38 15.93 8.06 13.62 6.62 10.79L8.82 8.59C9.1 8.31 9.18 7.92 9.07 7.57C8.7 6.45 8.5 5.25 8.5 4C8.5 3.45 8.05 3 7.5 3Z"
														fill="white" />
												</svg>
												<div class="dealers-item-em-tel">
													<?php
													foreach ($propsr['TELEPHONE_DEALER']['VALUE'] as &$value) {
														echo '<span> ' . $value . '</span>';
													}
													unset($value); ?>
												</div>
											</div>
										<? }
										if ($propsr['EMAIL_DEALER']["CODE"] == "EMAIL_DEALER") {
											?>
											<div class="dealers-item">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
													fill="none">
													<path
														d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6ZM20 6L12 11L4 6H20ZM20 18H4V8L12 13L20 8V18Z"
														fill="white" />
												</svg>
												<div class="dealers-item-em-tel">
													<?php
													foreach ($propsr['EMAIL_DEALER']['VALUE'] as &$value) {
														echo '<span> ' . $value . '</span>';
													}
													unset($value); ?>
												</div>
											</div>
										<? }

									} ?>
								</div>
							</div>
						<? } ?>

					</div>
				</div>
			<?
			}
		}
		?>

	</div>
</section>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>