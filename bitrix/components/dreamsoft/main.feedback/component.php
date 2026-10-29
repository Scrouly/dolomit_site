<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */



$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");  

$arParams["PRODUCT_TYPE"] = trim($arParams["PRODUCT_TYPE"]);
if($arParams["PRODUCT_TYPE"] == '')
	$arParams["PRODUCT_TYPE"] = GetMessage("MF_PRODUCT_TYPE");

$arParams["QUANTITY"] = trim($arParams["QUANTITY"]);
if($arParams["QUANTITY"] == '')
	$arParams["QUANTITY"] = GetMessage("MF_QUANTITY");

$arParams["NAME_ORGANIZATION"] = trim($arParams["NAME_ORGANIZATION"]);
if($arParams["NAME_ORGANIZATION"] == '')
	$arParams["NAME_ORGANIZATION"] = GetMessage("MF_NAME_ORGANIZATION");

$arParams["CITY"] = trim($arParams["CITY"]);
if($arParams["CITY"] == '')
	$arParams["CITY"] = GetMessage("MF_CITY");

$arParams["TELEPHONE"] = trim($arParams["TELEPHONE"]);
if($arParams["TELEPHONE"] == '')
	$arParams["TELEPHONE"] = GetMessage("MF_TELEPHONE");


if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["MESSAGE"]) <= 3)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("PRODUCT_TYPE", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["PRODUCT_TYPE"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_PRODUCT_TYPE");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("QUANTITY", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["quantity"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_QUANTITY");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME_ORGANIZATION", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["name_organization"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME_ORGANIZATION");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("CITY", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["city"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_CITY");

			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("TELEPHONE", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["telephone"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_TELEPHONE");

		}
		if(mb_strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
		if($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if ($captcha_word <> '' && $captcha_code <> '')
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}
		if(empty($arResult["ERROR_MESSAGE"]))
		{
			$arFields = Array(
				"AUTHOR" => $_POST["user_name"],
				"AUTHOR_EMAIL" => $_POST["user_email"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"TEXT" => $_POST["MESSAGE"],
				"PRODUCT_TYPE" => $_POST["product_type"],
				"QUANTITY" => $_POST["quantity"],
				"NAME_ORGANIZATION" => $_POST["name_organization"],
				"CITY" => $_POST["city"],
				"TELEPHONE" => $_POST["telephone"],

			);
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(intval($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", intval($v));
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
			$event = new \Bitrix\Main\Event('main', 'onFeedbackFormSubmit', $arFields);
			$event->send();
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}

		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
		$arResult["PRODUCT_TYPE"] = htmlspecialcharsbx($_POST["product_type"]);
		$arResult["QUANTITY"] = htmlspecialcharsbx($_POST["quantity"]);
		$arResult["NAME_ORGANIZATION"] = htmlspecialcharsbx($_POST["name_organization"]);
		$arResult["CITY"] = htmlspecialcharsbx($_POST["city"]);
		$arResult["TELEPHONE"] = htmlspecialcharsbx($_POST["telephone"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
	}
	else
	{
		if($_SESSION["MF_NAME"] <> '')
			$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
		if($_SESSION["MF_EMAIL"] <> '')
			$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
		if($_SESSION["MF_PRODUCT_TYPE"] <> '')
			$arResult["PRODUCT_TYPE"] = htmlspecialcharsbx($_SESSION["MF_PRODUCT_TYPE"]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
