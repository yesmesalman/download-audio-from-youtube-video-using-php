<?php
if(isset($_POST['ytlink'])) {
	  $id=strip_tags($_POST['ytlink']);
    $id=trim($id);
    if (strpos($id, 'youtube.com') !== FALSE)
    {
       $query = parse_url($id, PHP_URL_QUERY);
       parse_str($query, $params);
       $id = $params['v'];
    } 
    if (strpos($id, 'youtu.be') !== FALSE)
    {
        $ex = explode('/',$id);
        $id = end($ex);
    } 
    $jsonData = @file_get_contents("http://api.youtube6download.top/api/?id=$id");
    $links = json_decode($jsonData,TRUE);
    // echo "<pre>";
    // print_r($links);
    // exit();
    $downloadButton = $links['data']['link'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Download YouTube Video's Audio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
      body{
        font-family:verdana;
      }
      .box{
        height: 400px;
        width: 400px;
        margin: 100px auto;
      }
      label,input{
        display:block;
        margin-bottom:10px;
      }
      input{
        width: 100%;
        height: 36px;
        padding: 10px;
        border: 1px solid #ccc;
        font-size: 14px;
        border-radius: 3px;
      }
      button{
        background: #000;
        border: #000;
        color: #fff;
        padding: 10px 24px;
        border-radius: 4px;
        font-size: 17px;
      }
  </style>
</head>
<body>
  <div class="box">
    <form action="" method="POST" onsubmit="return validatebeforesubmit(this)">
        <label for="url">YouTube Video Link</label>
        <input type="url" name="ytlink" id="url" placeholder="https://www.youtube.com/watch?v=gCYcHz2k5x0">
      <button type="submit" value="submit">Download Audio</button>
      <?php 
        if(isset($downloadButton)){
          echo $downloadButton;
        }
      ?>
    </form>
  </div>
  <script>
    function validatebeforesubmit(thisform) {
      var yout = thisform.ytlink.value;
      if(yout==null || yout == "")
        {
        alert("Please Enter the Youtube Video URL");
        thisform.ytlink.focus();
        return false;
        }
      return true;
    }   
  </script>
</body>
</html>


  
  
