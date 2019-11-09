<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	
	$qry="SELECT * FROM tbl_genres";
	$result=mysqli_query($mysqli,$qry);
	
  if(isset($_POST['data_search']))
   {

      $qry="SELECT * FROM tbl_genres                   
                  WHERE tbl_genres.genre_name like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_genres.genre_name";
 
      $result=mysqli_query($mysqli,$qry); 

   }
   else
   {
  
  //Get all Category 
   
      $tableName="tbl_genres";   
      $targetpage = "manage_genres.php"; 
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
      
     $qry="SELECT * FROM tbl_genres
                   ORDER BY tbl_genres.genre_name LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$qry); 
  
    } 


	if(isset($_GET['g_id']))
	{
 

		$cat_res=mysqli_query($mysqli,'SELECT * FROM tbl_genres WHERE gid=\''.$_GET['g_id'].'\'');
		$cat_res_row=mysqli_fetch_assoc($cat_res);


		if($cat_res_row['genre_image']!="")
	    {
	    	unlink('images/'.$cat_res_row['genre_image']);
			  unlink('images/thumbs/'.$cat_res_row['genre_image']);

		}
 
		Delete('tbl_genres','gid='.$_GET['g_id'].'');

      
		$_SESSION['msg']="12";
		header( "Location:manage_genres.php");
		exit;
		
	}	
	 
?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Genre</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                <div class="search_block">
                  <form  method="post" action="">
                  <input class="form-control input-sm" placeholder="Search genre..." aria-controls="DataTables_Table_0" type="search" name="search_value" value="<?php if(isset($_POST['search_value'])){ echo $_POST['search_value']; }?>" required>
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div>
                <div class="add_btn_primary"> <a href="add_genre.php?add=yes">Add Genre</a> </div>
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
                    <h2><a href="javascript:void(0)" style="text-shadow: 2px 2px 1px #000"><?php echo $row['genre_name'];?>  </a></h2>
                    <ul>                
                      <li><a href="add_genre.php?g_id=<?php echo $row['gid'];?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>               
                      <li><a href="?g_id=<?php echo $row['gid'];?>" data-toggle="tooltip" data-tooltip="Delete" onclick="return confirm('Are you sure you want to delete this genre?');"><i class="fa fa-trash"></i></a></li>
                    </ul>
                  </div>
                  <span><img src="images/<?php echo $row['genre_image'];?>" style="height: 150px !important;"/></span>
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
