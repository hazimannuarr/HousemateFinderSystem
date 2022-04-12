  <?php  
  include_once 'database.php';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  if (isset($_POST['create'])) {


    try {
      $ALLOWED_FILEEXT = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
      $ALLOWED_MIME = array('image/png', 
        'image/jpeg',
        'image/jpeg','image/pjpeg');

      function allowedfile($tempfile, $destpath) {
        global $ALLOWED_FILEEXT, $ALLOWED_MIME;
        $file_ext = pathinfo($destpath, PATHINFO_EXTENSION);
        $file_mime = mime_content_type($tempfile);
        $valid_extn = in_array($file_ext, $ALLOWED_FILEEXT);
        $valid_mime = in_array($file_mime, $ALLOWED_MIME);
        $allowed_file = $valid_extn && $valid_mime;
        return $allowed_file;
      }

      $image = $_FILES['files']['name'];
      $UPLOAD_DIR = "pictures/";
      $imageroomid = $_POST['rid'];

      if (!empty($image)) {
        $increase = 0;
        $filename2 = "";
        $counter = 0;
        $successupload = 0;
        $newfilename = "";
        foreach ($image as $key => $val) {
          $increase++;
          $temp = $_FILES['files']['tmp_name'][$key];
          $rename = $UPLOAD_DIR.$_FILES['files']['name'][$key];
          $targetFilePath = $UPLOAD_DIR.$val;

          if (allowedfile($temp, $targetFilePath)) {
           move_uploaded_file($temp, $targetFilePath);
           $newfilename = $imageroomid.'_'.$increase.".jpg";
           rename($rename, $UPLOAD_DIR.$newfilename);
           $filename2 .= $newfilename;
           $filename2.= ","; 
           $successupload++;
         }
         else{
           move_uploaded_file($temp, $targetFilePath);
           $newfilename = $imageroomid.'_'.$increase.".jpg";
           rename($rename, $UPLOAD_DIR.$newfilename);
           $successupload++;
           $counter++;
         }
         
       }

       if ($counter == 0) {
        $stmt = $conn->prepare("INSERT INTO dev_room(fld_room_id, fld_room_name, fld_room_price, fld_room_image, fld_address, fld_bathrooms, fld_gender, fld_type, fld_description, fld_room_deposit, fld_landlord,fld_status, fld_state, fld_furnish, fld_wifi, fld_latitude, fld_longitude) VALUES(:roomid, :roomname, :roomprice, :roomimage,:roomaddress, :roombathroom, :roomgender, :roomtype, :roomdescription, :roomdeposit, :landlordid, :roomstatus, :roomstate, :roomfurnish, :roomservice, :roomlatitude, :roomlongitude)");
        
        $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
        
        $stmt->bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $stmt->bindParam(':roomprice', $roomprice, PDO::PARAM_STR);
        $stmt->bindParam(':roomimage', $filename2, PDO::PARAM_STR);
        $stmt->bindParam(':roomaddress', $roomaddress, PDO::PARAM_STR);
        $stmt->bindParam(':roombathroom', $roombathroom, PDO::PARAM_STR);
        $stmt->bindParam(':roomgender', $roomgender, PDO::PARAM_STR);
        $stmt->bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
        $stmt->bindParam(':roomdescription', $roomdescription, PDO::PARAM_STR);
        $stmt->bindParam(':roomdeposit', $roomdeposit, PDO::PARAM_STR);
        $stmt->bindParam(':landlordid', $landlordid, PDO::PARAM_STR);
        $stmt->bindParam(':roomstatus', $roomstatus, PDO::PARAM_STR);
        $stmt->bindParam(':roomstate', $roomstate, PDO::PARAM_STR);
        $stmt->bindParam(':roomfurnish', $roomfurnish, PDO::PARAM_STR);
        $stmt->bindParam(':roomservice', $roomservice, PDO::PARAM_STR);
        $stmt->bindParam(':roomlatitude', $roomlatitude, PDO::PARAM_STR);
        $stmt->bindParam(':roomlongitude', $roomlongitude, PDO::PARAM_STR);
        
        $roomid = $_POST['rid'];
        
        $roomname = strtoupper($_POST['rname']);
        $roomprice = $_POST['rprice'];
        $roomaddress =  $_POST['raddress'];
        $roombathroom = $_POST['rbathroom'];
        $roomgender = $_POST['rgender'];
        $roomtype = $_POST['rtype'];
        $roomdescription = $_POST['rdescription'];
        $roomdeposit = $_POST['rdeposit'];
        $landlordid = $_POST['lid'];
        $roomstatus = $_POST['stat'];  
        $roomstate = $_POST['rstate'];
        $roomfurnish = $_POST['rfurnish'];
        $roomservice = $_POST['rservice'];
        $roomlatitude = $_POST['rlatitude'];
        $roomlongitude = $_POST['rlongitude'];


        $stmt->execute();
        echo "<script>
        alert('New room listed!');
        
        </script>";
      }
      else{

        for ($i=1; $i <=$successupload ; $i++) { 
         $remover =  $imageroomid.'_'.$i.".jpg";
         unlink( $UPLOAD_DIR.$remover);
       }

       echo "<script>
       alert('File is not in required format! (png/jpg/jpeg)');
       </script>";
     }

   }
   else{
    echo "<script>
    alert('Please choose image.');
    
    </script>";
  }


}

catch(PDOException $e)
{
  echo "Error: " . $e->getMessage();
}
}

//Update
// if (isset($_POST['update'])) {

//   try {
//     $ALLOWED_FILEEXT = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
//     $ALLOWED_MIME = array('image/png', 
//       'image/jpeg',
//       'image/jpeg','image/pjpeg');

//     function allowedfile($tempfile, $destpath) {
//       global $ALLOWED_FILEEXT, $ALLOWED_MIME;
//       $file_ext = pathinfo($destpath, PATHINFO_EXTENSION);
//       $file_mime = mime_content_type($tempfile);
//       $valid_extn = in_array($file_ext, $ALLOWED_FILEEXT);
//       $valid_mime = in_array($file_mime, $ALLOWED_MIME);
//       $allowed_file = $valid_extn && $valid_mime;
//       return $allowed_file;
//     }

//     $image = $_FILES['files']['name'];
//     $UPLOAD_DIR = "pictures/";
//     $imageroomid = $_POST['rid'];

//     if (!empty($image)) {
//       $increase = 0;
//       $filename2 = "";
//       $counter = 0;
//       $successupload = 0;
//       $newfilename = "";
//       foreach ($image as $key => $val) {
//         $increase++;
//         $temp = $_FILES['files']['tmp_name'][$key];
//         $rename = $UPLOAD_DIR.$_FILES['files']['name'][$key];
//         $targetFilePath = $UPLOAD_DIR.$val;

//         if (allowedfile($temp, $targetFilePath)) {
//          move_uploaded_file($temp, $targetFilePath);
//          $newfilename = $imageroomid.'_'.$increase.".jpg";
//          rename($rename, $UPLOAD_DIR.$newfilename);
//          $filename2 .= $newfilename;
//          $filename2.= ","; 
//          $successupload++;
//        }
//        else{
//          move_uploaded_file($temp, $targetFilePath);
//          $newfilename = $imageroomid.'_'.$increase.".jpg";
//          rename($rename, $UPLOAD_DIR.$newfilename);
//          $successupload++;
//          $counter++;
//        }

//      }

//      if ($counter == 0) {
//       $stmt = $conn->prepare("UPDATE dev_room SET fld_room_id = :roomid,
//         fld_room_name = :roomname,

//         fld_room_price = :roomprice,
//         fld_room_image = :roomimage, 
//         fld_address = :roomaddress,
//         fld_bathrooms = :roombathroom,
//         fld_gender = :roomgender,
//         fld_type = :roomtype,
//         fld_description = :roomdescription,
//         fld_room_deposit = :roomdeposit,
//         fld_landlord = :landlordid,
//         fld_status = :roomstatus,
//         fld_state = roomstate,
//         fld_furnish = roomfurnish,
//         fld_wifi = roomservice
//         WHERE fld_room_id = :oldcid");

//       $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);

//       $stmt->bindParam(':roomname', $roomname, PDO::PARAM_STR);
//       $stmt->bindParam(':roomprice', $roomprice, PDO::PARAM_STR);
//       $stmt->bindParam(':roomimage', $filename2, PDO::PARAM_STR);
//       $stmt->bindParam(':roomaddress', $roomaddress, PDO::PARAM_STR);
//       $stmt->bindParam(':roombathroom', $roombathroom, PDO::PARAM_STR);
//       $stmt->bindParam(':roomgender', $roomgender, PDO::PARAM_STR);
//       $stmt->bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
//       $stmt->bindParam(':roomdescription', $roomdescription, PDO::PARAM_STR);
//       $stmt->bindParam(':roomdeposit', $roomdeposit, PDO::PARAM_STR);
//       $stmt->bindParam(':landlordid', $landlordid, PDO::PARAM_STR);
//       $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
//       $stmt->bindParam(':roomstatus', $roomstatus, PDO::PARAM_STR);
//       $stmt->bindParam(':roomstate', $roomstate, PDO::PARAM_STR);
//       $stmt->bindParam(':roomfurnish', $roomfurnish, PDO::PARAM_STR);
//       $stmt->bindParam(':roomservice', $roomservice, PDO::PARAM_STR);

//       $roomid = $_POST['rid'];

//       $roomname = $_POST['rname'];
//       $roomprice = $_POST['rprice'];
//       $roomaddress =  $_POST['raddress'];
//       $roombathroom = $_POST['rbathroom'];
//       $roomgender = $_POST['rgender'];
//       $roomtype = $_POST['rtype'];
//       $roomdescription = $_POST['rdescription'];
//       $roomdeposit = $_POST['rdeposit'];
//       $landlordid = $_POST['lid'];
//       $roomstatus = $_POST['stat'];  
//       $roomstate = $_POST['rstate'];
//       $roomfurnish = $_POST['rfurnish'];
//       $roomservice = $_POST['rservice'];
//       $oldcid = $_POST['oldcid'];

//       $stmt->execute();
//       echo "<script>
//       alert('Update Success!');
//       window.location.href='list.php';
//       </script>";
//     }
//     else{

//       $stmt = $conn->prepare("UPDATE dev_room SET fld_room_id = :roomid,
//         fld_room_name = :roomname,

//         fld_room_price = :roomprice,
//         fld_room_image = :roomimage, 
//         fld_address = :roomaddress,
//         fld_bathrooms = :roombathroom,
//         fld_gender = :roomgender,
//         fld_type = :roomtype,
//         fld_description = :roomdescription,
//         fld_room_deposit = :roomdeposit,
//         fld_landlord = :landlordid,
//         fld_status = :roomstatus,
//         fld_state = roomstate,
//         fld_furnish = roomfurnish,
//         fld_wifi = roomservice
//         WHERE fld_room_id = :oldcid");

//       $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);

//       $stmt->bindParam(':roomname', $roomname, PDO::PARAM_STR);
//       $stmt->bindParam(':roomprice', $roomprice, PDO::PARAM_STR);
//       $stmt->bindParam(':roomimage', $filename2, PDO::PARAM_STR);
//       $stmt->bindParam(':roomaddress', $roomaddress, PDO::PARAM_STR);
//       $stmt->bindParam(':roombathroom', $roombathroom, PDO::PARAM_STR);
//       $stmt->bindParam(':roomgender', $roomgender, PDO::PARAM_STR);
//       $stmt->bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
//       $stmt->bindParam(':roomdescription', $roomdescription, PDO::PARAM_STR);
//       $stmt->bindParam(':roomdeposit', $roomdeposit, PDO::PARAM_STR);
//       $stmt->bindParam(':landlordid', $landlordid, PDO::PARAM_STR);
//       $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
//       $stmt->bindParam(':roomstatus', $roomstatus, PDO::PARAM_STR);
//       $stmt->bindParam(':roomstate', $roomstate, PDO::PARAM_STR);
//       $stmt->bindParam(':roomfurnish', $roomfurnish, PDO::PARAM_STR);
//       $stmt->bindParam(':roomservice', $roomservice, PDO::PARAM_STR);

//       $roomid = $_POST['rid'];

//       $roomname = $_POST['rname'];
//       $roomprice = $_POST['rprice'];
//       $roomaddress =  $_POST['raddress'];
//       $roombathroom = $_POST['rbathroom'];
//       $roomgender = $_POST['rgender'];
//       $roomtype = $_POST['rtype'];
//       $roomdescription = $_POST['rdescription'];
//       $roomdeposit = $_POST['rdeposit'];
//       $landlordid = $_POST['lid'];
//       $roomstatus = $_POST['stat'];  
//       $roomstate = $_POST['rstate'];
//       $roomfurnish = $_POST['rfurnish'];
//       $roomservice = $_POST['rservice'];
//       $oldcid = $_POST['oldcid'];

//       $stmt->execute();
//       echo "<script>
//       alert('Update Success!');
//       window.location.href='list.php';
//       </script>";
//     }

//   }
//   else{
//     echo "<script>
//     alert('Please choose image.');

//     </script>";
//   }


// }

// catch(PDOException $e)
// {
//   echo "Error: " . $e->getMessage();
// }
// }
if (isset($_POST['update'])) {
   
    try {
        $ALLOWED_FILEEXT = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
        $ALLOWED_MIME = array('image/png', 
                  'image/jpeg',
                  'image/jpeg','image/pjpeg');

        function allowedfile($tempfile, $destpath) {
          global $ALLOWED_FILEEXT, $ALLOWED_MIME;
          $file_ext = pathinfo($destpath, PATHINFO_EXTENSION);
          $file_mime = mime_content_type($tempfile);
          $valid_extn = in_array($file_ext, $ALLOWED_FILEEXT);
          $valid_mime = in_array($file_mime, $ALLOWED_MIME);
          $allowed_file = $valid_extn && $valid_mime;
          return $allowed_file;
        }

           $image = $_FILES['files']['name'];
           $UPLOAD_DIR = "pictures/";
           $imageroomid = $_POST['rid'];

     if (!empty($image)) {
      $increase = 0;
      $filename2 = "";
      $counter = 0;
      $successupload = 0;
      $newfilename = "";
       foreach ($image as $key => $val) {
        $increase++;
            $temp = $_FILES['files']['tmp_name'][$key];
            $rename = $UPLOAD_DIR.$_FILES['files']['name'][$key];
              $targetFilePath = $UPLOAD_DIR.$val;

            if (allowedfile($temp, $targetFilePath)) {
               move_uploaded_file($temp, $targetFilePath);
                 $newfilename = $imageroomid.'_'.$increase.".jpg";
                 rename($rename, $UPLOAD_DIR.$newfilename);
                 $filename2 .= $newfilename;
                 $filename2.= ","; 
                 $successupload++;
            }
            else{
                 move_uploaded_file($temp, $targetFilePath);
                 $newfilename = $imageroomid.'_'.$increase.".jpg";
                 rename($rename, $UPLOAD_DIR.$newfilename);
                 $successupload++;
                $counter++;
            }
          
        }

        if ($counter == 0) {
            $stmt = $conn->prepare("UPDATE dev_room SET fld_room_id = :roomid,
              fld_room_name = :roomname,
                
              fld_room_price = :roomprice,
              fld_room_image = :roomimage, 
              fld_address = :roomaddress,
              fld_bathrooms = :roombathroom,
              fld_gender = :roomgender,
              fld_type = :roomtype,
              fld_description = :roomdescription,
              fld_room_deposit = :roomdeposit,
              fld_landlord = :landlordid,
              fld_state = :roomstate,
              fld_furnish = :roomfurnish,
              fld_wifi = :roomservice
              WHERE fld_room_id = :oldcid");
               
            $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
            
            $stmt->bindParam(':roomname', $roomname, PDO::PARAM_STR);
            $stmt->bindParam(':roomprice', $roomprice, PDO::PARAM_STR);
            $stmt->bindParam(':roomimage', $filename2, PDO::PARAM_STR);
            $stmt->bindParam(':roomaddress', $roomaddress, PDO::PARAM_STR);
            $stmt->bindParam(':roombathroom', $roombathroom, PDO::PARAM_STR);
            $stmt->bindParam(':roomgender', $roomgender, PDO::PARAM_STR);
            $stmt->bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
            $stmt->bindParam(':roomdescription', $roomdescription, PDO::PARAM_STR);
            $stmt->bindParam(':roomdeposit', $roomdeposit, PDO::PARAM_STR);
            $stmt->bindParam(':landlordid', $landlordid, PDO::PARAM_STR);
            $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
            $stmt->bindParam(':roomstate', $roomstate, PDO::PARAM_STR);
            $stmt->bindParam(':roomfurnish', $roomfurnish, PDO::PARAM_STR);
            $stmt->bindParam(':roomservice', $roomservice, PDO::PARAM_STR);
                       
                    $roomid = $_POST['rid'];
                    
                    $roomname = $_POST['rname'];
                    $roomprice = $_POST['rprice'];
                    $roomaddress =  $_POST['raddress'];
                    $roombathroom = $_POST['rbathroom'];
                    $roomgender = $_POST['rgender'];
                    $roomtype = $_POST['rtype'];
                    $roomdescription = $_POST['rdescription'];
                    $roomdeposit = $_POST['rdeposit'];
                    $landlordid = $_POST['lid'];
                    $roomstate = $_POST['rstate'];
                    $roomfurnish = $_POST['rfurnish'];
                    $roomservice = $_POST['rservice'];
            $oldcid = $_POST['oldcid'];
               
            $stmt->execute();
            echo "<script>
                      alert('Update Success!');
                      window.location.href='list.php';
                  </script>";
                }
        else{

$stmt = $conn->prepare("UPDATE dev_room SET fld_room_id = :roomid,
              fld_room_name = :roomname, 
              
              fld_room_price = :roomprice, 
              fld_address = :roomaddress,
              fld_bathrooms = :roombathroom,
              fld_gender = :roomgender,
              fld_type = :roomtype,
              fld_description = :roomdescription,
              fld_room_deposit = :roomdeposit,
              fld_landlord = :landlordid,
              fld_state = :roomstate,
              fld_furnish = :roomfurnish,
              fld_wifi = :roomservice
              WHERE fld_room_id = :oldcid");
               
            $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
            
            $stmt->bindParam(':roomname', $roomname, PDO::PARAM_STR);
            $stmt->bindParam(':roomprice', $roomprice, PDO::PARAM_STR);
            $stmt->bindParam(':roomaddress', $roomaddress, PDO::PARAM_STR);
            $stmt->bindParam(':roombathroom', $roombathroom, PDO::PARAM_STR);
            $stmt->bindParam(':roomgender', $roomgender, PDO::PARAM_STR);
            $stmt->bindParam(':roomtype', $roomtype, PDO::PARAM_STR);
            $stmt->bindParam(':roomdescription', $roomdescription, PDO::PARAM_STR);
            $stmt->bindParam(':roomdeposit', $roomdeposit, PDO::PARAM_STR);
            $stmt->bindParam(':landlordid', $landlordid, PDO::PARAM_STR);
            $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
            $stmt->bindParam(':roomstate', $roomstate, PDO::PARAM_STR);
            $stmt->bindParam(':roomfurnish', $roomfurnish, PDO::PARAM_STR);
            $stmt->bindParam(':roomservice', $roomservice, PDO::PARAM_STR);
                       
                    $roomid = $_POST['rid'];
                    
                    $roomname = $_POST['rname'];
                    $roomprice = $_POST['rprice'];
                    $roomaddress =  $_POST['raddress'];
                    $roombathroom = $_POST['rbathroom'];
                    $roomgender = $_POST['rgender'];
                    $roomtype = $_POST['rtype'];
                    $roomdescription = $_POST['rdescription'];
                    $roomdeposit = $_POST['rdeposit'];
                    $landlordid = $_POST['lid'];
                    $roomstate = $_POST['rstate'];
                    $roomfurnish = $_POST['rfurnish'];
                    $roomservice = $_POST['rservice'];
            $oldcid = $_POST['oldcid'];
               
            $stmt->execute();
            echo "<script>
                      alert('Update Success!');
                      window.location.href='list.php';
                  </script>";
        }

     }
     else{
        echo "<script>
                  alert('Please choose image.');
                  
              </script>";
     }


    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
//Delete
if (isset($_GET['delete'])) {

  try {

    $stmt = $conn->prepare("DELETE FROM dev_room WHERE fld_room_id = :rid");
    
    $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);
    
    $rid = $_GET['delete'];
    
    $stmt->execute();
    
    echo "<script>
    alert('Room succesfully deleted!');
    window.location.href='list.php';
    </script>";
  }
  
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

    $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_room_id = :rid");

    
    $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);
    
    $rid = $_GET['edit'];
    
    $stmt->execute();
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    $gambar = $editrow['fld_room_image'];
    $extracted = explode(",", $gambar);
    $imagecounter = count($extracted);
  }
  
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}


?>