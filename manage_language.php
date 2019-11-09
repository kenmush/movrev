<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

  if(isset($_POST['data_search']))
   {

      $qry="SELECT * FROM tbl_language                   
                  WHERE tbl_language.`language_name` like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_language.`language_name`";
 
     $result=mysqli_query($mysqli,$qry); 

   }
   else
   {
	
	//Get all Category 
	 
      $tableName="tbl_language";   
      $targetpage = "manage_language.php"; 
      $limit = 12; 
      
      $query = "SELECT COUNT(*) as num FROM $tableName";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];
      
      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
        $start = ($page - 1) * $limit; 
      }else{
        $start = 0; 
        } 
      
     $qry="SELECT * FROM tbl_language
                   ORDER BY tbl_language.id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$qry); 
	
    } 

	if(isset($_GET['id']))
	{ 
 
		Delete('tbl_language','id='.$_GET['id'].'');

     
		$_SESSION['msg']="12";
    if(isset($_GET['page'])){
      header( "Location:manage_language.php?page=$_GET[page]");
    }
    else{
      header( "Location:manage_language.php");
    }
		exit;
		
	}	

  function get_total_item($cat_id)
  { 
    global $mysqli;   

    $qry_songs="SELECT COUNT(*) as num FROM tbl_reviews WHERE language_id='".$cat_id."'";
     
    $total_songs = mysqli_fetch_array(mysqli_query($mysqli,$qry_songs));
    $total_songs = $total_songs['num'];
     
    return $total_songs;

  }

  //Active and Deactive status
if(isset($_GET['status_deactive_id']))
{
   $data = array('status'  =>  '0');
  
   $edit_status=Update('tbl_language', $data, "WHERE id = '".$_GET['status_deactive_id']."'");
  
   $_SESSION['msg']="14";
    if(isset($_GET['page'])){
      header( "Location:manage_language.php?page=$_GET[page]");
    }
    else{
      header( "Location:manage_language.php");
    }
   exit;
}
if(isset($_GET['status_active_id']))
{
    $data = array('status'  =>  '1');
    
    $edit_status=Update('tbl_language', $data, "WHERE id = '".$_GET['status_active_id']."'");
    
    $_SESSION['msg']="13";  
    if(isset($_GET['page'])){
      header( "Location:manage_language.php?page=$_GET[page]");
    }
    else{
      header( "Location:manage_language.php");
    } 
    exit;
}  
	 
?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Languages</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                <div class="search_block">
                  <form  method="post" action="">
                  <input class="form-control input-sm" placeholder="Search category..." aria-controls="DataTables_Table_0" type="search" name="search_value" value="<?php if(isset($_POST['search_value'])){ echo $_POST['search_value']; }?>" required>
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div>
                <div class="add_btn_primary"> <a href="add_language.php?add=yes">Add Language</a> </div>
                
              </div>
            </div>
          </div>
           <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
            </div>
          </div>
          <div class="col-md-12 mrg-top">
            <div class="row">
              <?php 
              $i=0;
              while($row=mysqli_fetch_array($result))
              {         
          ?>
              <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="block_wallpaper add_wall_category" style="border-radius: 10px;box-shadow: 0px 2px 5px #999">           
                  <div class="wall_image_title">
                    <h2><a href="javascript:void(0)"><?php echo $row['language_name'];?> <span>(<?php echo get_total_item($row['id']);?>)</span></a></h2>
                    <ul> 
                      <?php if($row['is_on_home']=='on')
                        {
                        ?>
                        <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="Show on Home"><i class="fa fa-home"></i></a></li>
                        <?php
                        }
                      ?>

                      <li><a href="add_language.php?id=<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>               
                      <li><a href="?id=<?php echo $row['id']; if(isset($_GET['page'])){ echo '&page='.$_GET['page'];}?>" data-toggle="tooltip" data-tooltip="Delete" onclick="return confirm('Are you sure you want to delete this language?');"><i class="fa fa-trash"></i></a></li>
                      
                      <?php if($row['status']!="0"){
                          $url="manage_language.php?status_deactive_id=".$row['id'];
                          if(isset($_GET['page'])){
                            $url="manage_reviews.php?status_deactive_id=".$row['id']."&page=".$_GET['page'];
                          }
                      ?>
                      <li><div class="row toggle_btn"><a href="<?=$url?>" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="wallpaper_1" /></a></div></li>

                      <?php }else{
                          $url="manage_language.php?status_active_id=".$row['id'];
                          if(isset($_GET['page'])){
                            $url="manage_reviews.php?status_active_id=".$row['id']."&page=".$_GET['page'];
                          }
                      ?>
                      
                      <li><div class="row toggle_btn"><a href="<?=$url?>" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="wallpaper_1" /></a></div></li>
                  
                      <?php }?>


                    </ul>
                  </div>
                  <span><div style="background: #<?=$row['language_background']?>;height: 150px !important" /></div></span>
                </div>
              </div>
          <?php
            
            $i++;
              }
        ?>     
               
      </div>
          </div>
          <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
