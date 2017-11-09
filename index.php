<?php
session_start();
//共通データ
if(isset($_POST["class"])){
	$res = "<option value=\"\">選択してください(任意)</option>";
	$class = $_POST["class"];
	foreach($_SESSION["cache"]["middle"][$class] as $key=>$val){
		$res .= "<option value = '".$key."'>".$key."&nbsp;".$val."</option>";
	}
	echo $res;
	exit;
}

if(!@$_SESSION["cache"]["pref"]){
//都道府県
$apiurl = "api/v1/prefectures";
$prefdata = GetResasData($apiurl);
foreach($prefdata["result"] as $key=>$val){
	$_SESSION["cache"]["pref"][$val["prefCode"]] = $val["prefName"];
}
}

if(!@$_SESSION["cache"]["broad"]){
//職業大分類
$apiurl = "api/v1/jobs/broad";
$broaddata = GetResasData($apiurl);
foreach($broaddata["result"] as $key=>$val){
	$_SESSION["cache"]["broad"][$val["iscoCode"]] = $val["iscoName"];
}
}

if(!@$_SESSION["cache"]["middle"]){
//職業中分類
$apiurl = "api/v1/jobs/middle";
foreach($_SESSION["cache"]["broad"] as $key=>$val){
$param = array(
	"iscoCode"=>$key,
);
$middledata = GetResasData($apiurl,$param);
foreach($middledata["result"] as $key=>$val){
	$_SESSION["cache"]["middle"][$val["iscoCode"]][$val["ismcoCode"]] = $val["ismcoName"];
}
}
}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="css/common.css" type="text/css" />
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<title>鳥取のいいとこドリ！</title>
</head>
<body>
<div id="top">
   <div id="wrapper">
      <div id="header">
         <h1><a href="index.html"><font color="#ffffff">鳥取県転職応援サイト「鳥帰族」
         </font></a>
           <img src="images/logo.jpg" width="100" height="60" alt="サンプル" /></div></h1>
      </div><!-- /#header -->
      <div id="contents">
         <div id="main">
		 <form action = "index2.php" method = "POST">
            <div class="section">
               <h2>人生シミュレータ</h2>
               <p>
                 鳥取県で就職を検討しているけど、働き場所がなさそう、お金が稼げなそう。
                 本当にそう？実際に自分のライフプランで見てみよう！<br>
                 下の質問に答えて、あなたの知らない鳥取県の魅力を知ってみて！<br />
               </p>

               <p>
               <h3>Q1.現在の希望勤務地は？</h3>
                 <select name="q1">
                 <option value="">選択してください</option>
                   <optgroup label="北海道">
                   <option value="1">北海道</option>
                   </optgroup>
                   <optgroup label="東北">
                   <option value="2">青森</option>
                   <option value="3">岩手</option>
                   <option value="4">宮城</option>
                   <option value="5">秋田</option>
                   <option value="6">山形</option>
                   <option value="7">福島</option>
                   </optgroup>
                   <optgroup label="関東">
                   <option value="8">茨城</option>
                   <option value="9">栃木</option>
                   <option value="10">群馬</option>
                   <option value="11">埼玉</option>
                   <option value="12">千葉</option>
                   <option value="13" selected>東京</option>
                   <option value="14">神奈川</option>
                   </optgroup>

                   <optgroup label="中部">
                   <option value="15">新潟</option>
                   <option value="16">富山</option>
                   <option value="17">石川</option>
                   <option value="18">福井</option>
                   <option value="19">山梨</option>
                   <option value="20">長野</option>
                   <option value="21">岐阜</option>
                   <option value="22">静岡</option>
                   <option value="23">愛知</option>
                   </optgroup>
                   <optgroup label="近畿">
                   <option value="24">三重</option>
                   <option value="25">滋賀</option>
                   <option value="26">京都</option>
                   <option value="27">大阪</option>
                   <option value="28">兵庫</option>
                   <option value="29">奈良</option>
                   <option value="30">和歌山</option>
                   </optgroup>
                   <optgroup label="中国">
                   <option value="32">島根</option>
                   <option value="33">岡山</option>
                   <option value="34">広島</option>
                   <option value="35">山口</option>
                   </optgroup>

                   <optgroup label="四国">
                   <option value="36">徳島</option>
                   <option value="37">香川</option>
                   <option value="38">愛媛</option>
                   <option value="39">高知</option>
                   </optgroup>
                   <optgroup label="九州">
                   <option value="40">福岡</option>
                   <option value="41">佐賀</option>
                   <option value="42">長崎</option>
                   <option value="43">熊本</option>
                   <option value="44">大分</option>
                   <option value="45">宮崎</option>
                   <option value="46">鹿児島</option>
                   <option value="47">沖縄</option>
                   </optgroup>
                </select>
                </p>
				
                <p>
                <h3>Q2.あなたの年齢は？</h3>
                  <select name="q11" id = "q11">
					
					<?php for($i=18;$i<=60;$i++){?>
					<option value="<?php echo $i;?>"<?php if($i == 25){echo " selected";}?>><?php echo $i;?>歳</option>
					<?php }?>					
                  </select>
                </p>

                <p>
                <h3>Q3.希望職種は？</h3>
                  <select name="q2" id = "q2">
					<option value="">選択してください</option>
					<?php foreach($_SESSION["cache"]["broad"] as $key=>$val){?>
					<option value="<?php echo $key;?>"><?php echo $key."&nbsp;".$val;?></option>
					<?php }?>					
                  </select>
                  <select name="q2-1" id = "q2-1" style="display:none">
                  </select>
                </p>




				
				
                <p>
                  <h3>Q4.結婚したい？</h3>
                    <label><input type="radio" name="q3" id="q3-1" value="Yes" checked>はい　</label><br>
                    <label><input type="radio" name="q3" id="q3-2" value="No">いいえ</label>
                </p>

                <p>
                <h3>Q5.子供は何人欲しい？</h3>
                ※Q4でいいえを選んだ方は０人を選択してください<br>
                  <select name="q4" id ="q4">
                    <option value="">選択してください</option>
                    <option value="0">０人</option>
                    <option value="1">１人</option>
                    <option value="2">２人</option>
                    <option value="3">３人</option>
                    <option value="4">４人</option>
                    <option value="5">５人以上</option>
                  </select>
                </p>

                <p>
                <h3>Q6.持ち家が欲しい？</h3>
                  <label><input type="radio" name="q5" value="Yes" id="q5-1" checked>はい　</label><br>
                  予算はいくらまで？<br>
                  <select name="q5" id="q5-r1">
                    <option value="">選択してください</option>
                    <option value="1">１千万円以下</option>
                    <option value="2">２千万円以下</option>
                    <option value="3">３千万円以下</option>
                    <option value="4">４千万円以下</option>
                    <option value="5">５千万円以下</option>
                    <option value="6">それ以上</option>
                  </select>
                </p>
                  <label><input type="radio" name="q5" value="No" id="q5-2">いいえ</label><br>
                  毎月の家賃はいくらまで？<br>
                  <select name="q5" id = "q5-r2" disabled>
                    <option value="">選択してください</option>
                    <option value="1">４万円以下</option>
                    <option value="2">６万円以下</option>
                    <option value="3">８万円以下</option>
                    <option value="4">１０万円以下</option>
                    <option value="5">１５万円以下</option>
                    <option value="6">それ以上</option>
                  </select>
                </p>
<!--
                <p>
                <h3>Q6.地元に貢献したい？</h3>
                    <label><input type="radio" name="q6" value="Yes">はい</label><br>
                    <label><input type="radio" name="q6" value="No">いいえ</label><br>
                </p>
-->
                <p>
                <h3>Q7.車が欲しい？</h3>
                  <label><input type="radio" name="q7" value="Yes" id="q7-1" checked>はい</label><br>
                  <select name="q7" id = "q7-r">
                    <option value="">選択してください</option>
                    <option value="1">１台</option>
                    <option value="2">２台</option>
                    <option value="3">３台以上</option>
                  </select><br>
                  <label><input type="radio" name="q7" value="No" id="q7-2">いいえ</label><br>
                </p>

                <p>
                <h3>Q8.どっちが大切？</h3>
                  <label><input type="radio" name="q8" value="Yes" checked>働いてたくさんお金を稼ぐ</label><br>
                  <label><input type="radio" name="q8" value="No">自由に使える時間</label><br>
                </p>

                <p>
                <h3>Q9.通勤時間はどれくらい？</h3>
                <select name="q9">
                  <option value="">選択してください</option>
                  <option value="1">１５分以下</option>
                  <option value="2">３０分以下</option>
                  <option value="3">１時間以下</option>
                  <option value="4">気にしない</option>
                </select>
                </p>

                <p>
				<h3>Q10.鳥取が好き？</h3>
                <label><input type="radio" name="q10" value="Yes">はい　</label><br>
                </p>

                <p>お疲れさまでした。下のボタンをクリックしてみてね！<br>
                <input id="submit_button" type="submit" name="submit" value="診断する")
                </p>
				</form>

                <div id="footer">
                  <div class="copyright">Copyright &copy; Team U All Rights Reserved.</div>
                </div><!-- /#footer -->
   </div><!-- /#wrapper -->
</div><!-- /#top -->
</body>
</html>

<script>
$(function(){
	$("#q2").change(function(){
	$.ajax({		
		type:"POST",
		url:"index.php",
		data:{
			"class":this.value,
		},
		}).done(function(data) {
			//データ置き換え
			$("#q2-1").empty()
			$("#q2-1").css("display","inline").append(data);
		});
	});
	$("#q3-1").click(function(){
		$("#q4").removeAttr("disabled");
	});
	$("#q3-2").click(function(){
		$("#q4").attr("disabled","disabled");
	});
	
	$("#q5-1").click(function(){
		$("#q5-r1").removeAttr("disabled");
		$("#q5-r2").attr("disabled","disabled");
	});	
	$("#q5-2").click(function(){
		$("#q5-r1").attr("disabled","disabled");
		$("#q5-r2").removeAttr("disabled");

	});	
	$("#q7-1").click(function(){
		$("#q7-r").removeAttr("disabled");
	});
	$("#q7-2").click(function(){
		$("#q7-r").attr("disabled","disabled");
	});
});

</script>
<?php
function GetResasData($apiurl,$param=""){
//usleep(200);
$bsaeurl = "https://opendata.resas-portal.go.jp/";
// リクエストヘッダ
$header = array(
    "X-API-KEY:c0LTg66C8W9UPrLJ8A0XdJFlDRxsrWLuyUUzS7nH",
);
// HTTPコンテキスト
$options = array('http' =>
        array(
        "method" => 'GET',
        "header" => implode("\r\n", $header),
    )
);
	
	if($param){
		$apiurl .= "?".http_build_query($param);
	}
	return json_decode(file_get_contents($bsaeurl.$apiurl , false, stream_context_create($options)),true);
}
?>