<?php



/* Official Rules
=================================================================== */

$app->get( '/official_rules(/:lang)', function( $lang = null ) use ( $app, $lang_array )
{
	View::display( 'rules.php',
	[
		'lang' => $lang
	]);

	$app->stop();
});




/* Admin
=================================================================== */

$app->map( '/export', function() use ( $app )
{
	session_start();

	if( isset($_POST['login']) )
	{
		if( $_POST['username'] == 'moreyellow' && $_POST['password'] == '8FTrHFDF' )
		{
			$_SESSION['admin'] = 1;
			unset( $_SESSION['error'] );
			redirect('index.php/export');
		}
		else
		{
			$_SESSION['error'] = 1;
			unset( $_SESSION['admin'] );
		}
	}

	View::display( 'export.php' );

	$app->stop();


})->via('GET', 'POST');


$app->get( '/export_data', function( $lang = null ) use ( $app, $lang_array )
{
	session_start();
	if( !isset($_SESSION['admin']) ) exit('Please login');


	if( isset($_GET['day']) && isset($_GET['match'])  )
	{
		$fileName = 'dota2_gameready-day_'.$_GET['day'].'-match_'.$_GET['match'].'-'.time().'.csv';

		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-Description: File Transfer');
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename={$fileName}");
		header("Expires: 0");
		header("Pragma: public");

		$entries_found = DB::table('tweets')->where('day_number', $_GET['day'] )->where('match_number', $_GET['match'] )->get();

		$fh = @fopen( 'php://output', 'w' );
		$headerDisplayed = false;

		$counter = 1;
		$user_counter = [];

		foreach( $entries_found as $entry )
		{
			$entry = (array) $entry;
			$entry = array_merge( [ 'number' => $counter ], $entry );

			if( isset( $user_counter[$entry['tweet_user_id']] ) )
			{
				if( $user_counter[$entry['tweet_user_id']] >= 25 ) continue;
			}

			if ( !$headerDisplayed )
			{
				fputcsv( $fh, array_keys($entry) );
				$headerDisplayed = true;
			}

			fputcsv($fh, $entry);

			if( isset( $user_counter[$entry['tweet_user_id']] ) )
			{
				$user_counter[$entry['tweet_user_id']]++;
			}
			else
			{
				$user_counter[$entry['tweet_user_id']] = 1;
			}

			$counter++;
		}

		fclose($fh);

		exit();
	}
	else if( isset($_GET['day']) )
	{
		$fileName = 'dota2_gameready-day_'.$_GET['day'].'-'.time().'.csv';

		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-Description: File Transfer');
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename={$fileName}");
		header("Expires: 0");
		header("Pragma: public");

		$entries_found = DB::table('tweets')->where('day_number', $_GET['day'] )->get();

		$fh = @fopen( 'php://output', 'w' );
		$headerDisplayed = false;

		$counter = 1;
		$user_counter = [];

		foreach( $entries_found as $entry )
		{
			$entry = (array) $entry;
			$entry = array_merge( [ 'number' => $counter ], $entry );

			if( isset( $user_counter[$entry['tweet_user_id']] ) )
			{
				if( $user_counter[$entry['tweet_user_id']] >= 25 ) continue;
			}

			if ( !$headerDisplayed )
			{
				fputcsv( $fh, array_keys($entry) );
				$headerDisplayed = true;
			}

			fputcsv($fh, $entry);

			if( isset( $user_counter[$entry['tweet_user_id']] ) )
			{
				$user_counter[$entry['tweet_user_id']]++;
			}
			else
			{
				$user_counter[$entry['tweet_user_id']] = 1;
			}

			$counter++;
		}

		fclose($fh);

		exit();
	}
	else if( isset($_GET['all']) )
	{
		$fileName = 'dota2_gameready-all-'.time().'.csv';

		//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		//header('Content-Description: File Transfer');
		//header("Content-type: text/csv");
		//header("Content-Disposition: attachment; filename={$fileName}");
		//header("Expires: 0");
		//header("Pragma: public");

		$entries_found = DB::table('tweets')->get();

		$fh = @fopen( 'php://output', 'w' );
		$headerDisplayed = false;

		$counter = 1;
		$user_counter = [];

		foreach( $entries_found as $entry )
		{
			$entry = (array) $entry;
			$entry = array_merge( [ 'number' => $counter ], $entry );

			if( !isset($user_counter[$entry['day_number']]) )
			{
				$user_counter[$entry['day_number']] = array();
			}

			if( isset( $user_counter[$entry['day_number']][$entry['tweet_user_id']] ) )
			{
				if( $user_counter[$entry['day_number']][$entry['tweet_user_id']] >= 25 ) continue;
			}

			if ( !$headerDisplayed )
			{
				fputcsv( $fh, array_keys($entry) );
				$headerDisplayed = true;
			}

			fputcsv($fh, $entry);

			if( isset( $user_counter[$entry['day_number']][$entry['tweet_user_id']] ) )
			{
				$user_counter[$entry['day_number']][$entry['tweet_user_id']]++;
			}
			else
			{
				$user_counter[$entry['day_number']][$entry['tweet_user_id']] = 1;
			}

			$counter++;
		}

		fclose($fh);

		exit();
	}

	$app->stop();
});




/* Main Page
=================================================================== */

$app->get( '/(:lang)', function( $lang = null ) use ( $app, $lang_array )
{
	if( $lang == null )
	{
		if( isset($_COOKIE['language']) && $_COOKIE['language'] != 'us' )
		{
			redirect('index.php/'.$_COOKIE['language']);
		}

		$lang = 'us';
	}
	else
	{
		if( !in_array( $lang, [ 'us', 'ru', 'br', 'es', 'de' ] ) ) redirect('/');

		setcookie( 'language', $lang, strtotime( '+1 year' ), '/' );
		if( $lang == 'us' )
		{
			redirect('/');
		}
	}


	$lang_content = ( object ) $lang_array[$lang];



	require APP_PATH.'/data/teams.php';
	require APP_PATH.'/data/brackets.php';

	View::display( 'main.php',
	[
		'lang' => $lang,
		'lang_content' => $lang_content,
		'teams' => $teams,
		'round' => $bracket_days[$day_number],
		'day_number' => $day_number,
		'match_number' => $match_number
	]);



	$app->stop();
});








/* Process Tweet Count
=================================================================== */

$app->get( '/cron/process/TbjZberd', function() use ( $app, $services, $lang_array )
{
	$lang_content = ( object ) $lang_array['us'];
	require APP_PATH.'/data/teams.php';
	require APP_PATH.'/data/brackets.php';

	$bench = microtime(true);

	\Codebird\Codebird::setConsumerKey( "YUMwZl6rxadvnUTJRzNfHH6Ay", "KYpaU7UynzG3cGXMWrqyMSzXmIWkSkyVFmI4kmrJqkICMixpr5");
	$twitter = \Codebird\Codebird::getInstance();
	$twitter->setToken("37515099-dgFNnBdkRSW8tPNI2v1PFziBeTjyTkgCmmRdRU5r0", "0Y6lstEL0YTMVvaJrL8QkuybmviaK0BqZRQKfuNxQHwej");

	$twitter_search = urlencode('#ESLONE #GameReady');
	// $twitter_search = urlencode('#TI6');

	$twitter_count = 100;

	$tweet_data = [];

	$since_id = DB::table('tweets')->orderby( 'tweet_id', 'desc' )->take(1)->value('tweet_id');
	$since_query = ( $since_id )? "&since_id=$since_id" : '';

	$max_query = '';

	for ($i=0; $i < 3; $i++)
	{
		$stream = $twitter->search_tweets("q=$twitter_search&result_type=recent&include_entities=true&count=$twitter_count$since_query$max_query", false);

		if( $stream && count($stream->statuses) )
		{
			foreach( $stream->statuses as $tweet )
			{
				$entry_data = null;
				$tweet_found = DB::table('tweets')->where( 'tweet_id', $tweet->id )->exists();

				if( !$tweet_found )
				{
					$team_key = get_team_key( $tweet->entities->hashtags, $teams );
					// if( !$team_key ) continue;

					$entry_data =
					[
						'team_key' => $team_key,
						'day_number' => $day_number,
						'match_number' => $match_number,
						'tweet_id' => $tweet->id,
						'tweet_text' => $tweet->text,
						'tweet_user_id' => $tweet->user->id,
						'tweet_user_name' => $tweet->user->name,
						'tweet_user_screen_name' => $tweet->user->screen_name,
						'tweet_posted' => Time::mysql( $tweet->created_at ),
						'created_at' => Time::now()
					];

					$tweet_data[] = $entry_data;

					$user_tweet_count = DB::table('tweets')->where( 'day_number', $day_number )->where( 'match_number', $match_number )->where( 'tweet_user_id', $tweet->user->id )->count();

					if( $user_tweet_count < 25 )
					{
						add_tweet_count( $entry_data );
					}
				}
			}

		} // if stream

		if( isset($tweet_data[0]) )
		{
			$max_id = $tweet_data[0]['tweet_id'];
			$max_query = "&max_id=$max_id";
		}

		// trace( count($stream->statuses) );
		if( count( $tweet_data ) != 100 ) break;

	} // end for loop

	if( count($tweet_data) != 0 )
	{
		DB::table('tweets')->insert( $tweet_data );
	}

	trace( $tweet_data );
	trace( (microtime(true) - $bench) );


	$app->stop();
});


/* Backup Tweet Count
=================================================================== */

$app->get( '/cron/backup/TbjZberd', function() use ( $app, $services, $lang_array )
{
	$lang_content = ( object ) $lang_array['us'];
	require APP_PATH.'/data/teams.php';
	require APP_PATH.'/data/brackets.php';

	$bench = microtime(true);

	\Codebird\Codebird::setConsumerKey( "YUMwZl6rxadvnUTJRzNfHH6Ay", "KYpaU7UynzG3cGXMWrqyMSzXmIWkSkyVFmI4kmrJqkICMixpr5");
	$twitter = \Codebird\Codebird::getInstance();
	$twitter->setToken("37515099-dgFNnBdkRSW8tPNI2v1PFziBeTjyTkgCmmRdRU5r0", "0Y6lstEL0YTMVvaJrL8QkuybmviaK0BqZRQKfuNxQHwej");

	$twitter_search = urlencode('#ESLONE #GameReady');

	$twitter_count = 100;

	$tweet_data = [];

	$stream = $twitter->search_tweets("q=$twitter_search&result_type=recent&include_entities=true&count=$twitter_count", false);

	if( $stream && count($stream->statuses) )
	{
		foreach( $stream->statuses as $tweet )
		{
			$entry_data = null;
			$tweet_found = DB::table('tweets')->where( 'tweet_id', $tweet->id )->exists();

			if( !$tweet_found )
			{
				$team_key = get_team_key( $tweet->entities->hashtags, $teams );
				// if( !$team_key ) continue;

				$entry_data =
				[
					'team_key' => $team_key,
					'day_number' => $day_number,
					'match_number' => $match_number,
					'tweet_id' => $tweet->id,
					'tweet_text' => $tweet->text,
					'tweet_user_id' => $tweet->user->id,
					'tweet_user_name' => $tweet->user->name,
					'tweet_user_screen_name' => $tweet->user->screen_name,
					'tweet_posted' => Time::mysql( $tweet->created_at ),
					'created_at' => Time::now()
				];

				$tweet_data[] = $entry_data;

				$user_tweet_count = DB::table('tweets')->where( 'day_number', $day_number )->where( 'match_number', $match_number )->where( 'tweet_user_id', $tweet->user->id )->count();

				if( $user_tweet_count < 25 )
				{
					add_tweet_count( $entry_data );
				}
			}
		}

	} // if stream



	if( count($tweet_data) != 0 )
	{
		DB::table('tweets')->insert( $tweet_data );
	}

	trace( $tweet_data );
	trace( (microtime(true) - $bench) );


	$app->stop();
});



/* get_team_key
=================================================================== */

function get_team_key( $hashtags, $teams )
{
	foreach( $hashtags as $tag )
	{
		foreach( $teams as $team )
		{
			if( $team['hashtag'] == $tag->text ) return $team['key'];
		}
	}

	return 0;
}


/* add_tweet_count
=================================================================== */

function add_tweet_count( $tweet )
{
	$entry_found = DB::table('tweet_count')->where( 'team_key', $tweet['team_key'] )->where( 'day_number', $tweet['day_number'] )->first();

	if( !$entry_found )
	{
		$entry_id = DB::table('tweet_count')->insertGetId(
		[
			'day_number' => $tweet['day_number'],
			'team_key' => $tweet['team_key'],
			'tweet_count' => 1
		]);
	}
	else
	{
		DB::table('tweet_count')->where( 'id', $entry_found->id )->increment('tweet_count');
	}
}
