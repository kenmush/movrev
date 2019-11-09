<?php include("includes/header.php");

$sql="SELECT COUNT(*) as num FROM tbl_language";
$total_category= mysqli_fetch_array(mysqli_query($mysqli,$sql));
$total_category = $total_category['num'];

$sql="SELECT COUNT(*) as num FROM tbl_genres";
$total_genres = mysqli_fetch_array(mysqli_query($mysqli,$sql));
$total_genres = $total_genres['num'];

$sql="SELECT COUNT(*) as num FROM tbl_reviews";
$total_reviews = mysqli_fetch_array(mysqli_query($mysqli,$sql));
$total_reviews = $total_reviews['num']; 

$sql="SELECT COUNT(*) as num FROM tbl_users";
$total_users = mysqli_fetch_array(mysqli_query($mysqli,$sql));
$total_users = $total_users['num']; 

?>       


    <div class="btn-floating" id="help-actions">
      <div class="btn-bg"></div>
      <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions"> <i class="icon fa fa-plus"></i> <span class="help-text">Shortcut</span> </button>
      <div class="toggle-content">
        <ul class="actions">
          <li><a href="http://www.viaviweb.com" target="_blank">Website</a></li>
           <li><a href="https://codecanyon.net/user/viaviwebtech?ref=viaviwebtech" target="_blank">About</a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_language.php" class="card card-banner card-green-light">
        <div class="card-body"> <i class="icon fa fa-sitemap fa-4x"></i>
          <div class="content">
            <div class="title">Languages</div>
            <div class="value"><span class="sign"></span><?php echo $total_category;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_genres.php" class="card card-banner card-yellow-light">
        <div class="card-body"> <i class="icon fa fa-list fa-4x"></i>
          <div class="content">
            <div class="title">Genres</div>
            <div class="value"><span class="sign"></span><?php echo $total_genres;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
          <a href="manage_reviews.php" class="card card-banner card-orange-light">
            <div class="card-body"> <i class="icon fa fa-film fa-4x"></i>
              <div class="content">
                <div class="title">Movies</div>
                <div class="value"><span class="sign"></span><?php echo $total_reviews;?></div>
              </div>
            </div>
          </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
          <a href="manage_users.php" class="card card-banner card-blue-light">
            <div class="card-body"> <i class="icon fa fa-users fa-4x"></i>
              <div class="content">
                <div class="title">Users</div>
                <div class="value"><span class="sign"></span><?php echo $total_users;?></div>
              </div>
            </div>
          </a> 
        </div>
     
    </div>

        
<?php include("includes/footer.php");?>       
