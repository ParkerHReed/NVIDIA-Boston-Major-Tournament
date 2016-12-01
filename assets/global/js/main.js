/* main.js
======================================================= */

$(function()
{
	$('#location').on('click', '.current', function()
	{
		$('#location').toggleClass('open');

		return false;
	});

	$('body').on('click', function( e )
	{
		if( $(e.target).closest('.menu').size() == 0 )
		{
			$('#location').removeClass('open');
		}
	});

	$('#location .menu .btn-close').on('click', function( e )
	{
		$('#location').removeClass('open');
		return false;
	});



	twttr.ready( function(twttr)
	{
		twttr.events.bind('tweet', function( event )
		{
			var $number = $(event.target).closest('.teambox-inside').find('.info .number .num');
			var new_value = parseInt( $number.text() )+1;
			$number.text( new_value );

			var $total = $('#prize-meter .total .number');
			var new_value = parseInt( $total.text() )+1;
			$total.text( new_value );

			// var new_value = parseInt( $number.text().split(",").join("") )+1;
			// numeral(new_value).format('0,0,0')
		});
	});


});



/* Fix IE jumpy scroll
------------------------------------------- */

if(navigator.userAgent.match(/Trident\/7\./))
{
	$('body').on("mousewheel", function ()
	{
		// remove default behavior
		event.preventDefault();

		//scroll without smoothing
		var wheelDelta = event.wheelDelta;
		var currentScrollPosition = window.pageYOffset;
		window.scrollTo(0, currentScrollPosition - wheelDelta);
	});
}


/* load_meter
------------------------------------------- */

function load_meter( tweet_count )
{
	var counter = new CountUp("total-count", 0, tweet_count );
	counter.start();

	// green bar --------

	var progress_height, percent_height, max_height, min_height, percent, difference;

	if( tweet_count >= 1000 && tweet_count < 10000 )
	{
		min_height = 0;
		max_height = 40;
		percent = ( tweet_count / 10000 ) * 100;
	}
	else if( tweet_count >= 10000 && tweet_count < 20000 )
	{
		min_height = 40;
		max_height = 69;
		percent = ( (tweet_count-10000) / 10000 ) * 100;
	}
	else if( tweet_count >= 20000 && tweet_count < 30000 )
	{
		min_height = 69;
		max_height = 100;
		percent = ( (tweet_count-20000) / 10000 ) * 100;
	}

	if( tweet_count <= 1000 )
	{
		progress_height = '55px';
	}
	else if( tweet_count >= 30000 )
	{
		progress_height = '100%';
	}
	else
	{
		difference = max_height - min_height;
		percent_height = ( percent * difference ) / 100;
		progress_height =  min_height + percent_height + '%';
	}

	$('#prize-meter .meter .progress-green').css( { height: progress_height } );


	// green dots --------

	_.delay( function(){ $('#prize-meter .meter .dot-4').addClass('showit'); }, 200 );
	if( tweet_count >= 10000 ) _.delay( function(){ $('#prize-meter .meter .dot-3').addClass('showit'); }, 900 );
	if( tweet_count >= 20000 ) _.delay( function(){ $('#prize-meter .meter .dot-2').addClass('showit'); }, 1400 );
	if( tweet_count >= 30000 ) _.delay( function(){ $('#prize-meter .meter .dot-1').addClass('showit'); }, 2000 );
}


/* load_meter_mobile
------------------------------------------- */

function load_meter_mobile( tweet_count )
{
	// green bar --------

	var progress_width, percent_width, max_width, min_width, percent, difference;

	if( tweet_count >= 1000 && tweet_count < 10000 )
	{
		min_width = 0;
		max_width = 31;
		percent = ( tweet_count / 10000 ) * 100;
	}
	else if( tweet_count >= 10000 && tweet_count < 20000 )
	{
		min_width = 31;
		max_width = 59;
		percent = ( (tweet_count-10000) / 10000 ) * 100;
	}
	else if( tweet_count >= 20000 && tweet_count < 30000 )
	{
		min_width = 59;
		max_width = 87;
		percent = ( (tweet_count-20000) / 10000 ) * 100;
	}


	if( tweet_count <= 1000 )
	{
		progress_width = '55px';
	}
	else if( tweet_count >= 30000 )
	{
		progress_width = '870px';
	}
	else
	{
		difference = max_width - min_width;

		percent_width = ( percent * difference ) / 100;
		progress_width =  min_width + percent_width + '%';
	}


	$('#prize-meter .meter-mobile .progress-green').css( { width: progress_width } );


	// green dots --------

	_.delay( function(){ $('#prize-meter .meter-mobile .dot-1').addClass('showit'); }, 200 );
	if( tweet_count >= 10000 ) _.delay( function(){ $('#prize-meter .meter-mobile .dot-2').addClass('showit'); }, 900 );
	if( tweet_count >= 20000 ) _.delay( function(){ $('#prize-meter .meter-mobile .dot-3').addClass('showit'); }, 1400 );
	if( tweet_count >= 30000 ) _.delay( function(){ $('#prize-meter .meter-mobile .dot-4').addClass('showit'); }, 2000 );
}



/* trace
------------------------------------------- */

window.trace = function(message)
{
	if (typeof console != 'undefined')
	{
		console.log(message);
	}
}