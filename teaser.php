<!doctype html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?=$lang_content->title?></title>
	<meta name="description" content="<?=$lang_content->description?>">
	<link rel="canonical" href="">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="/assets_min/vendor/vendor.min.css" rel="stylesheet">
	<link href="/assets_min/global/css/main.min.css" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans|Fjalla+One:400,300' rel='stylesheet' type='text/css'>

</head>
<body id="teaser-page">













	<div id="main-intro">
		<div class="holder">

			<div class="header-tagline">
            	<div class="main-callout">Geforce<sup>&reg;</sup> GTX 1080</div>
                <div class="sub-callout">The Official Gaming Platform of ESL ONE - CS:GO</div>
            </div>

			<div class="gameready">
				<div class="esl-one"><img src="/assets_min/global/img/eslone-logo.png"></div>
                <div class="divider"><img src="/assets_min/global/img/line-break.png"></div>
				<div class="counterstrike"><img src="/assets_min/global/img/counterstrike-logo.png"></div>
			</div>

			<div class="shield">
            
				<div class="content">

					<div class="line1">TEST</div>
					<div class="line2">Test</div>

 <div class="date">
        	<h1>Coming Soon</h1>
        	<h2>09.26.16</h2>
        </div>

					<div class="follow">
						<a href="http://www.youtube.com/channel/UCL-g3eGJi1omSDSz48AML-g?sub_confirmation=1" class="button" target="_blank">
							<span class="icon"><img src="/assets_min/global/img/thumbnail.png"></span>
							<span class="text">BUTTON</span>
						</a>
					</div>
			
               
					

				</div>

			</div>

		</div>
        
        
       
	</div><!-- main-intro -->






	<div id="copyright">

		<?=$lang_content->copyright?>

	</div><!-- copyright -->

	</div> <!-- END MOBILE BACKGROUND BLACK COVER -->














	<script>
		window.twttr = (function (d,s,id) {
		var t, js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
		js.src="http://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
		return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
		}(document, "script", "twitter-wjs"));
	</script>

	<script src="<?=url('/assets_min/vendor/vendor.min.js')?>"></script>
	<script src="<?=url('/assets_min/global/js/main.min.js')?>"></script>

	<? if( Config::get('env') == 'dev' ){ ?>
		<script async src='http://192.168.1.231:8888/browser-sync/browser-sync-client.2.11.1.js'></script>
	<? } ?>

	<script>

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-72492306-3', 'auto');
		ga('send', 'pageview');

	</script>


</body>
</html>