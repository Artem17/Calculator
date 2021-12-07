<?php
/*
Template Name: Шаблон калькулятора
Template Post Type: page
*/
?>
<?php get_header(); ?>
<script>
/*$({ Counter: 0 }).animate({
  Counter: $('#maxsum p').text()
}, {
  duration: 1000,
  easing: 'swing',
  step: function() {
    $('#maxsum p').text(Math.ceil(this.Counter));
  }
});*/
jQuery( function( $ ){
	$( '#ajax_form' ).submit(function(){
		$.ajax({
			url: '/calc.php',
			type: 'POST',
			format: "json",
			data: $(this).serialize(), 
			success: 
			function( data ) {
				//$('#maxsum p').html(data.maxsum);
				/*$('#maxsum p').each(function () {
    				$(this).text(data.maxsum).animate({
        				Counter: $(this).text()
    					}, {
        				duration: 1000,
        				easing: 'swing',
        				queue: 'falce',
        				step: function () {
      						$this.text(Math.ceil(this.Counter));
    					}*/
    					/*var count;
    					count = text(data.maxsum);*/
    			$('#maxsumcount').html(data.maxsumcount);
    			$({ countNum: $('#maxsum p').html() }).animate({ countNum: ($('#maxsumcount').html()) }, {
            		duration: 8000,
            		easing: 'linear',
            		step: function () {
            		$('#maxsum p').html(Math.floor(this.countNum) + "  руб.");
        		},
        		complete: function () {
            	$('#maxsum p').html(this.countNum + "  руб.");
            	//alert('finished');
        		}
        		});
        				/*step: function (now) {
            		$(this).text(Math.ceil(now));
        				}*/
    			/*	});
				});*/
				$('#years').html(data.years);
				$('#months').html(data.months);
				$('#errone').html(data.errone);
				$('#errtwo').html(data.errtwo);
				$('#err').html(data.err);
				$('#proverka').html(data.proverka);
			}
		});
		// если элемент – ссылка, то не забываем:
		return false;
	});
});
</script>
<div class="td-main-content-wrap">
    <div class="td-container <?php echo $td_sidebar_position; ?>">
        <div class="td-crumb-container">
<form method="post" action="" id="ajax_form">
	<div class="row">
		<div class="col-md-6">
			<p>Укажите первый взнос: <input type="text" name="firstSum" id="calc_firstSum" /></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<p>Укажите ежемесячный доход: <input type="text" name="monthSum" id="calc_monthSum" /></p>
		</div>
	</div>
	<p><input type="submit" name="send" value="рассчитать" id="calc_button" /></p>
	<div id="results" class="benefits">
		<div class="row">
			<div class="col-md-3"><p>Максимальный размер кредита для самой дорогой возможной квартиры</p></div>
			<div class="col-md-2 benefits__element" id="maxsum"><p></p></div>
		</div>
		<div class="row">
			<div class="col-md-3"><p> Срок кредита на самую дешевую квартиру в Москве</p></div>
			<div class="col-md-4"><span id="years" style="margin-right: 10px;"></span><span id="months"></span></div>
		</div>
		<!-- Тестирую счётчик-->
			<div class="container">
  <div class="row">
    <div class="col-xs-6">
      <div class="lines" data-count="20000"></div>
    </div>
    <div class="col-xs-6">
      <div class="lines" data-count="160000"></div>
    </div>
  </div>
</div>
		<!-- Тестирую счётчик-->
		<div id="errone"></div>
		<div id="errtwo"></div>
		<div id="err"></div>
		<div id="proverka"></div>
		<div id="maxsumcount" style="display: none;"></div>
	</div>
</form> 
</div>
</div>
</div>
<?php get_footer(); ?>