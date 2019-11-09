<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");

  error_reporting(E_ALL);

  //Get Language
	$cat_qry="SELECT * FROM tbl_language ORDER BY language_name";
  $cat_result=mysqli_query($mysqli,$cat_qry);


  $genre_qry="SELECT * FROM tbl_genres ORDER BY genre_name";
  $genre_result=mysqli_query($mysqli,$genre_qry); 

  $qry="SELECT * FROM tbl_reviews where id='".$_GET['review_id']."'";
  $result=mysqli_query($mysqli,$qry);
  $row=mysqli_fetch_assoc($result);

  //Gallery Images
  $qry1="SELECT * FROM tbl_photo_gallery where parent_id='".$_GET['review_id']."'";
  $result1=mysqli_query($mysqli,$qry1);
	
	if(isset($_POST['submit']))
	{

      $movie_date=date('Y-m-d',strtotime($_POST['movie_date']));

      if(!empty($_POST['movie_trailer'])){
        $video_url=$_POST['movie_trailer'];

        $youtube_video_url = addslashes($_POST['movie_trailer']);
        parse_str( parse_url( $youtube_video_url, PHP_URL_QUERY ), $array_of_vars );
        $video_id=  $array_of_vars['v'];  
      }else{
        $video_url=  '';
        $video_id=  '';
      }
        
        if($_FILES['movie_cover']['error']==4){
            $movie_cover=$row['movie_cover'];
        }else
        {
            unlink('images/'.$row['movie_cover']);
            unlink('images/thumbs/'.$row['movie_cover']);

            $file_name= str_replace(" ","-",$_FILES['movie_cover']['name']);

            $movie_cover=rand(0,99999)."_".$file_name;
     
            //Main Image
            $tpath1='images/'.$movie_cover;        
            $pic1=compress_image($_FILES["movie_cover"]["tmp_name"], $tpath1, 80);
       
            //Thumb Image 
            $thumbpath='images/thumbs/'.$movie_cover;   
            $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'600','350');
        }

        if ($_FILES['movie_poster']['error']==4)
        {
            $movie_poster=$row['movie_poster'];
        }
        else{
            unlink('images/'.$row['movie_poster']);
            unlink('images/thumbs/'.$row['movie_poster']);

            $file_name= str_replace(" ","-",$_FILES['movie_poster']['name']);

            $movie_poster=rand(0,99999)."_".$file_name;
     
            //Main Image
            $tpath1='images/'.$movie_poster;        
            $pic1=compress_image($_FILES["movie_poster"]["tmp_name"], $tpath1, 80);
       
            //Thumb Image 
            $thumbpath='images/thumbs/'.$movie_poster;   
            $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'270','390');
        }

        $data = array( 
              'language_id'  =>  $_POST['language_id'],
              'genre_id'  =>  $_POST['genre_id'],              
              'movie_title'  =>  addslashes($_POST['movie_title']),
              'movie_casts'  =>  $_POST['movie_casts'],                   
              'movie_cover'  =>  $movie_cover,
              'movie_poster'  =>  $movie_poster,
              'movie_desc'  =>  addslashes($_POST['movie_desc']),
              'movie_date'  =>  $movie_date,
              'video_url'  =>  $video_url,
              'video_id'  =>  $video_id,
              'admin_rate' => $_POST['movie_rating']
              );    
        
        $qry=Update('tbl_reviews', $data, "WHERE id = '".$_POST['review_id']."'");
 
        $review_id=$_POST['review_id'];
        $size_sum = array_sum($_FILES['gallery_image']['size']);
         
        if($size_sum > 0)
         { 
            for ($i = 0; $i < count($_FILES['gallery_image']['name']); $i++) 
            {
         
                 $gallery_image=rand(0,99999)."_".$_FILES['gallery_image']['name'][$i];
               
                 //Main Image
                 $tpath1='images/gallery/'.$gallery_image;       
                 $pic1=compress_image($_FILES["gallery_image"]["tmp_name"][$i], $tpath1, 80);

                  $data1 = array(
                      'parent_id'=>$review_id,
                      'image_name'  => $gallery_image                         
                      );      

                  $qry1 = Insert('tbl_photo_gallery',$data1); 
            }
          }

         
		$_SESSION['msg']="11"; 
		header( "Location:edit_review.php?review_id=".$_POST['review_id']);
		exit;	

		 
	}

  //Delete gallery image
  if(isset($_GET['image_id']))
  {
      $img_rss=mysqli_query($mysqli,'SELECT * FROM tbl_photo_gallery WHERE id=\''.$_GET['image_id'].'\'');
      $img_rss_row=mysqli_fetch_assoc($img_rss);
      
      if($img_rss_row['image_name']!="")
      {
          unlink('images/gallery/'.$img_rss_row['image_name']);     
      }
  
    Delete('tbl_photo_gallery','id='.$_GET['image_id'].'');
    
    header( "Location:edit_review.php?review_id=".$_GET['review_id']);
    exit;
  }
	 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
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
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Edit Review</div>
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
          <div class="card-body mrg_bottom"> 
            <form action="" name="edit_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
                           
              <input  type="hidden" name="review_id" value="<?php echo $_GET['review_id'];?>" />

              <div class="section">
                <div class="section-body">
                   
                   <div class="form-group">
                    <label class="col-md-3 control-label">Language :-</label>
                    <div class="col-md-7">
                      <select name="language_id" id="language_id" class="select2" required>
                        <option value="">--Select Language--</option>
                        <?php
                            while($data=mysqli_fetch_array($cat_result))
                            {
                        ?>                       
                        <option value="<?php echo $data['id'];?>" <?php if($data['id']==$row['language_id']){ echo 'selected';} ?>><?php echo $data['language_name'];?></option>                           
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Genre :-</label>
                    <div class="col-md-7">
                      <select name="genre_id" id="genre_id" class="select2" required>
                        <option value="">--Select Genre--</option>
                        <?php
                            while($genre_row=mysqli_fetch_array($genre_result))
                            {
                        ?>                       
                        <option value="<?php echo $genre_row['gid'];?>" <?php if($genre_row['gid']==$row['genre_id']){?>selected<?php }?>><?php echo $genre_row['genre_name'];?></option>                           
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Movie Title :-</label>
                    <div class="col-md-7">
                      <input type="text" name="movie_title" id="movie_title" value="<?php echo stripslashes($row['movie_title']);?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Movie Trailer Url:-</label>
                    <div class="col-md-7">
                      <input type="url" name="movie_trailer" id="movie_trailer" value="<?=$row['video_url']?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Movie Cast :-<p class="control-label-help">(Cast name using comma separated)</p></label>
                     
                    <div class="col-md-7">
                      <input type="text" name="movie_casts" data-role="tagsinput" id="movie_casts" value="<?php echo $row['movie_casts']?>" class="form-control" required>
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Description :-</label>
                    <div class="col-md-7">                    
                      <textarea name="movie_desc" id="movie_desc" class="form-control"><?php echo $row['movie_desc']?></textarea>

                      <script>CKEDITOR.replace( 'movie_desc' );</script>
                    </div>
                  </div><br> 
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Cover Image:-</label>
                    <div class="col-md-7">
                      <div class="fileupload_block">
                        <input type="file" name="movie_cover" value="" id="fileupload">
                        <div class="fileupload_img">
                          <img type="image" src="assets/images/add-image.png" alt="language image" />
                        </div> 
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp; </label>
                    <div class="col-md-7">
                        <?php if($row['movie_cover']!="") {?>
                            <div class="block_wallpaper"><img src="images/<?php echo $row['movie_cover'];?>" alt="Cover image"/></div>
                        <?php } ?>
                    </div>
                  </div><br>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Poster Image:-</label>
                    <div class="col-md-7">
                      <div class="fileupload_block">
                        <input type="file" name="movie_poster" id="fileupload">
                        <div class="fileupload_img">
                          <img type="image" src="assets/images/add-image.png" alt="language image" />
                        </div> 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp; </label>
                    <div class="col-md-7">
                        <?php if($row['movie_poster']!="") {?>
                            <div class="block_wallpaper"><img src="images/<?php echo $row['movie_poster'];?>" alt="Poster image"/></div>
                        <?php } ?>
                    </div>
                  </div><br>
                  <div class="form-group" id="image_news">
                    <label class="col-md-3 control-label">Gallery Image :-</label>
                    <div class="col-md-7">
                      <div class="fileupload_block">
                        <input type="file" name="gallery_image[]" value="" id="fileupload" multiple>
                            
                            <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="Featured image" /></div>
                           
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="image_name">
                  <label class="col-md-3 control-label">&nbsp;</label>
                      <div class="row">
                          <?php
                            while ($row_img=mysqli_fetch_array($result1)) {?>
                               <div class="col-md-1 col-sm-6">
                          
                            <img src="images/gallery/<?php echo $row_img['image_name'];?>" class="img-responsive">
                           <a href="edit_review.php?image_id=<?php echo $row_img['id'];?>&review_id=<?php echo $_GET['review_id'];?>">Delete</a>
                        </div>
                            <?php
                          }
                          ?>
                         
       
                     </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Release Date :-</label>
                    <div class="col-md-7">
                      <input type="text" name="movie_date" id="datepicker" value="<?php echo date('m/d/Y',strtotime($row['movie_date']));?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Your rating :-</label>
                    <div class="col-md-7">
                        <div class="star-rating">
                          <span class="fa fa-star-o" style="font-size: 26px" data-rating="1"></span>
                          <span class="fa fa-star-o" style="font-size: 26px" data-rating="2"></span>
                          <span class="fa fa-star-o" style="font-size: 26px" data-rating="3"></span>
                          <span class="fa fa-star-o" style="font-size: 26px" data-rating="4"></span>
                          <span class="fa fa-star-o" style="font-size: 26px" data-rating="5"></span>
                          <input type="hidden" name="movie_rating" class="rating-value" value="<?=$row['admin_rate']?>">
                        </div>
                    </div>
                  </div>
                  <br/>
                   
                  <div class="form-group">
                    <div class="col-md-7 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
</script>