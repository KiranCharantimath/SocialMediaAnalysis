<?php

$GAPIS = 'https://www.googleapis.com/';
$GAPIS_AUTH = $GAPIS . 'auth/';
$GOAUTH = 'https://accounts.google.com/o/oauth2/';
$CLIENT_ID = '655595230520-q1orl6safs4iluusurqvnjne24j26t64.apps.googleusercontent.com';
$CLIENT_SECRET = '3X7SufjzsAenokz9CyuIva8m';
$REDIRECT_URI = 'http' . ($_SERVER['SERVER_PORT'] == 80 ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
$SCOPES = array(
    $GAPIS_AUTH . 'drive',
    $GAPIS_AUTH . 'drive.file',
    $GAPIS_AUTH . 'userinfo.email',
    $GAPIS_AUTH . 'userinfo.profile'
);
$STORE_PATH = 'credentials.json';

function uploadFile($credentials, $filename, $targetPath)
    {
    global $GAPIS;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $GAPIS . 'upload/drive/v2/files?uploadType=media');
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($filename));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type : text/plain',
        'Content-Length:' . filesize($filename) ,
        'Authorization: Bearer ' . getAccessToken($credentials)
    ));
    $postResult = curl_exec($ch);
    curl_close($ch);
    return json_decode($postResult, true);
    }

function getStoredCredentials($path)
    {
    $credentials = json_decode(file_get_contents($path) , true);
    if (isset($credentials['refresh_token'])) return $credentials;
    $expire_date = new DateTime();
    $expire_date->setTimestamp($credentials['created']);
    $expire_date->add(new DateInterval('PT' . $credentials['expires_in'] . 'S'));
    $current_time = new DateTime();
    if ($current_time->getTimestamp() >= $expire_date->getTimestamp())
        {
        $credentials = null;
        unlink($path);
        }

    return $credentials;
    }

function storeCredentials($path, $credentials)
    {
    $credentials['created'] = (new DateTime())->getTimestamp();
    file_put_contents($path, json_encode($credentials));
    return $credentials;
    }

function requestAuthCode()
    {
    global $GOAUTH, $CLIENT_ID, $REDIRECT_URI, $SCOPES;
    $url = sprintf($GOAUTH . 'auth?scope=%s&redirect_uri=%s&response_type=code&client_id=%s&approval_prompt=force&access_type=offline', urlencode(implode(' ', $SCOPES)) , urlencode($REDIRECT_URI) , urlencode($CLIENT_ID));
    header('Location:' . $url);
    }

function requestAccessToken($access_code)
    {
    global $GOAUTH, $CLIENT_ID, $CLIENT_SECRET, $REDIRECT_URI;
    $url = $GOAUTH . 'token';
    $post_fields = 'code=' . $access_code . '&client_id=' . urlencode($CLIENT_ID) . '&client_secret=' . urlencode($CLIENT_SECRET) . '&redirect_uri=' . urlencode($REDIRECT_URI) . '&grant_type=authorization_code';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
    }

function getAccessToken($credentials)
    {
    $expire_date = new DateTime();
    $expire_date->setTimestamp($credentials['created']);
    $expire_date->add(new DateInterval('PT' . $credentials['expires_in'] . 'S'));
    $current_time = new DateTime();
    if ($current_time->getTimestamp() >= $expire_date->getTimestamp()) return $credentials['refresh_token'];
      else return $credentials['access_token'];
    }

function authenticate()
    {
    global $STORE_PATH;
    if (file_exists($STORE_PATH)) $credentials = getStoredCredentials($STORE_PATH);
      else $credentials = null;
    if (!(isset($_GET['code']) || isset($credentials))) requestAuthCode();
    if (!isset($credentials)) $credentials = requestAccessToken($_GET['code']);
    if (isset($credentials) && isset($credentials['access_token']) && !file_exists($STORE_PATH)) $credentials = storeCredentials($STORE_PATH, $credentials);
    return $credentials;

    }
/*
$credentials = authenticate();
$result = uploadFile($credentials, 'my_file.txt', 'demo.txt');

if (!isset($result['id'])) throw new Exception(print_r($result));
  else echo 'File copied successfuly (file Id: ' . $result['id'] . ')'; */
 ?>

<!DOCTYPE html>
<html>
<style>
input[type=text], select,textarea {
    padding: 12px 20px;
    width: 22%;
    text-align: center;
    margin-left: 38%;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
​
input[type=submit] {

    color: white;
    padding: 14px 20px;
    margin-left: 46%;
    margin-top: 2%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
​
input[type=submit]:hover {
    background-color: #45a049;
    margin-left: 46%;
    margin-top: 3%;
}
​input#songName{
    width: 22%;
    text-align: center;
    margin-left: 33%;
}
div form{
    background-color: cadetblue;
    padding: 15px;
}
#lyrics{
    width: 28%;
    margin-left: 36%;
}
#fileToUpload{
  
    margin-top: 2%;
    margin-left: 45%;
    
}
input#Artists{
    width: 18%;
    margin-left: 40%;
    margin-top: 2%;
}
label{
    position: relative;
    margin-left: 45%;

    font-size: 21px;
}
#submit{
    margin-left: 45%;
    margin-top: 2%;
    padding: 10px;
    border-radius: 10px;
    background: #0066A2;
    color: white;
    border-style: outset;
    border-color: #0066A2;
    height: 50px;
    width: 100px;
    font: bold 15px arial, sans-serif;
    text-shadow:none;
}
div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
<body>
​
<h1 align="center">Song Analyser</h1>
​
<div>
  <form action="Upload.php">
    <input type="text" id="songName" name="songName" placeholder="Song Name..">
​    <br>
    <br>

    <textarea rows="4" cols="50" id="lyrics" placeholder="Lyrics of Song Here...."> 
        
     </textarea>
     <br>

     <label for="SongImage">Select Song image</label> 
     <br>
     <input type="file" name="fileToUpload"  value="Song Image" id="fileToUpload" accept="image/*">
     <br>
     <br>

     <label for="SongMp3File">Mp3 Song File</label> 
     <input type="file" value="Song Mp3" name="fileToUpload" id="fileToUpload">
     <br>
​   
    <label for="Artists">Artists</label>
    <input type="text" id="Artists" name="Artists" placeholder="Enter all artists with ';' as delimiter..">
​    <br>

  
    <input type="button" id="submit" value="Submit" onclick="location.href = 'popularity.php';">
  </form>
</div>
​
</body>
</html>
​
