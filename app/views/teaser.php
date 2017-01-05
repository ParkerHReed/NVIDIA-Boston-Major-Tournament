<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

<title>ESL-ONE Genting | #GAMEREADY</title>
	<meta name="description" content="<?=$lang_content->description?>">
	<link rel="canonical" href="<?=url()?>">

<!--	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">-->

	<link href="<?=url('/assets_min/vendor/vendor.min.css')?>" rel="stylesheet">
	<link href="<?=url('/assets_min/global/css/main.min.css')?>" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans|Fjalla+One:400,300' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">




<?php
	//$tweet_count = (array) DB::table('tweet_count')->where('day_number', $day_number )->get();
	$tweet_count = (array) DB::table('tweet_count')->selectRaw('team_key, sum(tweet_count) as tweet_count')->groupBy('team_key')->get();
	$final_tweet_count = [];
	$total_count = 0;

	foreach( $tweet_count as $tweet )
	{
		$final_tweet_count[$tweet->team_key] = $tweet;
		//$total_count += $tweet->tweet_count;
	}

	//trace( $final_tweet_count );

?>

	<link href='https://fonts.googleapis.com/css?family=Open+Sans|Fjalla+One:400,300' rel='stylesheet' type='text/css'>

	<script>

		var trackOutboundLink = function(url)
		{
		   ga('send', 'event', 'outbound', 'click', url, {
		     'transport': 'beacon',
		     'hitCallback': function(){ window.open( url, '_blank'); }
		   });
		}

	</script>

</head>
<body class="lang-<?=$lang?>">


	<?php
		/* Location
		========================================================== */
	?>

	<div id="location">
		<a href="#" class="current"><?=svg('/assets_min/global/img/flags/'.$lang.'.svg')?></a>
		<div class="menu">
			<a href="#" class="btn-close">x</a>
			<a href="<?=url('index.php/us');?>" class="option"><span class="flag"><?=svg('/assets_min/global/img/flags/us.svg')?></span> USA</a>
			
		</div>
	</div><!-- location -->




	<?php
		/* Main intro
		========================================================== */
	?>

	<div id="main-intro" style="position: relative; z-index:3;">
		<div class="holder">

			<div class="header-tagline">
            	<div class="main-callout"><?=$lang_content->main_callout?></div>
                <div class="sub-callout"><?=$lang_content->sub_callout?></div>
            </div>

			<div class="gameready" style="padding:0; text-align: center;">
<img src="<?=url('assets_min/global/img/esl.png')?>" style="width: 100%; margin-top: 20px; max-width: 410px; margin-bottom: 40px;">
			</div>

			<div class="shield" style="height: auto; text-align: center;">

				<div class="content" style="position:relative;top:auto;margin-top: 10px;">

					<div class="line1" style="font-size: 21px; line-height: 28px; font-weight: bold; color: #fff; text-transform: uppercase; margin-bottom: 10px; max-width: 500px; margin: 0 auto; padding-bottom: 15px; font-family: GeForceLight, sans-serif;"><?=$lang_content->intro_line1?></div>
					<div class="line2" style="padding:0 7% 30px 7%;font-size:12px; max-width: 525px; margin: 0 auto;"><?=$lang_content->intro_line2?> <?=$lang_content->prize_meter_reset?></div>

                    <div class="graphics-card-callout">
                    
                            
                            <div class="product-info">
                            	<div class="product-column">
                                	<ul>
                                    	<li>
                                            <div class="product-name"><?=$lang_content->prize3?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1080" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name"><?=$lang_content->prize2?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1070" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name"><?=$lang_content->prize1?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1060" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name"><?=$lang_content->prize4?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/notebook" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                    </ul>
                                </div>
                      	  </div>
                    </div>
               
					

				</div>

			</div>

		</div>
	</div><!-- main-intro -->

	<div class="mobile-bg-cover">

	<?php
		/* Prize Meter
		========================================================== */
	?>

	<div id="prize-meter" style="z-index: 3;">

		<div class="header clear">

			<div class="intro">
				<div class="line1"><?=$lang_content->prize_meter?></div>
                <div class="line3" style="font-size: 43px;"><?=$lang_content->lower_bracket_round_1?> </div>
			</div>

			<div class="total" style="margin-top:0;">
				<div class="number" id="total-count" style=" opacity: 1;" >0</div>
				<div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div>
			</div>

		</div>
<style>
@media (min-width: 1024px) {
    .notify-mobile {
    display: none;
        
    }
    
}
@media (max-width: 1024px) {
    #brackets {
        opacity: .5;
        
    }
    .notify-desktop {
    display: none;
        
    }
    .date, .group-title {
        
    display: none;
    }
    #brackets .brackets-title {
        
        padding-top: 45px;
    }
}
</style>
        <div class="notify-mobile">
			<div style="float:left; position: relative; z-index:2; width:calc(100%); box-sizing:border-box; margin:0px; padding:30px 25px; background-color:#f0f0f0;">
			<div style="margin-bottom:10px;float:left;position:relative;text-transform:uppercase;color:#000;font-weight:bold;" class="notify-msg">Notify me when cheering Begins</div>
			<div class="notify-form">
			<input style="float:left;height:40px;box-sizing:border-box;padding:10px;color:#000;outline:none;width:calc(100% - 80px);border:0;" type="email" class="email" maxlength="50" placeholder="Enter your email" /><button style="float:left;width:80px;font-size:90%;height:40px;background-color:#76b701;border:0;text-transform:uppercase;font-weight:bold; outline:none;" type="submit" class="submit-button">Submit</button>
			<div class="invalid" style="display:none;color:red;margin-top:15px;float:left;font-weight:bold;text-transform:uppercase;">Invalid Email</div>
			</div>
			<div class="thankyou" style="display:none;margin-bottom:10px;float:left;position:relative;text-transform:uppercase;color:#000;font-weight:bold;">
			Thank you. You will be notified when the competition begins.
			</div>
		</div>

        </div>

		<div class="meter">
			<div class="top-cover"></div>
			<div class="padding">
				<div class="inside">



					<div class="dot dot-green dot-2"></div>
					<div class="dot dot-grey dot-2">
						<div class="prize">
							<?=$lang_content->prize3?>
						</div>
						<div class="tweets">
							<div class="label">Tweets</div>
							<div class="number">6k</div>
						</div>
					</div>

					<div class="dot dot-green dot-3"></div>
					<div class="dot dot-grey dot-3">
						<div class="prize">
							<?=$lang_content->prize2?>
						</div>
						<div class="tweets">
							<div class="label">Tweets</div>
							<div class="number">3K</div>
						</div>
					</div>

					<div class="dot dot-green dot-4"></div>
					<div class="dot dot-grey dot-4">
						<div class="prize">
							<?=$lang_content->prize1?>
						</div>
					</div>

					<div class="progress-green"></div>
					<div class="progress-bg"></div>

				</div>
			</div>
			<div class="bottom-cover"></div>
		</div><!-- meter -->


		<div class="meter-mobile" style="height:100px;">
			<div class="padding">
				<div class="top-cover"></div>
				<div class="inside">

					<div class="dot dot-green dot-1"></div>
					<div class="dot dot-grey dot-1">
						<div class="prize">
							<?=$lang_content->prize1?>
						</div>
					</div>

					<div class="dot dot-green dot-2"></div>
					<div class="dot dot-grey dot-2">
						<div class="prize">
							<?=$lang_content->prize2?>
						</div>
						<div class="tweets">
							<div class="label">Tweets</div>
							<div class="number">6K</div>
						</div>
					</div>

					<div class="dot dot-green dot-3"></div>
					<div class="dot dot-grey dot-3">
						<div class="prize">
							<?=$lang_content->prize3?>
						</div>
						<div class="tweets">
							<div class="label">Tweets</div>
							<div class="number">3K</div>
						</div>
					</div>

					

					<div class="progress-green"></div>
					<div class="progress-bg"></div>

				</div>
				<div class="bottom-cover"></div>
			</div>
            
		</div>

<div class="follow-nvidia" style="display:none;">
                    	<button class="follow-btn"><a href="https://twitter.com/NVIDIAGeForce" target="_blank">Follow @NVIDIAGeForce To See If You Win</a></button>
                    </div>

	</div>
 
 


	<?php
		/* Brackets
		========================================================== */
	?>

	<div id="brackets">
        <div style="height:calc(100% + 100px);top:-100px;float:left;width:40%; position: fixed;background-color: rgba(0,0,0,.7);box-shadow:0 0 40px 50px rgba(0,0,0,.7);z-index:2;" class="notify-desktop">

            <div style="float:left;position: relative;top:50%;width:calc(100% - 80px);box-sizing:border-box;margin:40px;padding:30px 25px;background-color:#f0f0f0;box-shadow:0 0 18px 4px rgba(0,0,0, .5)">
                <div style="margin-bottom:10px;float:left;position:relative;text-transform:uppercase;color:#000;font-weight:bold;" class="notify-msg">Notify me when cheering Begins</div>
                <div class="notify-form">
                    <input style="float:left;height:40px;box-sizing:border-box;padding:10px;color:#000;outline:none;width:calc(100% - 80px);border:0;" type="email" maxlength="50" class="email" placeholder="Enter your email" /><button style="float:left;width:80px;font-size:90%;height:40px;background-color:#76b701;border:0;text-transform:uppercase;font-weight:bold;" type="submit" class="submit-button">Submit</button>
                    <div class="invalid" style="display:none;color:red;margin-top:15px;float:left;font-weight:bold;text-transform:uppercase;">Invalid Email</div>
                </div>
                <div class="thankyou" style="display:none;margin-bottom:10px;float:left;position:relative;text-transform:uppercase;color:#000;font-weight:bold;">
                    Thank you. You will be notified once the competition begins.
                </div>
            </div>
        </div>
<script>
$(document).ready(function() {
                  
    $(".submit-button").on("click", function() {
    	var email = $(this).closest(".notify-form").find(".email").val();
    	if (email.indexOf("@")==-1||email.indexOf(".")==-1) {
    		$(".invalid").show();
    	} else {
    		$(".invalid").hide();
            $.ajax({
                url:'/notifyme.php?who=' + email,
                		success: function() {
                			$(".notify-form").hide();
                   $(".notify-msg").hide();
                			$(".thankyou").show();
                		}
	        });
    	}
    });
});
</script>
		<div class="brackets-title">
			<div class="title"><?=$lang_content->rep_title?></div>
			<div class="line"></div>
		</div>


		<div class="bracket-group">
			<?php
				$counter = 0;

				foreach( $round['matches'] as $match )
				{
					$team1_found = (object)$teams[ $match['team1'] ];
					$team2_found = (object)$teams[ $match['team2'] ];

					$team1_count = ( isset($final_tweet_count[$match['team1']]) )? $final_tweet_count[$match['team1']]->tweet_count : 0;
					$team2_count = ( isset($final_tweet_count[$match['team2']]) )? $final_tweet_count[$match['team2']]->tweet_count : 0;

					$date_final = ( $counter == 0 )? "{$match['date']} | " : '';
					?>

<div class="group-title">&nbsp;</div>

					<div class="match-entry">

<div class="date">&nbsp;</div>

						<div class="versus" style="opacity:0;">
							<div class="text"><?=$match['results']?></div>
						</div>

						<div class="team-cards clear">

							<div class="teambox team-<?=$team1_found->key?>">
								<div class="teambox-inside">

									<div class="photo">
										<div class="thumbnail" style="background-image: url('<?=url('/assets_min/global/img/photos/'.$team1_found->key.'.jpg')?>');"></div>
									</div>

									<div class="info">
										<div class="content">
											<div class="logo"><img src="<?=url('/assets_min/global/img/logos/'.$team1_found->key.'.png')?>"></div>
											<div class="number"><span class="num">0</span><div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div></div>
											<div class="hashtags"><span>#ESLONE</span><span>#GAMEREADY</span><span>#<?=$team1_found->hashtag?></span></div>
										</div>
									</div>

									<div class="tweets" style='padding-top:130px;'>

									</div>

								
                                    <div class="bottom">
										<?php
											$hashtags = urlencode( 'ESLONE,GameReady,'.$team1_found->hashtag );
										?>
										<span style='background-color:#595959;' href="#" class="button tease" >
											<span class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></span>
											<?=sprintf( $lang_content->cheer_on, $team1_found->name )?>
										</span>
									</div> 

								</div>
							</div>



							<div class="teambox team-<?=$team2_found->key?>">
								<div class="teambox-inside">

									<div class="photo">
										<div class="thumbnail" style="background-image: url('<?=url('/assets_min/global/img/photos/'.$team2_found->key.'.jpg')?>');"></div>
									</div>

									<div class="info">
										<div class="content">
											<div class="logo"><img src="<?=url('/assets_min/global/img/logos/'.$team2_found->key.'.png')?>"></div>
											<div class="number"><span class="num">0</span> <div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div></div>
											<div class="hashtags"><span>#ESLONE</span><span>#GAMEREADY</span><span>#<?=$team2_found->hashtag?></span></div>
										</div>
									</div>

									<div class="tweets" style='padding-top:130px;'>

									</div>

								
                                    
                                    <div class="bottom">
										<?php
											$hashtags = urlencode( 'ESLONE,GameReady,'.$team2_found->hashtag );
										?>
										<span style='background-color:#595959;' href="#" class="button tease">
											<span class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></span>
											<?=sprintf( $lang_content->cheer_on, $team2_found->name )?>
										</span>
									</div> 

								</div>
							</div>



						</div>

					</div>
					<?php

					$counter++;
				}
			?>

		</div>


	</div><!-- #brackets -->

	<?php
		/* Mobile Product Call Out
		========================================================== */
	?>

		 <div class="graphics-card-callout-mobile" style="float:left;">
                            <div class="main-title"><?=$lang_content->gc_main_callout?></div>
                            <div class="sub-title"><?=$lang_content->gc_sub_title?></div>
                            
                            <div class="product-info">
                            	<div class="product-column">
                                	<ul>
                                    	<li>
                                            <div class="product-name"><?=$lang_content->prize3?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1080" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name"><?=$lang_content->prize2?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1070" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name"><?=$lang_content->prize1?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1060" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name"><?=$lang_content->prize4?></div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/notebook" target="_blank"><?=$lang_content->learn_more?></a></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                    </div> <!-- END MOBILE PRODUCT CALL OUT -->


	<?php
		/* phpCopyright
		========================================================== */
	?>

	<div id="copyright" style='max-height:50px;float: left;width: 100%;margin-bottom: 20px;z-index:9999;'>


<?=$lang_content->copyright?><a href="index.php/official_rules" class="rules" target="_blank" style='color:#999;' onclick="trackOutboundLink(this.href)"><?=$lang_content->official_rules?></a>

	</div><!-- copyright -->

	</div> <!-- END MOBILE BACKGROUND BLACK COVER -->

	<?php
		/* Scripts
		========================================================== */
	?>



<!----------------------  REMOVE LINK ON TEASER PAGE ------------------------------>
<!--
<script>
    $(document).ready(function(){
            $(".tease").each(function(index,elm) {
            $(elm).attr("data-oldhref", $(elm).attr("href"));
            $(elm).removeAttr("href");
        });
    });
</script>
-->
<!-------------------------------------------------------------------------------->



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


	<?php if( Config::get('env') == 'dev' ){ ?>
		<script async src='http://192.168.1.231:8888/browser-sync/browser-sync-client.2.11.1.js'></script>
	<?php } ?>


	<script>

		$(function()
		{
			_.delay( function()
			{
				load_meter( <?=$total_count?> );
				load_meter_mobile( <?=$total_count?> );
			}, 500 );
		});

		$(window).on('resize', function()
		{
			var el_top = $('#prize-meter .meter').position().top;
			var screen_height = $('#prize-meter').height();
			var new_height = ( screen_height - el_top );

			$('#prize-meter .meter').height( new_height );

		}).trigger('resize');



		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-72492306-3', 'auto');
		ga('send', 'pageview');


	</script>


</body>
</html>

