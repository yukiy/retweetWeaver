<?php
require_once(dirname(__FILE__)."/twitteroauth/twitteroauth.php");
require_once(dirname(__FILE__)."/keys.php");
require_once(dirname(__FILE__)."/class.perlin.php");
require_once(dirname(__FILE__)."/resizeImage.php");
require_once(dirname(__FILE__)."/mixImages.php");


date_default_timezone_set('Asia/Tokyo');
$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);



function checkImageFormat($filename){
//---if it contains strings "jpg"
	if(stristr($filename, "jpg") || stristr($filename, "jpeg")){
		return "JPG";
	}else if(stristr($filename, "png"));
		return "PNG";
}


function addStringToFile($filepath, $str){
	$fp = fopen($filepath, "w+");
	fwrite($fp, $str);
	fclose($fp);
}


/*
* post data to Twitter API to change my profile image
*/
function updateProfileImage($twObj, $imageData){
	//---POST the image as base64
	$imageData64 = base64_encode($imageData);
	$apiUrl = "https://api.twitter.com/1.1/account/update_profile_image.json";
	$req = $twObj->OAuthRequest($apiUrl, "POST", array('image' => $imageData64));

	//---save on local for records
	file_put_contents(__DIR__ . "/image_log/".date(y).date(m).date(d)."_".date(H).date(i).".jpg", $imageData);
}


/*
* check if there are new RT with log.txt, if so create new profile image
* $imgs: array[myProfileImageUrl, rtProfileImageUrl, rtUserId]
*/
function createNewImageData($imgs){
	$rtUserId = $imgs[2];

	//---read the latest RT-userId
	$latestRtUserId = file_get_contents(__DIR__ . "/log.txt");

	//---if the latest RT-userId is not same as the last one
	if($rtUserId != $latestRtUserId){
		ob_start();

		//---update the latest RT-userId in log.txt
		addStringToFile(__DIR__ . "/log.txt", $rtUserId);

		//---get resized images of 200 x 200
		$myImg = resizeImage($imgs[0], 200, 200, false);
		$rtImg = resizeImage($imgs[1], 200, 200, false);

		//---save RT profile image on local for records
		imagejpeg ($rtImg);
		$rtImageData = ob_get_contents();
		file_put_contents(__DIR__ . "/image_log/".date(y).date(m).date(d)."_".date(H).date(i)."_RT".".jpg", $rtImageData);

		ob_end_clean();
		ob_start();

		//---mix two images (functions are in mixImages.php)
		$outImg = wovenMix($myImg, $rtImg);

		//---create jpg data to return
		imagejpeg ($outImg);
		$imageData = ob_get_contents();

		ob_end_clean();

		return $imageData;
	}else{
		return -1;
	}
}


/*
* get a profile-image-url of mine and a profile-image-url of the user I RT the most recent, and his/her ID.
*/
function getRTProfileImageData($twObj, $size){
	$apiUrl = "https://api.twitter.com/1.1/statuses/user_timeline.json?include_rts=true";
	$req = $twObj->OAuthRequest($apiUrl,"GET",array("screen_name"=>$screenname, "page"=>$page));
	$result = json_decode($req);

	for($i = 0; $i < 100; $i++){
		$tweet = $result[$i];
		//$tweetId = $tweet->id_str;
		//$myUserId = $tweet->user->id;
		$myProfileImageUrl = $tweet->user->profile_image_url;
		$rtProfileImageUrl = $tweet->retweeted_status->user->profile_image_url;
		if($rtProfileImageUrl != null){
			switch($size){
				case 'normal': //48x48
					//echo "<img src='" . $rtProfileImageUrl . "'/>" . "<br/>";
					break;
				case 'bigger': //72 x 73
					$myProfileImageUrl = str_replace('_normal', '_bigger', $myProfileImageUrl);
					$rtProfileImageUrl = str_replace('_normal', '_bigger', $rtProfileImageUrl);
					//echo "<img src='" . $rtProfileImageUrl . "'/>" . "<br/>";
					break;
				case 'original': //usually the biggest
					$myProfileImageUrl = str_replace('_normal', '', $myProfileImageUrl);
					$rtProfileImageUrl = str_replace('_normal', '', $rtProfileImageUrl);
					//echo "<img src='" . $rtProfileImageUrl . "'/>" . "<br/>";
					break;
			}

			$rtUserId = $tweet->retweeted_status->user->id;
			return array($myProfileImageUrl, $rtProfileImageUrl, $rtUserId);
		}
	}
}


/*
* main function.
*/
function run($twObj){
	$imageDataArray = getRTProfileImageData($twObj, 'original');

	$newImageData = createNewImageData($imageDataArray);

	if($newImageData != -1){
		updateProfileImage($twObj, $newImageData);
	}
}

run($twObj);
