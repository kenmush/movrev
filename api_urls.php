
<?php include("includes/header.php");

   if( isset($_SERVER['HTTPS'] ) ) {  

    $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/api.php';
  }
  else
  {
    $file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/api.php';
  }
?>
<div class="row">
  <div class="col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-header">
          Example API URLS
        </div>
            <div class="card-body no-padding">
        
           <pre>
            <code class="html">
              <br><b>API URL</b>&nbsp; <?php echo $file_path;?>    

              <br><b>Home</b> (Method: get_home)
              <br><b>Latest Review</b>(Method: get_latest) (Parameter: page)
              <br><b>Language List</b>(Method: get_language)
              <br><b>Genres List</b>(Method: get_genres)
              <br><b>Review list by Language ID</b>(Method: get_review_by_lang) (Parameter:language_id, page)
              <br><b>Review list by Genres ID</b>(Method: get_review_by_genres) (Parameter:genre_id, page)
              <br><b>Single Review</b>(Method: get_single_review) (Parameter:review_id)
              <br><b>Search Review</b>(Method: search_review) (Parameter:search_text, page)
              <br><b>Comment list by Review ID </b>(Method: get_commnet) (Parameter:review_id)
              <br><b>Add Comment</b>(Method: add_comment) (Parameter:user_id, movie_id, comment_text)
              <br><b>Rating</b>(Method: rating)(Parameter:post_id, rate, user_id)
              <br><b>My Rating</b>(Method: my_rating)(Parameter:post_id, user_id)
              <br><b>User Login</b> (Method: user_login)(Parameter:email,password)
              <br><b>User Register</b> (Method: user_register)(Parameter:name,email,password,phone)
              <br><b>User Profile</b>(Method: user_profile) (Parameter: user_id)
              <br><b>Edit Profile</b>(Method: edit_profile) (Parameter: user_id, name, email, password, phone, photo)
              <br><b>Forgot Password</b> (Method: forgot_pass)(Parameter:email)
              <br><b>App Details</b>(Method: get_app_details)
            </code> 
         </pre>
      
          </div>
        </div>
    </div>
  </div>
<br/>
<div class="clearfix"></div>
        
<?php include("includes/footer.php");?>       
<!-- <div class="row">
      <div class="col-sm-12 col-xs-12">
     	 	<div class="card">
		        <div class="card-header">
		          Example API urls
		        </div>
            <br><br><b>User Profile</b><br><?php echo $file_path."user_profile_api.php?id=2"?><br><br><b>User Profile Update</b><br><?php echo $file_path."user_profile_update_api.php?user_id=2&name=john&email=john@gmail.com&password=123456&phone=1234567891"?><br><br><b>Forgot Password</b><br><?php echo $file_path."user_forgot_pass_api.php?email=john@gmail.com"?><br><br><b>App Details</b><br><?php echo $file_path."api.php"?></code></pre>
       		
       				</div>
          	</div>
        </div>
</div>
    <br/>
    <div class="clearfix"></div> -->
        