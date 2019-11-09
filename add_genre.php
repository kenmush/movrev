<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");

	 
	
	if(isset($_POST['submit']) and isset($_GET['add']))
	{
	
	   $file_name= str_replace(" ","-",$_FILES['genre_image']['name']);

	   $genre_image=rand(0,99999)."_".$file_name;
		 	 
       //Main Image
	   $tpath1='images/'.$genre_image; 			 
       $pic1=compress_image($_FILES["genre_image"]["tmp_name"], $tpath1, 80);
	 
	   //Thumb Image 
	   $thumbpath='images/thumbs/'.$genre_image;		
       $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'250','150');   
 
          
       $data = array( 
			    'genre_name'  =>  $_POST['genre_name'],
			    'genre_image'  =>  $genre_image
			    );		

 		$qry = Insert('tbl_genres',$data);	

 	      
		$_SESSION['msg']="10";
 
		header( "Location:manage_genres.php");
		exit;	

		 
		
	}
	
	if(isset($_GET['g_id']))
	{
			 
			$qry="SELECT * FROM tbl_genres where gid='".$_GET['g_id']."'";
			$result=mysqli_query($mysqli,$qry);
			$row=mysqli_fetch_assoc($result);

	}
	if(isset($_POST['submit']) and isset($_POST['g_id']))
	{
		 
		 if($_FILES['genre_image']['name']!="")
		 {		


				$img_res=mysqli_query($mysqli,'SELECT * FROM tbl_genres WHERE gid='.$_GET['g_id'].'');
			    $img_res_row=mysqli_fetch_assoc($img_res);
			

			    if($img_res_row['genre_image']!="")
		        {
					unlink('images/thumbs/'.$img_res_row['genre_image']);
					unlink('images/'.$img_res_row['genre_image']);
			     }

 				   $file_name= str_replace(" ","-",$_FILES['genre_image']['name']);

	               $genre_image=rand(0,99999)."_".$file_name;
		 	 
			       //Main Image
				   $tpath1='images/'.$genre_image; 			 
			       $pic1=compress_image($_FILES["genre_image"]["tmp_name"], $tpath1, 80);
				 
					//Thumb Image 
				   $thumbpath='images/thumbs/'.$genre_image;		
			       $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'250','150');

                    $data = array(
					    'genre_name'  =>  $_POST['genre_name'],
					    'genre_image'  =>  $genre_image
						);

					$genre_edit=Update('tbl_genres', $data, "WHERE gid = '".$_POST['g_id']."'");

		 }
		 else
		 {

					 $data = array(
			          'genre_name'  =>  $_POST['genre_name']
						);	
 
			         $genre_edit=Update('tbl_genres', $data, "WHERE gid = '".$_POST['g_id']."'");

		 }

		     
		 
		$_SESSION['msg']="11"; 
		header( "Location:add_genre.php?g_id=".$_POST['g_id']);
		exit;
 
	}


?>
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title"><?php if(isset($_GET['cat_id'])){?>Edit<?php }else{?>Add<?php }?> Genre</div>
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
            <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
            	<input  type="hidden" name="g_id" value="<?php echo $_GET['g_id'];?>" />

              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Genre Name :-</label>
                    <div class="col-md-7">
                      <input type="text" name="genre_name" placeholder="Enter genre name" id="genre_name" value="<?php if(isset($_GET['g_id'])){echo $row['genre_name'];}?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Image :-
                    	<p class="control-label-help" id="square_lable_info">(Recommended resolution: 250x150,350x210)</p>
                    </label>
                    <div class="col-md-7">
                      <div class="fileupload_block">
                        <input type="file" name="genre_image" value="fileupload" id="fileupload">
                             
                        <div class="fileupload_img">
                          <img type="image" src="assets/images/add-image.png" alt="language image" />
                        </div>
                        	 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp; </label>
                    <div class="col-md-7">
                      	<?php if(isset($_GET['g_id']) and $row['genre_image']!="") {?>
                            <div class="block_wallpaper"><img src="images/<?php echo $row['genre_image'];?>" alt="Genre image"/></div>
                        <?php } ?>
                    </div>
                  </div><br>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
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
