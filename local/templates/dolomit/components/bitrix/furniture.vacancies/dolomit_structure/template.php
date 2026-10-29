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

?>

<div class="wrapper-structure structure-company">

    <div class="tab">
        <?php foreach ($arResult['ITEMS'] as $Item) { ?>
            <button class="tablinks" onclick="openTab(event, '<?= $Item['ID'] . '_struct' ?>')" id="defaultOpen">
                <?= $Item['NAME'] ?>
            </button>
        <? } ?>

    </div>

    <?php foreach ($arResult['ITEMS'] as $Item) { ?>

        <div id="<?= $Item['ID'] . '_struct' ?>" class="tabcontent">
            <?php if ($Item['PROPERTIES']) { ?>
                <div class="head_department">
                    <h6>
                        <?= $Item['PROPERTIES']['WORKER_STRUCTURE']['VALUE'] ?? '' ?>
                    </h6>
                    <div class="telephone_group">
                        <?php
                        foreach ((array)($Item['PROPERTIES']['TELEPHONE_STRUCTURE']['VALUE'] ?? []) as $telephone) {

                            echo '<span class="worker_tel">' . $telephone . '</span>';
                        } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="post-structure-company">
                <?php foreach (($Item['PROPERTIES']['POST_STRUCTURE_ALL'] ?? []) as $structureAll) { ?>

                    <div class="work">
                        <span class="header-work">
                            <?= $structureAll['NAME'] ?>
                        </span>

                        <div class="more_worker">
                            <?php foreach (($structureAll['WORKER_ALL'] ?? []) as $worker) { ?>
                                <div class="one_worker">
                                    <span class="name_work">
                                        <?= $worker['NAME'] ?>
                                        <? if (!empty($worker['POST_WORKER']['VALUE'])) {
                                            echo '-' . $worker['POST_WORKER']['VALUE'];
                                        } ?>
                                    </span>
                                    <div class="telephone_group">
                                        <?php
                                        foreach ((array)($worker['TELEPHONE_WORKER']['VALUE'] ?? []) as $telephone) {

                                            echo '<span class="worker_tel">' . $telephone . '</span>';
                                        } ?>
                                    </div>
                                </div>

                                <?php
                            } ?>
                        </div>
                    </div>
                <?php }
                ?>

            </div>
        </div>
    <?php } ?>

</div>