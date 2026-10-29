<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доломит_");
?>
<div class="header-bg   header-bg--home">
	<div class="header-main h-full">
		<div class="container-fluid container--full-width">
			<div class="row">
				<div class="header-page-title">
				<h1><?=GetMessage('SITE_NAME')?></h1>
				</div>
				<div class="header-main-page-buttons">
					<div class="button button-primary"><?=GetMessage('BUTTON_PRODUCTS')?></div>
                    <div class="button button-secondary"><?=GetMessage('BUTTON_CONTACT_US')?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom"></div>
</div> <!--  header-bg End-->

<div class="container-fluid container--full-width">
	<div class="row">
		<section class="product-blocks">
				<div class="product-block__no-image">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/block-bg.png" alt="">

					<div class="product-block__no-image-info--wrapper">
						<div class="product-block__no-image-info">
							<div class="product-block__no-image--title">Leaders of sells</div>
							<div class="product-block__no-image--text">We will realize crushed stone from quarries in Minsk and
								Minsk region at favorable prices.Delivery to the object, as well as packing is possible
								Crushed stone in bags.All products have quality certificates and meets the requirements
								GOST.
								<div class="button button-secondary">Go to the catalog</div>
							</div>
						</div>

					</div>
				</div>
				<div class="product-block">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-01.jpg" alt="">
					<div id="test" class="product-block--gradient">

						<div class="product-block__caption">
							<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm
							</div>
							<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
						</div>
						<div class="product-block__caption--hovered">
							<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm
							</div>
							<div>
								Гост
							</div>
							<div>Crushing: <span>NNN</span></div>
							<div>Frost resistance: <span>NNN</span></div>
							<div>Abrasion: <span>NNN</span></div>
							<div>Flying: <span>NNN</span></div>
							<div>Water resistance: <span>NNN</span></div>
							<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
						</div>
					</div>
				</div>
				<div class="product-block">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-02.jpg" alt="">
					<div class="product-block--gradient"></div>
					<div class="product-block__caption">
						<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm</div>
						<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
					</div>
				</div>
				<div class="product-block">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-03.jpg" alt="">
					<div class="product-block--gradient"></div>
					<div class="product-block__caption">
						<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm</div>
						<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
					</div>
				</div>
				<div class="product-block">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-04.jpg" alt="">
					<div class="product-block--gradient"></div>
					<div class="product-block__caption">
						<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm</div>
						<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
					</div>
				</div>
				<div class="product-block">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-05.jpg" alt="">
					<div class="product-block--gradient"></div>
					<div class="product-block__caption">
						<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm</div>
						<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
					</div>
				</div>
				<div class="product-block none">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-06.jpg" alt="">
					<div class="product-block--gradient"></div>
					<div class="product-block__caption">
						<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm</div>
						<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
					</div>
				</div>
				<div class="product-block none">
					<img src="<?= SITE_TEMPLATE_PATH; ?>/img/product-07.jpg" alt="">
					<div class="product-block--gradient"></div>
					<div class="product-block__caption">
						<div class="product-block__caption--description">Crushed stone from dense rocks 5-20mm</div>
						<div class="product-block__caption--specifications">25 BYN <span>/ tons</span></div>
					</div>
				</div>
				
		</section>
	</div>
</div>

<div class="container">

	<section class="home-page-infographics">
		<h3>Наши преимущества</h3>

		<div class="row">
			<div class="infographics-block col-md-4">
				<div class="infographics-block__number">1</div>
				<div class="infographics-block__text">years in the construction market</div>
			</div>
			<div class="infographics-block col-md-4">
				<div class="infographics-block__number">1</div>
				<div class="infographics-block__text">types of products</div>
			</div>
			<div class="infographics-block col-md-4">
				<div class="infographics-block__number">1</div>
				<div class="infographics-block__text">Million tons make up reconnaissance reserves </div>
			</div>
		</div>
	</section>
</div>
<div class="container-fluid">
	<div class="row">

		<article class="home-page-about">
			<div class="home-page-about__img">
				<!-- <img src="<?= SITE_TEMPLATE_PATH; ?>/img/ceo.webp" alt="">
				<div class="home-page-about__img--caption">
					General director
					<span>Ivan Pavlovich Babak</span>
				</div> -->
			</div>
			<div class="home-page-about__text">
				<div class="home-page-about__text--title">Dolomit OJSC - the only one in the Republic of Belarus
					and the largest in Europe for the preparation for the extraction and processing of dolomite raw materialsolomite raw materials</div>
				<div class="home-page-about__text--subtitle">The enterprise "Dolomit" has a glorious story, for
					For more than 100 years of its existence, it has passed a difficult path of its development.</div>
				<div class="home-page-about__text--content">
					<p>In 1931, with the launch of the first shaft with a capacity of 10 thousand tons per year of lime, was laid down
						the foundation of industrial production, which has an important national economic
						The significance and development of the village of Rub.Since then they began to increase annually
						production capacity.In 1936, the second shaft furnace was put into operation,
						with a capacity of 12 thousand tons per year. Geological exploration work carried out in 1930 and 1934,
						confirmed significant deposits of dolomite limestone and the prospects of development
						factory.</p>
					<p>Exploration work carried out in 1930 and 1934 confirmed significant
						deposits of dolomite limestone and the promise of the development of the plant.In the mid-30s
						The first steam excavator appeared in the shirt career, which was moving specially
						arranged in the career of the railway and carried out open work.Bucket capacity
						The excavator was 0.5 cubic meters.Removing soil from open work was carried out with
						using a narrow track operating on a railway track laid down
						In parallel to the path of movement of the excavator.</p>
				</div>
				<div class="home-page-about__text--read-more">Read more...</div>
			</div>

		</article>

		<section class="home-page-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9087.657239980757!2d30.318340462429415!3d55.28965115986587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46c59f3fe4353bad%3A0x70482a0889d37489!2z0JrQsNGA0YzQtdGAICLSkNGA0LDQu9C10LLQviI!5e0!3m2!1sru!2sby!4v1671761663482!5m2!1sru!2sby" width="1900" height="770" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</section>


	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>