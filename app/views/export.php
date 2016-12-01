<!doctype html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>#GAMEREADY Admin</title>
	<link rel="canonical" href="<?=url()?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?=url('/assets_min/vendor/vendor.min.css')?>" rel="stylesheet">
	<link href="<?=url('/assets_min/global/css/main.min.css')?>" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans|Fjalla+One:400,300' rel='stylesheet' type='text/css'>

</head>
<body id="admin">


	<?
		if( isset($_SESSION['error']) )
		{
			echo '<p>Incorrect Login</p>';
			unset( $_SESSION['error'] );
		}
	?>

	<?
		if( !isset($_SESSION['admin']) )
		{
			?>
				<form action="<?=url('/export')?>" method="post" accept-charset="utf-8">

					<input type="hidden" name="login" value="1" />
					<input type="text" name="username" placeholder="Username" style="margin-bottom: 10px;" /><br>
					<input type="password" name="password" placeholder="Password" />

					<br><br>

					<button>Submit</button>

				</form>
			<?
		}
		else
		{
			?>
			<h2>Export Options</h2>
			<hr>

			<div class="group">

				<h3>By Match</h3>

				<ul>
					<?
						$matches_found = DB::table('tweets')->select('match_number', 'day_number')->groupBy('match_number')->groupBy('day_number')->orderBy('day_number','ASC')->orderBy('match_number','ASC')->get();

						foreach( $matches_found as $value )
						{
							?>
								<li><a href="<?=url('/export_data?match='.$value->match_number.'&day='.$value->day_number)?>" target="_blank">Day <?=$value->day_number?> - Match <?=$value->match_number?></a></li>
							<?
						}
					?>
				</ul>

			</div>

			<div class="group">

				<h3>By Day</h3>

				<ul>
					<?
						$days_found = DB::table('tweets')->select('day_number')->groupBy('day_number')->get();

						foreach( $days_found as $value )
						{
							?>
								<li><a href="<?=url('/export_data?day='.$value->day_number)?>" target="_blank">Day <?=$value->day_number?></a></li>
							<?
						}
					?>
				</ul>

			</div>

			<? /* ?>
			<div class="group">

				<h3>All</h3>

				<ul>
					<li><a href="<?=url('/export_data?all=1')?>" target="_blank">All Entries</a></li>
				</ul>

			</div>
			<? */ ?>
			<?
		}
	?>




	<? if( Config::get('env') == 'dev' ){ ?>
		<script async src='http://192.168.1.231:8888/browser-sync/browser-sync-client.2.11.1.js'></script>
	<? } ?>

</body>
</html>