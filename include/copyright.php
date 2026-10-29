<?
  if (substr_count($APPLICATION->GetCurPage(), '/by')) {?>
<div class="copyright-footer">
		<span>	 © <?php echo date ( 'Y' ) ; ?> ААТ «Даламіт» </span>

	<a href="https://dreamsoft.by/"> Распрацавана DreamSoft </a>

</div>

<?} else { ?>
<div class="copyright-footer">
		<span>	 © <?php echo date ( 'Y' ) ; ?> ОАО «Доломит» </span>

	<a href="https://dreamsoft.by/">Разработано DreamSoft </a>

</div>

<? } ?>