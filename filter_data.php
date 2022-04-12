<!-- JANGAN DELETE! FUNCTION UNTUK FILTER DATA DALAM LIST ROOM! -->


<?php

//fetch_data.php

include('database.php');

$limit = '6';
$page = 1;
$page_array=array();
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}



if(isset($_POST["action"]))
{



	$query = "
		SELECT * FROM dev_room WHERE fld_status = '1'";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND fld_room_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["state"]))
	{
		$state_filter = implode("','", $_POST["state"]);
		$query .= "
		 AND fld_state IN('".$state_filter."')
		";
	}
  if(isset($_POST["morethan"]))
  {

    $query .= "
     AND fld_room_price > 1000
    ";
  }
	if(isset($_POST["Furnished"]))
	{
		$full_filter = implode("','", $_POST["Furnished"]);
		$query .= "
		 AND fld_furnish IN('".$full_filter."')
		";
	}

	if(isset($_POST["Wifi"]))
	{
		$wifi_filter = implode("','", $_POST["Wifi"]);
		$query .= "
		 AND fld_wifi IN('".$wifi_filter."')
		";
	}

	if($_POST['query'] != '')
	{
	  $query .= '
	  AND fld_room_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
	  ';
	}
	$query .= 'ORDER BY INCREMENT ASC ';
	$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_data = $statement->rowCount();


	$statement = $conn->prepare($filter_query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_filter_data = $statement->rowCount();
	$output = '<table class="table table-striped table-bordered">';
	?>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.0.1/tailwind.min.css'>
	<?php 

	if($total_data > 0){
		foreach($result as $readrow)
		{


							$landlordprofile = $readrow['fld_landlord'];
							$room_profile = $conn->prepare("SELECT * FROM users WHERE id = $landlordprofile");
						  $room_profile->execute();
						  $rp = $room_profile->fetch(PDO::FETCH_ASSOC);
							$gambar = $readrow['fld_room_image'];
		          $extracted = explode(",", $gambar);
		          $imageresult = $extracted[0];

              if($rp['fld_photo']==''){
                 $output .= '
                  <div class="col-sm-5 col-lg-4 col-md-4 px-3 py-8" >
                        <div class="ketik bg-white shadow-xl  overflow-hidden" url="room_details.php?roomid='.$readrow['fld_room_id'].'" style="height:460px; border-radius:15px;">
                            <div style="object-fit: fill;">
                               <img src="pictures/'.$extracted[0].'" style="max-height: 180px; width: 100%;">
                  </div> 
                            <div class="p-4">
                                
                                <div style="height:35px; font-size: 12px;" class="uppercase tracking-wide text-sm font-bold text-gray-700 ">
                                  '.$readrow['fld_room_name'].'
                                </div>
                                <div class="text-3xl text-gray-900" style="margin-bottom: 3px;" >RM'.$readrow['fld_room_price'].'/month</div>
                                <div class="text-gray-700" style="font-size: 15px;" ><i class="fas fa-map-marker-alt"></i>&nbsp&nbsp'.$readrow['fld_state'].'</div>
                            </div>
                            <div class="flex p-4 border-t border-gray-300 text-gray-700">
                                <div class="flex-1 inline-flex items-center">
                                    <p><i class="fas fa-wifi"></i> : '.$readrow['fld_wifi'].'</p>
                                </div>
                                <div class="flex-1 inline-flex items-center">
                                    <p><i class="fas fa-couch"></i> : '.$readrow['fld_furnish'].'</p>
                                </div>
                            </div>
                            <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100" style="height: 150px; margin-bottom: auto; margin-top: auto;">
                                <div class="text-xs uppercase font-bold text-gray-600 tracking-wide" style="margin-left: 13px;  margin-bottom: auto; margin-top: auto;">Lister</div>
                                <div class="flex items-center pt-2"  style="margin-left: 13px; ">
                                    <div class="bg-cover bg-center rounded-full mr-4" 
                                    style="background-image: url(images/default.jpg); width: 40px; height: 40px;">
                                    </div>
                                    <div  >
                                        <p class="font-bold text-gray-900" style="font-size: 12px;">'.$rp['Username'].'</p>
                                        <p class="text-sm text-gray-700" style="font-size: 11px;">'.$rp['Email'].'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';

              }else{
                 $output .= '
                <div class="col-sm-5 col-lg-4 col-md-4 px-3 py-8" >
                      <div class="ketik bg-white shadow-xl  overflow-hidden" url="room_details.php?roomid='.$readrow['fld_room_id'].'" style="height:460px; border-radius:15px;">
                          <div style="object-fit: fill;">
                             <img src="pictures/'.$extracted[0].'" style="max-height: 180px; width: 100%;">
                </div> 
                          <div class="p-4">
                              
                              <div style="height:35px; font-size: 12px;" class="uppercase tracking-wide text-sm font-bold text-gray-700 ">
                                '.$readrow['fld_room_name'].'
                              </div>
                              <div class="text-3xl text-gray-900" style="margin-bottom: 3px;" >RM'.$readrow['fld_room_price'].'/month</div>
                              <div class="text-gray-700" style="font-size: 15px;" ><i class="fas fa-map-marker-alt"></i>&nbsp&nbsp'.$readrow['fld_state'].'</div>
                          </div>
                          <div class="flex p-4 border-t border-gray-300 text-gray-700">
                              <div class="flex-1 inline-flex items-center">
                                  <p><i class="fas fa-wifi"></i> : '.$readrow['fld_wifi'].'</p>
                              </div>
                              <div class="flex-1 inline-flex items-center">
                                  <p><i class="fas fa-couch"></i> : '.$readrow['fld_furnish'].'</p>
                              </div>
                          </div>
                          <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100" style="height: 150px; margin-bottom: auto; margin-top: auto;">
                              <div class="text-xs uppercase font-bold text-gray-600 tracking-wide" style="margin-left: 13px;  margin-bottom: auto; margin-top: auto;">Lister</div>
                              <div class="flex items-center pt-2"  style="margin-left: 13px; ">
                                  <div class="bg-cover bg-center rounded-full mr-4" 
                                  style="background-image: url(images/'.$rp['id'].'.jpg); width: 40px; height: 40px;">
                                  </div>
                                  <div  >
                                      <p class="font-bold text-gray-900" style="font-size: 12px;">'.$rp['Username'].'</p>
                                      <p class="text-sm text-gray-700" style="font-size: 11px;">'.$rp['Email'].'</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
          ';

              }

			   

			?>

			<?php 
			
		}

	}else
	{
	  $output .= '
	  <tr>
	    <td colspan="2" align="center">No Room Found</td>
	  </tr>
	  ';
	}



$output .= '
</table>
<br />
<div style="margin: 0 auto;">
  <ul class="pagination">
';
	$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id > $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;
	
}


?>

<style type="text/css">
    
.card-horizontal {
    display: flex;
    flex: 1 1 auto;
}

</style>
<script type="text/javascript">
    $(".ketik").click(function() {
        window.location=$(this).attr("url");
    });
</script>
