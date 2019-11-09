<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	if(isset($_POST['movie_search']))
   {
      
     $quotes_qry="SELECT tbl_language.language_name,tbl_reviews.* FROM tbl_reviews
                  LEFT JOIN tbl_language ON tbl_reviews.language_id= tbl_language.id
                  WHERE tbl_reviews.movie_title like '%".addslashes($_POST['search_value'])."%' 
                  ORDER BY tbl_reviews.movie_title";
               
    $result=mysqli_query($mysqli,$quotes_qry); 
    
   }
   else
   {

      $tableName="tbl_reviews";   
      $targetpage = "manage_reviews.php"; 
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
      
     $quotes_qry="SELECT tbl_language.language_name,tbl_reviews.* FROM tbl_reviews
                  LEFT JOIN tbl_language ON tbl_reviews.language_id= tbl_language.id 
                  ORDER BY tbl_reviews.id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$quotes_qry); 
	} 

  if(isset($_GET['review_id']))
  { 

    $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_reviews WHERE id='.$_GET['review_id'].'');
    $img_res_row=mysqli_fetch_assoc($img_res);
           
    if($img_res_row['movie_image']!="")
     {
          unlink('images/thumbs/'.$img_res_row['movie_image']);
          unlink('images/'.$img_res_row['movie_image']);

          unlink($img_res_row['video_url']);
      }
 
    Delete('tbl_reviews','id='.$_GET['review_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:manage_reviews.php");
    exit;
    
  }

  //Active and Deactive status
if(isset($_GET['status_deactive_id']))
{
   $data = array('status'  =>  '0');
    
   $edit_status=Update('tbl_reviews', $data, "WHERE id = '".$_GET['status_deactive_id']."'");
  
   $_SESSION['msg']="14";
   if(isset($_GET['page'])){
    header( "Location:manage_reviews.php?page=$_GET[page]");
   }
   else{
    header( "Location:manage_reviews.php");
   }
   exit;
}
if(isset($_GET['status_active_id']))
{
    $data = array('status'  =>  '1');
    
    $edit_status=Update('tbl_reviews', $data, "WHERE id = '".$_GET['status_active_id']."'");
    
    $_SESSION['msg']="13";   
    if(isset($_GET['page'])){
      header( "Location:manage_reviews.php?page=$_GET[page]");
    }
    else{
      header( "Location:manage_reviews.php");
    }
    exit;
}

  //Active and Deactive featured
if(isset($_GET['featured_deactive_id']))
{
   $data = array('featured'  =>  '0');
  
   $edit_status=Update('tbl_reviews', $data, "WHERE id = '".$_GET['featured_deactive_id']."'");
  
   $_SESSION['msg']="14";
    if(isset($_GET['page'])){
      header( "Location:manage_reviews.php?page=$_GET[page]");
    }
    else{
      header( "Location:manage_reviews.php");
    }
   exit;
}
if(isset($_GET['featured_active_id']))
{
    $data = array('featured'  =>  '1');
    
    $edit_status=Update('tbl_reviews', $data, "WHERE id = '".$_GET['featured_active_id']."'");
    
    $_SESSION['msg']="13";   
    if(isset($_GET['page'])){
      header( "Location:manage_reviews.php?page=$_GET[page]");
    }
    else{
      header( "Location:manage_reviews.php");
    }
    exit;
}


if(isset($_POST['btn_rating'])){

  $review_id=trim($_POST['review_id']);
  $rating=trim($_POST['movie_rating']);

  $data = array('admin_rate'  =>  $rating);
    
  $edit_status=Update('tbl_reviews', $data, "WHERE id = '".$review_id."'");
  
  $_SESSION['msg']="Rating submitted...";   
  header( "Location:manage_reviews.php");
  exit;



}


?>
 
 <style type="text/css">
    .star-rating span{
      cursor: pointer;
    }
    .star-rating .fa-star
    {
      color: #FFAA00;
    }
 </style>               
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Movies</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                 <div class="search_block">
                      <form  method="post" action="">
                        <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        <button type="submit" name="movie_search" class="btn-search"><i class="fa fa-search"></i></button>
                      </form>  
                    </div>
                <div class="add_btn_primary"> <a href="add_review.php">Add Review</a> </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php if(!empty($client_lang[$_SESSION['msg']])){ echo $client_lang[$_SESSION['msg']]; }else{ echo $_SESSION['msg']; } ; ?></a> </div>
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
              <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="block_wallpaper">
                  <div class="wall_category_block">
                    <h2><?php echo $row['language_name'];?></h2>
                    <?php if($row['admin_rate']!="0"){?>
                        <a href="" class="rate_movie" data-id="<?=$row['id']?>" data-movie="<?php echo stripslashes($row['movie_title']);?>" data-toggle="tooltip" data-tooltip="<?=$row['admin_rate']?> Rating" data-rate="<?=$row['admin_rate']?>" style="margin-left: 5px"><div style="color:green;"><i class="fa fa-star"></i></div></a>
                      <?php }else{?>
                         <a href="" class="rate_movie" data-id="<?=$row['id']?>" data-movie="<?php echo stripslashes($row['movie_title']);?>" data-toggle="tooltip" data-tooltip="Rate to Movie" data-rate="<?=$row['admin_rate']?>" style="margin-left: 5px"><i class="fa fa-star"></i></a> 
                    <?php }?>

                    <?php if($row['featured']!="0"){
                          $url="manage_reviews.php?featured_deactive_id=".$row['id'];
                          if(isset($_GET['page'])){
                            $url="manage_reviews.php?featured_deactive_id=".$row['id']."&page=".$_GET['page'];
                          }
                      ?>
                        <a href="<?=$url?>" data-toggle="tooltip" data-tooltip="Slider"><div style="color:green;"><i class="fa fa-sliders"></i></div></a> 
                      <?php }else{
                          $url="manage_reviews.php?featured_active_id=".$row['id'];
                          if(isset($_GET['page'])){
                            $url="manage_reviews.php?featured_active_id=".$row['id']."&page=".$_GET['page'];
                          }
                        ?>
                         <a href="<?=$url?>" data-toggle="tooltip" data-tooltip="Set As Slider"><i class="fa fa-sliders"></i></a> 
                    <?php }?>               
                  </div>
                  <div class="wall_image_title">
                     <p style="font-size: 16px;color: #fff;text-shadow: 0px 1px 1px #000"><?php echo stripslashes($row['movie_title']);?></p>
                    <ul>
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_views'];?> Views"><i class="fa fa-eye"></i></a></li>                      
                      
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['rate_avg'];?> Rating"><i class="fa fa-star"></i></a></li>
                      

                      <li><a href="edit_review.php?review_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>
                      <li><a href="manage_reviews.php??review_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Delete" onclick="return confirm('Are you sure you want to delete this review?');"><i class="fa fa-trash"></i></a></li>

                      <?php if($row['status']!="0"){
                          $url="manage_reviews.php?status_deactive_id=".$row['id'];
                          if(isset($_GET['page'])){
                            $url="manage_reviews.php?status_deactive_id=".$row['id']."&page=".$_GET['page'];
                          }
                        ?>

                      <li><div class="row toggle_btn"><a href="<?=$url?>" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="wallpaper_1" /></a></div></li>

                      <?php }else{

                          $url="manage_reviews.php?status_active_id=".$row['id'];
                          if(isset($_GET['page'])){
                            $url="manage_reviews.php?status_active_id=".$row['id']."&page=".$_GET['page'];
                          }
                        ?>
                      
                      <li><div class="row toggle_btn"><a href="<?=$url?>" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="wallpaper_1" /></a></div></li>
                  
                      <?php }?>
                    </ul>
                  </div>
                  <span><img src="images/<?php echo $row['movie_cover'];?>" /></span>
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
                <?php if(!isset($_POST["movie_search"])){ include("pagination.php");}?>          
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <!-- Modal -->
  <div id="RatingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12 text-center">
                <h4 class="text-muted" style="margin-top: 0">Rate to Movie !</h4>
                <p>(1-Low, 5-High)</p>
                <form method="post">
                  <div class="star-rating">
                    <span class="fa fa-star-o" style="font-size: 26px" data-rating="1"></span>
                    <span class="fa fa-star-o" style="font-size: 26px" data-rating="2"></span>
                    <span class="fa fa-star-o" style="font-size: 26px" data-rating="3"></span>
                    <span class="fa fa-star-o" style="font-size: 26px" data-rating="4"></span>
                    <span class="fa fa-star-o" style="font-size: 26px" data-rating="5"></span>
                    <input type="hidden" name="movie_rating" class="rating-value" value="1">
                    <input type="hidden" name="review_id">
                  </div>
                  <hr/>
                  <button type="submit" name="btn_rating" class="btn btn-success">Save</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
        
<?php include("includes/footer.php");?>       

<script type="text/javascript">

  var $star_rating = $('.star-rating .fa');

  var SetRatingStar = function() {
    return $star_rating.each(function() {
      if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
        return $(this).removeClass('fa-star-o').addClass('fa-star');
      } else {
        return $(this).removeClass('fa-star').addClass('fa-star-o');
      }
    });
  };

  $star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
  });

  SetRatingStar();

  $(".rate_movie").on("click",function(e){
    e.preventDefault()
    var title=$(this).data("movie");
    var id=$(this).data("id");
    $("input[name='review_id']").val(id);
    if($(this).data("rate")!=0){
      $("input.rating-value").val($(this).data("rate"));
    }else{
      $("input.rating-value").val(1);
    }
    $("#RatingModal .modal-title").text(title);
    $("#RatingModal").modal("show");
    SetRatingStar();
  });
</script>