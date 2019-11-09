<?php 
  header('Content-type text/html; charset=UTF-8');
  include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	
	//Get all Comments 
	 
  $tableName="tbl_comment";    
  $targetpage = "manage_comments.php";  
  $limit = 5; 

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


  $qry="SELECT * FROM tbl_comment
  ORDER BY tbl_comment.`id` DESC LIMIT $start, $limit";  
   
  $result=mysqli_query($mysqli,$qry);
	
	if(isset($_GET['comment_id']))
	{
  
		Delete('tbl_comment','id='.$_GET['comment_id'].'');
      
		$_SESSION['msg']="12";
		header( "Location:manage_comments.php");
		exit;		
	}	


  function get_movie_info($movie_id)
  {
    global $mysqli;

    $movie_qry="SELECT * FROM tbl_reviews WHERE id='".$movie_id."'";  
               
    $movie_result=mysqli_query($mysqli,$movie_qry);
    $movie_row=mysqli_fetch_assoc($movie_result);

    return $movie_row['movie_title'];
  }
	 
?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Comments</div>
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
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>                  
                  <th class="text-center" nowrap="">Sr No.</th>
                  <th class="text-center">Comment</th>
                  <th class="text-center">Movie</th>
                  <th class="text-center">User</th>
                  <th class="text-center" nowrap="">Comment At</th>
                  <th class="cat_action_list text-center">Action</th>
                </tr>
              </thead>
              <tbody>
            	<?php	
      						$i=1;
      						while($row=mysqli_fetch_array($result))
      						{					
      				?>
                <tr>                 
                  <td class="text-center"><?php echo $i++;?></td>
                  <td class="text-center"><?php echo $row['comment'];?></td>
                  <td class="text-center"><?php echo get_movie_info($row['movie_id']);?></td>
                  <td class="text-center"><?php echo $row['user_name'];?></td>
                  <td class="text-center">
                    <p style="margin-bottom: 0px"> <?php echo date('d-m-Y',strtotime($row['date']));?></p>
                    <p style="margin-bottom: 0px"><?php echo date('h:i A',strtotime($row['date']));?></p>
                  </td>
                  <td class="text-center">
                    <a href="?comment_id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this comment?');" class="btn btn-danger btn_delete" data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a> 
                  </td>
                </tr>
                <?php
				     	  }
				      ?> 
              </tbody>
            </table>
          </div>
          <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php if(!isset($_POST["search"])){ include("pagination.php");}?>
              </nav>
            </div>
          </div> 
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
