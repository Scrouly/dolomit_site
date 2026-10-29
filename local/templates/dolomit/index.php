<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доломит");

//var_dump(SITE_TEMPLATE_PATH);
//exit;
?>
<div class="header-bg header-bg--home header_bg ">
	<div class="header-main h-full">
		<div class="container">
			<div class="row">
				<div class="header-page-title">
					<h1>ОАО «Доломит»: Мы превращаем дары природы в пользу и качество проверенные временем</h1>
				</div>
				<div class="header-main-page-buttons">
					<div class="button button-primary">Продукция</div>
					<div class="button button-secondary">Связаться с нами</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom"></div>
</div> <!--  header-bg End-->

<main class="main">

	<div class="container">

		<section class="home-page-infographics">
			<h3>Наши преимущества</h3>

			<div class="row">
				<div class="infographics-block col-md-4">
					<div class="infographics-block__number">1</div>
					<div class="infographics-block__text">лет на рынке строительства</div>
				</div>
				<div class="infographics-block col-md-4">
					<div class="infographics-block__number">1</div>
					<div class="infographics-block__text">видов выпускаемой продукции</div>
				</div>
				<div class="infographics-block col-md-4">
					<div class="infographics-block__number">1</div>
					<div class="infographics-block__text"> млн тонн составляют разведанные запасы </div>
				</div>
			</div>
		</section>
	</div>

	<section class="home-page-promo">
		<div class="container">
			<a name="sale_home"></a>
			<div class="home-page-promo__box">
				<div class="home-page-promo__title">ВНИМАНИЕ! АКЦИЯ!</div>
				<div class="home-page-promo__text">
					<p>
						С 08.09.2026 ПО 31.10.2026 СНИЖЕНИЕ ЦЕНЫ НА 20% НА ЩЕБЕНЬ ИЗ ПЛОТНЫХ ГОРНЫХ ПОРОД (ДОЛОМИТОВЫЙ) СМЕСИ ФРАКЦИЙ ОТ 5 ДО 20 ММ (М.) ГОСТ 8267-93 И НА ЩЕБЕНЬ ИЗ ГОРНЫХ ПОРОД (ДОЛОМИТОВЫЙ) ФРАКЦИИ ОТ 8 ДО 16 ММ ГОСТ 32703-2014.<br>
						А ТАКЖЕ 15% НА ЩЕБЕНЬ ИЗ ПЛОТНЫХ ГОРНЫХ ПОРОД (ДОЛОМИТОВЫЙ) СМЕСИ ФРАКЦИЙ ОТ 5 ДО 20 ММ ГОСТ 8267-93!
					</p>
				</div>
				<div class="home-page-promo__contacts">
					ПО ВОПРОСАМ ПРИОБРЕТЕНИЯ ОБРАЩАТЬСЯ В ОТДЕЛ МАРКЕТИНГА И СБЫТА:<br>
					ТЕЛ. +375 212 69 14 75, +375 212 69 24 32, +375 212 69 37 76, +375 29 848-26-89
				</div>
			</div>
		</div>
	</section>

	<style>
		.home-page-promo {
			margin: 0 0 7.5rem !important;
			display: block !important;
			opacity: 1 !important;
		}

		.home-page-promo__box {
			display: -webkit-box !important;
			display: -ms-flexbox !important;
			display: flex !important;
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			-webkit-box-align: start;
			-ms-flex-align: start;
			align-items: flex-start;
			gap: 1.5rem;
			padding: 2rem;
			border: 2px solid #f90;
			border-radius: 8px;
			background-color: rgba(255, 153, 0, 0.06);
			opacity: 1 !important;
			visibility: visible !important;
		}

		.home-page-promo__title {
			color: #f90 !important;
			font-weight: 500;
			font-size: 34px;
			line-height: 40px;
		}

		.home-page-promo__text,
		.home-page-promo__text p {
			color: #f90 !important;
			font-weight: 700;
			font-size: 18px;
			line-height: 24px;
			letter-spacing: 0.5px;
		}

		.home-page-promo__text p {
			margin: 0;
		}

		.home-page-promo__contacts {
			color: #fff !important;
			font-weight: 300;
			font-size: 18px;
			line-height: 24px;
			letter-spacing: 0.5px;
		}
	</style>

	<div class="container-fluid">
		<div class="row">

			<article class="home-page-about">
				<div class="home-page-about__img">
					<!-- <img src="/img/ceo.webp" alt="">
					<div class="home-page-about__img--caption">
						Гереральный директор <br>
						<span>Иван Павлович Бабак</span>
					</div> -->
				</div>
				<div class="home-page-about__text">
					<div class="home-page-about__text--title">ОАО «Доломит» - единственное в Республике Беларусь
						и крупнейшее в Европе препдприятие по добыче и переработке доломитового сырья</div>
					<div class="home-page-about__text--subtitle">Предприятие «Доломит» имеет славную историю, за
						более 100 лет своего существования оно прошло нелегкий путь своего развития. </div>
					<div class="home-page-about__text--content">
						<p>В 1931 году с пуском первой шахтной печи мощностью 10 тыс.тонн в год извести, был заложен
							фундамент промышленного производства продукции, имеющей важное народно-хозяйственное
							значение и развитию поселка Руба. С тех пор ежегодно начали наращиваться
							производственные мощности. В 1936 году пущена в эксплуатацию вторая шахтная печь,
							мощностью 12 тыс.тонн в год.Геологоразведочные работы, проведенные в 1930 и 1934 годах,
							подтвердили значительные залежи доломитового известняка и перспективность развития
							завода.</p>
						<p>Геологоразведочные работы, проведенные в 1930 и 1934 годах, подтвердили значительные
							залежи доломитового известняка и перспективность развития завода. В середине 30-х годов
							в карьере Руба появился первый паровой экскаватор, который двигался по специально
							устроенной в карьере железной дороге и производил вскрышные работы. Емкость ковша
							экскаватора составляла 0,5 куб.м. Удаление грунта от вскрышных работ производилось с
							помощью паровоза узкой колеи, работающего на железнодорожном пути, проложенном
							параллельно пути движения экскаватора.</p>
					</div>
					<div class="home-page-about__text--read-more">Читать ещё...</div>
				</div>

			</article>

			<section class="home-page-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9087.657239980757!2d30.318340462429415!3d55.28965115986587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46c59f3fe4353bad%3A0x70482a0889d37489!2z0JrQsNGA0YzQtdGAICLSkNGA0LDQu9C10LLQviI!5e0!3m2!1sru!2sby!4v1671761663482!5m2!1sru!2sby" width="1900" height="770" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</section>


		</div>
	</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>