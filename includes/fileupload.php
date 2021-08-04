<?php
include "./accounts/db/config.php";
    $query = $conn->prepare( "select Username,UserId,Verified,RefferalCode,Downlines,Balance,DescInvestments from users where SessionID=?" );
    $query->execute([$sessionid]);
    $row = $query->fetch(PDO::FETCH_OBJ);
    $UserId = $row->UserId;
  if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK){
    // get details of the uploaded file
    $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
    $fileName = $_FILES['fileUpload']['name'];
    $fileSize = $_FILES['fileUpload']['size'];
    $fileType = $_FILES['fileUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
 
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
 
    if (in_array($fileExtension, $allowedfileExtensions)){
      // directory in which the uploaded file will be moved
      //Check if the directory with the name already exists
        $dir_name = './static/images/uploads/'.$UserId.'/';
        if (!is_dir($dir_name)) {
        mkdir($dir_name);
        $dir_name = './static/images/uploads/'.$UserId.'/';
        }
      $uploadFileDir = $dir_name;
      $dest_path = $uploadFileDir . $newFileName;
 
      if(move_uploaded_file($fileTmpPath, $dest_path)) {
        //$writeSuccess ='File is successfully uploaded.';
      }
      else
      {
        $writeError = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $writeError = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $writeError = 'There is some error in the file upload. Please check the following error.<br>';
    $writeError .= 'Error:' . $_FILES['fileUpload']['error'];
  }