<?php
$writeError = "";
$writeSuccess = "";
include "./accounts/db/config.php";
include "./accounts/sendmail/verification/article_posted.php";
include "./accounts/includes/rand.php";
use Utils\RandomStringGenerator;
if(isset($_POST['title'])){
    $title = trim($_POST['title']);
    $article = trim($_POST['article']);

    // file upload
    include "includes/fileupload.php";
    if (isset($dest_path)){
      $filepath = $dest_path;
    } else {
      $filepath = "./static/images/jumbotron.png";
    }
    //check if inputs are empty
    if(empty($title) && empty($article)){
      $writeError = "You have to write something";
    } else if(empty($title)){
      $writeError = "You have to have a title for your article!";
    } else if(empty($article)){
      $writeError = "You have to write something!";
    } else if(empty($filepath)){
      $writeError = "Oops internal server error! we're on it! 😜";
    } else {
      //Generate brief description
      $brief_desc = $article;
      $len = 210; $append = '...';
      (strlen($brief_desc)>$len)?$yoh = substr($brief_desc, 0, $len-strlen($append)).$append: $yoh = $brief_desc;
       $yoh = $brief_desc;
      //Generate Aricle ID
      $generator = new RandomStringGenerator;
      $articleID = $generator->generate(16);
      //Find user details
      $query = $conn->prepare( "select Username,Email,UserId,Verified,RefferalCode,Downlines,Balance,DescInvestments from users where SessionID=?" );
      $query->execute([$_SESSION['sessionID']]);
      $row = $query->fetch(PDO::FETCH_OBJ);
      $username = $row->Username;
      $email = $row->Email;

      //Insert article into db
      $approval = 0;
      $stmt = $conn->prepare("INSERT INTO blogs (Author,Title,Brief_desc,ImagePath,Article,Article_ID,Approved) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$username,$title,$brief_desc,$filepath,$article,$articleID,$approval]);
      $stmt = null;
      $writeSuccess = "Article posted sussessfully!";
      //Inform user about the article to be approved
      $query = $conn->prepare( "select ID,Date_published from blogs where Article_ID=?" );
      $query->execute([$articleID]);
      $row = $query->fetch(PDO::FETCH_OBJ);
      $ID = $row->ID;
      $date = $row->Date_published;
      $thearticle = $ID.';'.$articleID.';'.$title.';'.$username.';'.$date;
      $stmt = $conn->prepare("INSERT INTO core (Approval) VALUES (?)");
      $stmt->execute([$thearticle]);
      $stmt = null;
      
      sendmail($email, $articleID, $title, $username);
    }
    
}
?>
<style>
    .err{
        color: red;
        border: 1px solid #ffe1c1;
        border-left: 2px solid red;
        background-color: #ffe1c1;
        padding: 10px;
        padding-left: 20px;
        border-radius: 5px;
    }
    .success{
        color: green;
        border: 1px solid #bae597;
        border-left: 2px solid green;
        background-color: #bae597;
        padding: 10px;
        padding-left: 20px;
        border-radius: 5px;
    }
h2 {
  font-family: "Roboto", sans-serif;
  font-size: 26px;
  line-height: 1;
  color: #454cad;
  margin-bottom: 0;
}

p {
  font-family: "Roboto", sans-serif;
  font-size: 18px;
  color: #5f6982;
}

.uploader {
  display: block;
  clear: both;
  margin: 0 auto;
  width: 100%;
  max-width: 940px;
}
.file-upload-c {
  float: left;
  clear: both;
  width: 100%;
  padding: 2rem 1.5rem;
  text-align: center;
  background: #fff;
  border-radius: 7px;
  border: 3px solid #eee;
  transition: all 0.2s ease;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.file-upload-c:hover {
  border-color: #454cad;
}
.file-upload-c.hover {
  border: 3px solid #454cad;
  box-shadow: inset 0 0 0 6px #eee;
}
.file-upload-c.hover #start i.fa {
  transform: scale(0.8);
  opacity: 0.3;
}
.uploader #start {
  float: left;
  clear: both;
  width: 100%;
}
.uploader #start.hidden {
  display: none;
}
.uploader #start i.fa {
  font-size: 50px;
  margin-bottom: 1rem;
  transition: all 0.2s ease-in-out;
}
.uploader #response {
  float: left;
  clear: both;
  width: 100%;
}
.uploader #response.hidden {
  display: none;
}
.uploader #response #messages {
  margin-bottom: 0.5rem;
}
.uploader #file-image {
  display: inline;
  margin: 0 auto 0.5rem auto;
  width: auto;
  height: auto;
  max-width: 180px;
}
.uploader #file-image.hidden {
  display: none;
}
.uploader #notimage {
  display: block;
  float: left;
  clear: both;
  width: 100%;
}
.uploader #notimage.hidden {
  display: none;
}
.uploader progress,
.uploader .progress {
  display: inline;
  clear: both;
  margin: 0 auto;
  width: 100%;
  max-width: 180px;
  height: 8px;
  border: 0;
  border-radius: 4px;
  background-color: #eee;
  overflow: hidden;
}
.uploader .progress[value]::-webkit-progress-bar {
  border-radius: 4px;
  background-color: #eee;
}
.uploader .progress[value]::-webkit-progress-value {
  background: linear-gradient(to right, #393f90 0%, #454cad 50%);
  border-radius: 4px;
}
.uploader .progress[value]::-moz-progress-bar {
  background: linear-gradient(to right, #393f90 0%, #454cad 50%);
  border-radius: 4px;
}
.uploader input[type=file] {
  display: none;
}
.uploader div {
  margin: 0 0 0.5rem 0;
  color: #5f6982;
}
.uploader .btn {
  display: inline-block;
  margin: 0.5rem 0.5rem 1rem 0.5rem;
  clear: both;
  font-family: inherit;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  text-transform: initial;
  border: none;
  border-radius: 0.2rem;
  outline: none;
  padding: 0 1rem;
  height: 36px;
  line-height: 36px;
  color: #fff;
  transition: all 0.2s ease-in-out;
  box-sizing: border-box;
  background: #454cad;
  border-color: #454cad;
  cursor: pointer;
}
#pb{
  margin-top: 40px;
  margin-right: -50px;
}
</style>
<form name="search-form"  enctype="multipart/form-data" action="dashboard.php" method="post" id="file-upload-form" class="uploader">
    <div class="form-group">
        <?php
        if ($writeError != ""){
        echo '<p class="err">'.$writeError.'</p>';
        }
        if ($writeSuccess != ""){
        echo '<p class="success">'.$writeSuccess.'</p>';
        }
        ?>
    </div>
    <div class="form-group">
        <h2 style="margin: 20px 0px;">Write Something Inspiring</h2>
        <input name="title" type="text" class="form-control" placeholder="Enter a title">
    </div>
    <div class="form-group">
        <input id="file-upload" type="file" name="fileUpload" accept="image/*" />

        <label class="file-upload-c" for="file-upload" id="file-drag">
            <img id="file-image" src="#" alt="Preview" class="hidden">
            <div id="start">
                <i class="fa fa-download" aria-hidden="true"></i>
                <div>Select a file or drag here</div>
                <div id="notimage" class="hidden">Please select an image</div>
                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
            </div>
            <div id="response" class="hidden">
                <div id="messages"></div>
                <progress class="progress" id="file-progress" value="0">
                <span>0</span>%
                </progress>
            </div>
        </label>
    </div>
    <div class="form-group">
        <label for="" style="color: transparent;">p</label>
        <textarea name="article" class="form-control" placeholder="Write or Paste your article here!"></textarea>
    </div>
    <div class="form-group sumit-button" id="pb">
        <?php include "./includes/postbutton.php";?>
    </div>
</form>
<iframe style="display:none;" name="frame"></iframe>
<script>
  function fom(){
    var fom = document.getElementById("file-upload-form");
    function handleForm(event) { event.preventDefault(); } 
    fom.addEventListener('submit', handleForm);
  }
    // File Upload
    // 
    function ekUpload(){
    function Init() {

        console.log("Upload Initialised");

        var fileSelect    = document.getElementById('file-upload'),
            fileDrag      = document.getElementById('file-drag'),
            submitButton  = document.getElementById('submit-button');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
        // File Drop
        fileDrag.addEventListener('dragover', fileDragHover, false);
        fileDrag.addEventListener('dragleave', fileDragHover, false);
        fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
    }

    function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }

    function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
        parseFile(f);
        uploadFile(f);
        }
    }

    // Output
    function output(msg) {
        // Response
        var m = document.getElementById('messages');
        m.innerHTML = msg;
    }

    function parseFile(file) {

        console.log(file.name);
        output(
        '<strong>' + encodeURI(file.name) + '</strong>'
        );
        
        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
        document.getElementById('start').classList.add("hidden");
        document.getElementById('response').classList.remove("hidden");
        document.getElementById('notimage').classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file-image').classList.remove("hidden");
        document.getElementById('file-image').src = URL.createObjectURL(file);
        }
        else {
        document.getElementById('file-image').classList.add("hidden");
        document.getElementById('notimage').classList.remove("hidden");
        document.getElementById('start').classList.remove("hidden");
        document.getElementById('response').classList.add("hidden");
        document.getElementById("file-upload-form").reset();
        }
    }

    function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
        pBar.max = e.total;
        }
    }

    function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
        pBar.value = e.loaded;
        }
    }

    function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
        fileInput = document.getElementById('class-roster-file'),
        pBar = document.getElementById('file-progress'),
        fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
        // Check if file is less than x MB
        if (file.size <= fileSizeLimit * 1024 * 1024) {
            // Progress bar
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress', updateFileProgress, false);

            // File received / failed
            xhr.onreadystatechange = function(e) {
            if (xhr.readyState == 4) {
                // Everything is good!

                progress.className = (xhr.status == 200 ? "success" : "failure");
                document.location.reload(true);
            }
            };

            // Start upload
            xhr.open('POST', document.getElementById('file-upload-form').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
        } else {
            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
        }
        }
    }

    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
        Init();
    } else {
        document.getElementById('file-drag').style.display = 'none';
    }
    }
    ekUpload();
</script>