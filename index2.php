<?php
session_start();
if(isset($_POST["q1"])){
	foreach($_POST as $key=>$val){
		$$key = $val;
	}
}else{
header("location: index.php");
exit;
}
//csvデータの取り込み
$data = file_get_contents("resultdata.csv");
$data = explode("\r\n",$data);
foreach($data as $key=>$val){
	$getdata[$key+1] = explode(",",$val);
}



?>
<!DOCTYPE HTML>
<!--
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="ja">
	<head>
		<title>Retrospect by TEMPLATED</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/reset.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				 <img src="images/logo.jpg" width="100" height="60" alt="サンプル" align="left" href="index.php">
				<a href="#nav">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="nav">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
				</ul>
			</nav>

		<!-- Banner -->
			<section id="banner">
				<h2>Result</h2>
				<p>あなたのライフプランを<?php echo $_SESSION["cache"]["pref"][$q1]?>と鳥取県で比べてみました！</p>
			</section>

			<section id="one" class="wrapper style1">
				<div class="inner">
					<article class="feature left">
						<span class="image"><img src="images/pic01.jpg" alt="" /></span>
						<div class="content">
							<h2>生涯でかかる費用は<br></h2>
								<h2>・<?php echo $_SESSION["cache"]["pref"][$q1]?>では<?php echo number_format($getdata[$q1][2]*(80-$q11));?>円<br><br>
										・鳥取県では<?php echo number_format(2502168*(80-$q11));?>円</h2>
							<ul class="actions">
							</ul>
						</div>
					</article>

		<!-- One -->
			<section id="two" class="wrapper style1">
				<div class="inner">
					<article class="feature right">
						<div class="content">
							<h2>・鳥取県の土地代は23,662円/㎡</h2>
								<img src="images/hiroi.jpg" width="300" height="300" alt="サンプル" /></div>
						<div class="content">
								<h2>・<?php echo $_SESSION["cache"]["pref"][$q1]?>の土地代は324,392円/㎡<h2>
									<img src="images/semai2.jpg" width="300" height="300" alt="サンプル" /></div>
							<ul class="actions">
							</ul>
						</div>
					</article>
				</div>
			</section>
		<!-- Two -->
		<section id="three" class="wrapper style1">
			<div class="inner">
				<article class="feature right">
					<div class="content">
					<h2>・<?php echo $_SESSION["cache"]["pref"][$q1]?>の平均残業時間は<?php echo number_format($getdata[$q1][4],1);?>分<br><br>
							・鳥取県の平均残業時間は<?php echo number_format($getdata[31][4],1);?>分<br><br>
							<img src="images/zangyo.jpg" width="350" height="300" alt="サンプル" />
						</h2></div>
					<div class="content">
						<h2>・<?php echo $_SESSION["cache"]["pref"][$q1]?>の平均通勤時間は<?php echo number_format($getdata[$q1][3],1);?>分<br><br>
								・鳥取県の平均通勤時間は<?php echo number_format($getdata[31][3],1);?>分<br><br>
								<img src="images/tuukin.jpg" width="350" height="300" alt="サンプル" />
								</h2></div>
						<ul class="actions">
						</ul>
					</div>
				</article>
			</div>
		</section>

		<section id="four" class="wrapper style1">
			<div class="inner">
				<article class="feature right">
				<div class="content">
					<h2>・<?php echo $_SESSION["cache"]["pref"][$q1]?>のおこづかいは<?php echo number_format($getdata[$q1][5]);?>円<br><br>
							・鳥取県のおこづかいは<?php echo number_format($getdata[31][5]);?>円</h2>
						</div>
					<div class="content">
					<h2>・<?php echo $_SESSION["cache"]["pref"][$q1]?>の教育費は<?php echo number_format($getdata[$q1][6]);?>円<br><br>
							・鳥取県の教育費は<?php echo number_format($getdata[31][6]);?>円</h2></div>
						<ul class="actions">
						</ul>
					</div>
				</article>
			</div>
		</section>
		<!-- Four -->
			<section id="four" class="wrapper style2 special">
				<div class="inner">
					<header class="major narrow">
						<h2>Find your job in TOTTORI!</h2>
						<p>あなたにおすすめの企業</p>
						<p><a href="https://www.kotobukispirits.co.jp/">寿スピリッツ株式会社</a></p>
						<p><a href="https://www.tomita-electric.com/">トミタ電機</a></p>
						<p><a href="http://www.nicera.co.jp/">日本セラミック株式会社</a></p>
					</header>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<p>鳥取の魅力に気付いてもらえたかな？<br>SNSに結果をアップして皆に教えよう！</p>
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook">
							<span class="label">
							<a href="https://ja-jp.facebook.com/">Facebook</a></span>
						</a></li>
						<li><a href="#" class="icon fa-twitter">
							<span class="label">
							<a href="https://twitter.com/?lang=ja">Twitter</a></span>
						</a></li>
						<li><a href="#" class="icon fa-instagram">
							<span class="label">
							<a href="https://www.instagram.com/?hl=ja">Instagram</a></span>
						</a></li>
						<li><a href="#" class="icon fa-linkedin">
							<span class="label">
							<a href="https://jp.linkedin.com/">LinkedIn</a></span>
						</a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled.</li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a>.</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a>.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
