<?php
	//$tweet_count = (array) DB::table('tweet_count')->where('day_number', $day_number )->get();
	$tweet_count = (array) DB::table('tweet_count')->selectRaw('team_key, sum(tweet_count) as tweet_count')->groupBy('team_key')->get();
	$final_tweet_count = [];
	$total_count = 0;

	foreach( $tweet_count as $tweet )
	{
		$final_tweet_count[$tweet->team_key] = $tweet;
		$total_count += $tweet->tweet_count;
	}

	//trace( $final_tweet_count );

?>
<!doctype html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?=$lang_content->title?></title>
	<meta name="description" content="<?=$lang_content->description?>">
	<link rel="canonical" href="<?=url()?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?=url('/assets_min/vendor/vendor.min.css')?>" rel="stylesheet">
	<link href="<?=url('/assets_min/global/css/main.min.css')?>" rel="stylesheet">
	

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

			<a href="<?=url('/');?>" class="option">
				<span class="flag"><?=svg('/assets_min/global/img/flags/us.svg')?></span> USA
			</a>
			<a href="#" class="option">
				<span class="flag"></span> Russia
			</a>
			<a href="#" class="option">
				<span class="flag"></span> China
			</a>
			<a href="#" class="option">
				<span class="flag"></span> Brazil
			</a>
			<a href="#" class="option">
				<span class="flag"></span> Spain
			</a>
			<a href="#" class="option">
				<span class="flag"></span> Germany
			</a>
		</div>

	</div><!-- location -->

	<?php
		/* Main intro
		========================================================== */
	?>

	<div id="main-intro">
		<div class="holder">

			<div class="header-tagline">
            	<div class="main-callout">Geforce<sup>&reg;</sup> GTX 1080</div>
                <div class="sub-callout">The Official Gaming Platform of ESL ONE - CS:GO</div>
            </div>

			<div class="gameready">
				<div class="esl-one"><img src="<?=url('/assets_min/global/img/eslone-logo.png')?>"></div>
                <div class="divider"><img src="<?=url('/assets_min/global/img/line-break.png')?>"></div>
				<div class="counterstrike"><img src="<?=url('/assets_min/global/img/counterstrike-logo.png')?>"></div>
			</div>

			<div class="shield">
            
				<div class="content">

					<div class="line1"><?=$lang_content->intro_line1?></div>
					<div class="line2"><?=$lang_content->intro_line2?> <?=$lang_content->prize_meter_reset?></div>

					<div class="follow">
						<a href="http://www.youtube.com/channel/UCL-g3eGJi1omSDSz48AML-g?sub_confirmation=1" class="button" target="_blank">
							<span class="icon"><img src="<?=url('/assets_min/global/img/thumbnail.png')?>"></span>
							<span class="text"><?=$lang_content->intro_button?></span>
						</a>
					</div>
					
                    <div class="graphics-card-callout">
                            <div class="main-title">geforce<sup>&reg;</sup> gtx 10-series</div>
                            <div class="sub-title">Experience game-changing performance and power efficiency in every game</div>
                            
                            <div class="product-info">
                            	<div class="product-column">
                                	<ul>
                                    	<li>
                                            <div class="product-name">GeForce GTX 1080</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1080" target="_blank">Learn More ></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name">GeForce GTX 1070</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1070" target="_blank">Learn More ></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name">GeForce GTX 1060</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1060" target="_blank">Learn More ></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name">GeForce GTX 10-series Notebooks</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/notebook" target="_blank">Learn More ></a></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-image"><img src="<?=url('/assets_min/global/img/graphicscard.png')?>"</div>
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

	<div id="prize-meter">

		<div class="header clear">

			<div class="intro">
				<div class="line1"><?=$lang_content->prize_meter?></div>
                <div class="line3"><?=$lang_content->lower_bracket_round_1?> </div>
			</div>

			<div class="total">
				<div class="number" id="total-count">0</div>
				<div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div>
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
							<div class="number">20K</div>
						</div>
					</div>

					<div class="dot dot-green dot-3"></div>
					<div class="dot dot-grey dot-3">
						<div class="prize">
							<?=$lang_content->prize2?>
						</div>
						<div class="tweets">
							<div class="label">Tweets</div>
							<div class="number">10K</div>
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


		<div class="meter-mobile">
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
							<div class="number">10K</div>
						</div>
					</div>

					<div class="dot dot-green dot-3"></div>
					<div class="dot dot-grey dot-3">
						<div class="prize">
							<?=$lang_content->prize3?>
						</div>
						<div class="tweets">
							<div class="label">Tweets</div>
							<div class="number">20K</div>
						</div>
					</div>

					

					<div class="progress-green"></div>
					<div class="progress-bg"></div>

				</div>
				<div class="bottom-cover"></div>
			</div>
            
		</div><!-- meter -->

<div class="follow-nvidia">
                    	<button class="follow-btn"><a href="https://twitter.com/NVIDIAGeForce" target="_blank">Follow @NVIDIAGeForce To See If You Win</a></button>
                    </div>

	</div><!-- #prize-meter -->



	<?php
		/* Brackets
		========================================================== */
	?>

	<div id="brackets">

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

					<div class="group-title"><?=$match['title']?></div>

					<div class="match-entry">

						<div class="date"><?=$date_final?><?=$match['series']?></div>

						<div class="versus">
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
											<div class="number"><span class="num"><?=$team1_count?></span><div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div></div>
											<div class="hashtags"><span>#ESLONE</span><span>#GAMEREADY</span><span>#<?=$team1_found->hashtag?></span></div>
										</div>
									</div>

									<div class="tweets">
										<?php
											$tweets_found = DB::table('tweets')->where( 'team_key', $team1_found->key )->orderBy('tweet_id', 'desc')->take(2)->get();

											for ($i=0; $i < 2; $i++)
											{
												if( isset($tweets_found[$i]) )
												{
													?>
													<div class="entry">
														<div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div>
														<div class="meta">
															<div class="name"><?=$tweets_found[$i]->tweet_user_name?></div>
															<div class="screen_name">@<?=$tweets_found[$i]->tweet_user_screen_name?></div>
														</div>
														<div class="content"><?=$tweets_found[$i]->tweet_text?></div>
													</div>
													<?php
												}
												else
												{
													?>
													<div class="entry">
														<div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div>
														<div class="meta">
															<div class="name">NVIDIA</div>
															<div class="screen_name">@NVIDIA</div>
														</div>
														<div class="content">Let's go! #eslone #GameReady #<?=$team1_found->hashtag?> via @NVIDIA</div>
													</div>
													<?php
												}
											}
										?>
									</div>

									<div class="bottom">
										<?php
											$hashtags = urlencode( 'TI6,GameReady,'.$team1_found->hashtag );
										?>
										<a href="https://twitter.com/intent/tweet?hashtags=<?=$hashtags?>&via=NVIDIA" class="button">
											<span class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></span>
											<?=sprintf( $lang_content->cheer_on, $team1_found->name )?>
										</a>
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
											<div class="number"><span class="num"><?=$team2_count?></span> <div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div></div>
											<div class="hashtags"><span>#ESLONE</span><span>#GAMEREADY</span><span>#<?=$team2_found->hashtag?></span></div>
										</div>
									</div>

									<div class="tweets">
										<?php
											$tweets_found = DB::table('tweets')->where( 'team_key', $team2_found->key )->orderBy('tweet_id', 'desc')->take(2)->get();

											for ($i=0; $i < 2; $i++)
											{
												if( isset($tweets_found[$i]) )
												{
													?>
													<div class="entry">
														<div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div>
														<div class="meta">
															<div class="name"><?=$tweets_found[$i]->tweet_user_name?></div>
															<div class="screen_name">@<?=$tweets_found[$i]->tweet_user_screen_name?></div>
														</div>
														<div class="content"><?=$tweets_found[$i]->tweet_text?></div>
													</div>
													<?php
												}
												else
												{
													?>
													<div class="entry">
														<div class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></div>
														<div class="meta">
															<div class="name">NVIDIA</div>
															<div class="screen_name">@NVIDIA</div>
														</div>
														<div class="content">Let's go! #eslone #GameReady #<?=$team2_found->hashtag?> via @NVIDIA</div>
													</div>
													<?php
												}
											}
										?>
									</div>

									<div class="bottom">
										<?php
											$hashtags = urlencode( 'TI6,GameReady,'.$team2_found->hashtag );
										?>
										<a href="https://twitter.com/intent/tweet?hashtags=<?=$hashtags?>&via=NVIDIA" class="button">
											<span class="icon"><?=svg('/assets_min/global/img/twitter.svg')?></span>
											<?=sprintf( $lang_content->cheer_on, $team2_found->name )?>
										</a>
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

		 <div class="graphics-card-callout-mobile">
                            <div class="main-title">geforce&reg; gtx 10-series</div>
                            <div class="sub-title">Experience game-changing performance and power efficiency in every game</div>
                            
                            <div class="product-info">
                            	<div class="product-column">
                                	<ul>
                                    	<li>
                                            <div class="product-name">GeForce GTX 1080</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1080" target="_blank">Learn More ></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name">GeForce GTX 1070</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1070" target="_blank">Learn More ></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name">GeForce GTX 1060</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/geforce-gtx-1060" target="_blank">Learn More ></a></div>
                                        </li>
                                        <li>
                                            <div class="product-name">GeForce GTX 10-series Notebooks</div>
                                            <div class="learn"><a href="http://www.geforce.com/hardware/10series/notebook" target="_blank">Learn More ></a></div>
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

	<div id="copyright">

		<?=$lang_content->copyright?>

	</div><!-- copyright -->

	</div> <!-- END MOBILE BACKGROUND BLACK COVER -->

	<?php
		/* Scripts
		========================================================== */
	?>

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