<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

 
	$cat_qry="SELECT * FROM tbl_language ORDER BY language_name";
	$cat_result=mysqli_query($mysqli,$cat_qry);

  $genre_qry="SELECT * FROM tbl_genres ORDER BY genre_name";
  $genre_result=mysqli_query($mysqli,$genre_qry); 
	
	if(isset($_POST['submit']))
	{
        $file_name= str_replace(" ","-",$_FILES['movie_poster']['name']);

        $movie_poster=rand(0,99999)."_".$file_name;
 
        //Main Image
        $tpath1='images/'.$movie_poster;        
        $pic1=compress_image($_FILES["movie_poster"]["tmp_name"], $tpath1, 80);
   
        //Thumb Image 
        $thumbpath='images/thumbs/'.$movie_poster;   
        $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'270','390');   

        $file_name= str_replace(" ","-",$_FILES['movie_cover']['name']);

        $movie_cover=rand(0,99999)."_".$file_name;
 
        //Main Image
        $tpath1='images/'.$movie_cover;        
        $pic1=compress_image($_FILES["movie_cover"]["tmp_name"], $tpath1, 80);
   
        //Thumb Image 
        $thumbpath='images/thumbs/'.$movie_cover;   
        $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'600','350');   

        $video_url=$_POST['video_url'];

        $youtube_video_url = addslashes($_POST['video_url']);
        parse_str( parse_url( $youtube_video_url, PHP_URL_QUERY ), $array_of_vars );
        $video_id=  $array_of_vars['v'];

     
          $data = array( 
  			    'language_id'  =>  $_POST['language_id'],
            'genre_id'  =>  $_POST['genre_id'],    			     
  			    'movie_title'  =>  addslashes(trim($_POST['movie_title'])),
            'movie_casts'  =>  trim($_POST['movie_casts']),                   
            'movie_cover'  =>  $movie_cover,
            'movie_poster'  =>  $movie_poster,
            'movie_desc'  =>  trim($_POST['movie_desc']),
            'movie_date'  =>  date('Y-m-d',strtotime($_POST['movie_date'])),
            'video_url'  =>  $video_url,
            'video_id'  =>  $video_id
  			    );		

  		 		$qry = Insert('tbl_reviews',$data);	

          $last_id=mysqli_insert_id($mysqli);

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
                        'parent_id'=>$last_id,
                        'image_name'  => $gallery_image                         
                        );      

                    $qry1 = Insert('tbl_photo_gallery',$data1); 
              }
            }

     	    
    		$_SESSION['msg']="10";
    		header( "Location:add_review.php");
    		exit;	

		 
	}
	
	  
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>

<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Add Movie</div>
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
            <form action="" name="add_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
 
              <div class="section">
                <div class="section-body">
                   
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Language :-</label>
                    <div class="col-md-7">
                      <select name="language_id" id="language_id" class="select2" required>
                        <option value="">--Select Language--</option>
          							<?php
          									while($data=mysqli_fetch_array($cat_result))
          									{
          							?>          						 
          							<option value="<?php echo $data['id'];?>"><?php echo $data['language_name'];?></option>	          							 
          							<?php
          								}
          							?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Genre :-</label>
                    <div class="col-md-7">
                      <select name="genre_id" id="genre_id" class="select2" required>
                        <option value="">--Select Genre--</option>
                        <?php
                            while($genre_row=mysqli_fetch_array($genre_result))
                            {
                        ?>                       
                        <option value="<?php echo $genre_row['gid'];?>"><?php echo $genre_row['genre_name'];?></option>                           
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Movie Title :-</label>
                    <div class="col-md-7">
                      <input type="text" name="movie_title" id="movie_title" value="" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Movie Trailer Url:-</label>
                    <div class="col-md-7">
                      <input type="url" name="movie_trailer" id="movie_trailer" value="" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Movie Cast :-<p class="control-label-help">(Cast name using comma separated)</p></label>

                    <div class="col-md-7">
                      <input type="text" value="" data-role="tagsinput" name="movie_casts" id="movie_casts" class="form-control" required="" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Description :-</label>
                    <div class="col-md-7">                    
                      <textarea name="movie_desc" id="movie_desc" class="form-control"></textarea>

                      <script>CKEDITOR.replace( 'movie_desc' );</script>
                    </div>
                  </div><br> 
                  
                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Cover Image:-
                      <p class="control-label-help" id="square_lable_info">(Recommended resolution: 600x350,800x466)</p>
                    </label>
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
                    <label class="col-md-3 col-md-offset-1 control-label">Poster Image:-
                      <p class="control-label-help" id="square_lable_info">(Recommended resolution: 270x390,320x462)</p>
                    </label>
                    <div class="col-md-7">
                      <div class="fileupload_block">
                        <input type="file" name="movie_poster" value="" id="fileupload">
                        <div class="fileupload_img">
                          <img type="image" src="assets/images/add-image.png" alt="language image" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="image_news">
                    <label class="col-md-3 col-md-offset-1 control-label">Gallery Image :-
                      <p class="control-label-help" id="square_lable_info">(Recommended resolution: 200x200,400x400 OR width and height equal)</p>
                    </label>
                    <div class="col-md-7">
                      <div class="fileupload_block">
                        <input type="file" name="gallery_image[]" value="" id="fileupload" multiple required>
                        <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="Featured image" /></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 col-md-offset-1 control-label">Release Date :-</label>
                    <div class="col-md-7">
                      <input type="text" name="movie_date" id="datepicker" value="" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-4">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                      <button type="reset" class="btn btn-danger">Clear</button>
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
  // $('#movie_casts').tagsinput({
  //   tagClass: 'form-control'
  // });
</script>