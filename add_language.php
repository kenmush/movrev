<?php include("includes/header.php");

  require("includes/function.php");
  require("language/language.php");

  require_once("thumbnail_images.class.php");

  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM tbl_language WHERE id='$id'";
    $res=mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']) and isset($_GET['add']))
  {
  
    $name=addslashes(trim($_POST['language_name']));
    $color=addslashes(trim($_POST['bg_color']));
    $on_home=addslashes(trim($_POST['home_status']));
    $data = array(
          'language_name'  =>  $name,
          'language_background'  =>  $color,
          'is_on_home' => $on_home
    );  

    $qry = Insert('tbl_language',$data);  
    $_SESSION['msg']="10";
    header( "Location:manage_language.php");
    exit; 

  }
  if(isset($_POST['submit']) and isset($_POST['id']))
  {

    $name=addslashes(trim($_POST['language_name']));
    $color=addslashes(trim($_POST['bg_color']));
    $on_home=addslashes(trim($_POST['home_status']));
    $data = array(
          'language_name'  =>  $name,
          'language_background'  =>  $color,
          'is_on_home' => $on_home
    );  

    $update=Update('tbl_language', $data, "WHERE id = '".$_POST['id']."'");
 
    
    $_SESSION['msg']="11"; 
    header( "Location:add_language.php?id=".$_POST['id']);
    exit;
 
  }


?>
  <style type="text/css">
    /* The switch - the box around the slider */
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #e91e63;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #e91e63;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>

<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title"><?php if(isset($_GET['id'])){?>Edit<?php }else{?>Add<?php }?> Language</div>
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
            <form action="" name="addeditlanguage" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <input  type="hidden" name="id" value="<?php echo $_GET['id'];?>" />

              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Language Title :-
                    
                    </label>
                    <div class="col-md-6">
                      <input type="text" name="language_name" placeholder="Enter language title" id="language_name" value="<?php if(isset($_GET['id'])){echo $row['language_name'];}?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Background-Color :-</label>
                    <div class="col-md-6">
                      <input value="<?php if(isset($_GET['id'])){echo $row['language_background'];}else{ echo 'e91e63';}?>" name="bg_color" class="form-control jscolor {width:243, height:150, position:'right',
                      borderColor:'#000', insetColor:'#FFF', backgroundColor:'#ddd'}">
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Show on Home Screen :-
                    
                    </label>
                    <div class="col-md-6">
                      <!-- Material switch -->
                      <label class="switch">
                        <input type="checkbox" name="home_status"<?php if(isset($_GET['id']) && $row['is_on_home']=='on'){ echo 'checked=""' ;}?>  >
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <br>
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

<script type="text/javascript" src="assets/js/jscolor.js"></script>