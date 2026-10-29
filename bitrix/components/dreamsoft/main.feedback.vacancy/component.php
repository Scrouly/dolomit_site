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

use Bitrix\Main\Mail\Event;

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");

$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM_VACANCY";

$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");

/*    $arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");  
*/
//-------------------
$arParams["AUTHOR_NAME"] = trim($arParams["AUTHOR_NAME"]);
if($arParams["AUTHOR_NAME"] == '')
	$arParams["AUTHOR_NAME"] = GetMessage("MFP_AUTHOR_NAME");

$arParams["AUTHOR_LAST_PLACE_WORK"] = trim($arParams["AUTHOR_LAST_PLACE_WORK"]);
if($arParams["AUTHOR_LAST_PLACE_WORK"] == '')
	$arParams["AUTHOR_LAST_PLACE_WORK"] = GetMessage("MFP_AUTHOR_LAST_PLACE_WORK");

$arParams["EDUCATION"] = trim($arParams["EDUCATION"]);
if($arParams["EDUCATION"] == '')
	$arParams["EDUCATION"] = GetMessage("MFP_EDUCATION");

$arParams["POST"] = trim($arParams["POST"]);
if($arParams["POST"] == '')
	$arParams["POST"] = GetMessage("MFP_POST");

$arParams["SALARY_LEVEL"] = trim($arParams["SALARY_LEVEL"]);
if($arParams["SALARY_LEVEL"] == '')
	$arParams["SALARY_LEVEL"] = GetMessage("MFP_SALARY_LEVEL");

$arParams["SUGGESTIONS_WORK"] = trim($arParams["SUGGESTIONS_WORK"]);
if($arParams["SUGGESTIONS_WORK"] == '')
	$arParams["SUGGESTIONS_WORK"] = GetMessage("MFP_SUGGESTIONS_WORK");

$arParams["TELEPHONE"] = trim($arParams["TELEPHONE"]);
if($arParams["TELEPHONE"] == '')
	$arParams["TELEPHONE"] = GetMessage("MFP_TELEPHONE");

$arParams["AUTHOR_FILE"] = trim($arParams["AUTHOR_FILE"]);
if($arParams["AUTHOR_FILE"] == '')
	$arParams["AUTHOR_FILE"] = GetMessage("MFP_AUTHOR_FILE");



if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{



	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("AUTHOR_NAME", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("AUTHOR_LAST_PLACE_WORK", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["last_plase_work"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("EDUCATION", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["education"]) <= 3)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("SALARY_LEVEL", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["salary_level"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_PRODUCT_TYPE");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("SUGGESTIONS_WORK", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["suggestions_work"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_QUANTITY");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("AUTHOR_EMAIL", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME_ORGANIZATION");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("POST", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_post"]) <= 1)
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
$fileId = false;
		if(empty($arResult["ERROR_MESSAGE"]))
		{


if($_FILES['file'])
$fileId = \CFile::SaveFile($_FILES['file'],"mailatt");





			$arFields = Array(
				"AUTHOR_NAME" => $_POST["user_name"],
				"AUTHOR_LAST_PLACE_WORK" => $_POST["last_plase_work"],
				"EDUCATION" => $_POST["education"],

				"POST" => $_POST["user_post"],
				"SALARY_LEVEL" => $_POST["salary_level"],

				"SUGGESTIONS_WORK" => $_POST["suggestions_work"],
				"TELEPHONE" => $_POST["telephone"],

				"AUTHOR_EMAIL" => $_POST["user_email"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"AUTHOR_FILE" => $_FILES['file'],


			);
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(intval($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", intval($v),array($fileId));

			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
			$event = new \Bitrix\Main\Event('main', 'onFeedbackFormSubmit', $arFields);
			$event->send();
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}

		if($fileId)
    	CFile::Delete($fileId);

		$arResult["AUTHOR_LAST_PLACE_WORK"] = htmlspecialcharsbx($_POST["last_plase_work"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
		$arResult["EDUCATION"] = htmlspecialcharsbx($_POST["education"]);
		$arResult["POST"] = htmlspecialcharsbx($_POST["user_post"]);
		$arResult["SALARY_LEVEL"] = htmlspecialcharsbx($_POST["salary_level"]);
		$arResult["SUGGESTIONS_WORK"] = htmlspecialcharsbx($_POST["suggestions_work"]);
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

	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
