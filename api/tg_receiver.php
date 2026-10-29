<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, TRUE);

// --- Проверка токена ---
require_once $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/api_auth.php';
dolomit_api_require_token($data, 'tg', 'TG_SECRET_TOKEN');

// --- Маршрутизация по разделам ---
$target_section = $data['target_section'] ?? 'news';

if ($target_section === 'union') {
    // Профсоюзная жизнь
    $iblock_ru = 19;
    $prop_gallery_ru = 57;
    $iblock_by = 34;
    $prop_gallery_by = 91;
} else {
    // Новости (по умолчанию)
    $iblock_ru = 1;
    $prop_gallery_ru = 71;
    $iblock_by = 33;
    $prop_gallery_by = 90;
}

// --- Данные для публикации ---
$title             = $data['title'];
$text              = $data['text'];
$preview_ai        = $data['preview'];
$image_urls        = $data['image_urls'];
$active_from       = $data['active_from'];
$preview_image_url = $data['preview_image_url'] ?? null;

$publish_by = !empty($data['publish_by']);
$title_by   = $data['title_by']   ?? '';
$preview_by = $data['preview_by'] ?? '';
$text_by    = $data['text_by']    ?? '';

// --- Единый символьный код ---
$arParams = ["replace_space" => "-", "replace_other" => "-"];
$code = CUtil::translit($title, "ru", $arParams);
$code = mb_strtolower(mb_substr($code, 0, 40)) . '-' . time();

// --- Вспомогательные функции ---
function build_preview($preview_ai, $text) {
    if (!empty($preview_ai)) return trim($preview_ai);
    $clean = strip_tags($text, '<a>');
    $clean = preg_replace('/\s+/', ' ', str_replace(["\n","\r"], ' ', $clean));
    if (mb_strlen($clean) > 170) {
        $clean = mb_substr($clean, 0, mb_strrpos(mb_substr($clean,0,170), ' ')) . '...';
    }
    return trim($clean);
}

function prepare_preview_image($url) {
    $img_data = @file_get_contents($url);
    if (!$img_data) return false;
    $info = @getimagesizefromstring($img_data);
    if (!$info) return false;
    $src = @imagecreatefromstring($img_data);
    if (!$src) return false;

    $w = imagesx($src); $h = imagesy($src);
    $tr = 4/3;
    if (abs($w/$h - $tr) > 0.02) {
        if ($w/$h > $tr) {
            $nw = (int)($h*$tr); $dst = imagecreatetruecolor($nw,$h);
            imagecopy($dst,$src,0,0,(int)(($w-$nw)/2),0,$nw,$h);
        } else {
            $nh = (int)($w/$tr); $dst = imagecreatetruecolor($w,$nh);
            imagecopy($dst,$src,0,0,0,(int)(($h-$nh)/2),$w,$nh);
        }
        imagedestroy($src); $src = $dst;
    }
    $tmp = tempnam(sys_get_temp_dir(),'bitrix_').'.jpg';
    imagejpeg($src,$tmp,90); imagedestroy($src);
    return $tmp;
}

// --- Подготовка картинок ---
$src_url = $preview_image_url ?: ($image_urls[0] ?? null);
$tmp_path = null; $arPic = [];
if ($src_url) {
    $tmp_path = prepare_preview_image($src_url);
    if ($tmp_path && file_exists($tmp_path)) $arPic = CFile::MakeFileArray($tmp_path);
}

$prop_images = [];
foreach (array_values($image_urls ?? []) as $i => $url) {
    $prop_images["n$i"] = ["VALUE" => CFile::MakeFileArray($url)];
}

// --- Создание элемента ---
function create_news($iblock_id, $title, $preview, $text, $code,
                     $active_from, $arPic, $prop_images, $gallery_prop_id) {
    $el  = new CIBlockElement;
    $id  = $el->Add([
        "MODIFIED_BY"       => 1,
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID"         => $iblock_id,
        "NAME"              => $title,
        "CODE"              => $code,
        "ACTIVE"            => "Y",
        "ACTIVE_FROM"       => $active_from,
        "PREVIEW_TEXT"      => $preview,
        "PREVIEW_TEXT_TYPE" => "text",
        "DETAIL_TEXT"       => $text,
        "DETAIL_TEXT_TYPE"  => "html",
        "PREVIEW_PICTURE"   => $arPic,
        "PROPERTY_VALUES"   => [$gallery_prop_id => $prop_images],
    ]);
    return [$id, $el->LAST_ERROR];
}

// === Публикация русской версии ===
[$id_ru, $err_ru] = create_news(
    $iblock_ru, $title,
    build_preview($preview_ai, $text), $text,
    $code, $active_from, $arPic, $prop_images,
    $prop_gallery_ru
);

if (!$id_ru) {
    if ($tmp_path) @unlink($tmp_path);
    die(json_encode(['status'=>'error','msg'=>"RU: $err_ru"]));
}

// === Публикация белорусской версии ===
$id_by = null; $err_by = null;
if ($publish_by && !empty($title_by)) {
    $text_by_final = !empty($text_by) ? $text_by : $text;
    [$id_by, $err_by] = create_news(
        $iblock_by, $title_by,
        build_preview($preview_by, $text_by_final), $text_by_final,
        $code, $active_from, $arPic, $prop_images,
        $prop_gallery_by
    );
}

if ($tmp_path) @unlink($tmp_path);

echo json_encode([
    'status' => 'success',
    'id_ru'  => $id_ru,
    'id_by'  => $id_by,
    'err_by' => $err_by,
]);
?>