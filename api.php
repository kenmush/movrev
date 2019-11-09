<?php 
	include("includes/connection.php");
 	include("includes/function.php"); 
	include("smtp_email.php");
	//error_reporting(E_ALL);
	
	if( isset($_SERVER['HTTPS'] ) ) 
	{  

	    $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/'; 	  
	}
	else
	{
	    $file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/'; 	  
	}

  	$get_method = checkSignSalt($_POST['data']);
	
	if($get_method['method_name']=="get_home")	
	{
		$jsonObj= array();	
 
		$query="SELECT reviews.*, language.`id` AS language_id, language.`language_name`, language.`language_background`  FROM tbl_reviews reviews
		LEFT JOIN tbl_language language ON reviews.`language_id`= language.`id` 
		WHERE reviews.`featured`='1' ORDER BY reviews.`id` DESC";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row0['id'] = $data['id'];
			$row0['genre_id'] = $data['genre_id'];
			$row0['movie_title'] = stripslashes($data['movie_title']);
			// $row0['movie_casts'] = $data['movie_casts'];
 		 	
		 	$row0['movie_cover_b'] = $file_path.'images/'.$data['movie_cover'];
		    $row0['movie_cover_s'] = $file_path.'images/thumbs/'.$data['movie_cover'];

		    $row0['movie_thumbnail_b'] = $file_path.'images/'.$data['movie_poster'];
		    $row0['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data['movie_poster'];
			  
			// $row0['movie_desc'] = stripslashes($data['movie_desc']);
			// $row0['movie_date'] = date('d-m-Y',strtotime($data['movie_date']));
			// $row0['total_views'] = $data['total_views'];
			$row0['total_rate'] = $data['total_rate'];
			$row0['rate_avg'] = $data['rate_avg'];

			$row0['language_id'] = $data['language_id'];
			$row0['language_name'] = $data['language_name'];
			$row0['language_bg'] = '#'.$data['language_background'];

			array_push($jsonObj,$row0);
		
		}

		$row['featured_reviews']=$jsonObj;

		$jsonObj_1= array();	
 
		$cat_order=API_CAT_ORDER_BY;
		
		$query="SELECT id,language_name,language_background FROM tbl_language ORDER BY ".$cat_order."";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

		while($data = mysqli_fetch_assoc($sql))
		{
			$row1['language_id'] = $data['id'];
			$row1['language_name'] = $data['language_name'];
			$row1['language_bg'] = '#'.$data['language_background'];

			array_push($jsonObj_1,$row1);
		
		}

		$row['language']=$jsonObj_1;


		$jsonObj_2= array();	

		$query_latest="SELECT review.*, language.`id` AS language_id, language.`language_name`, language.`language_background`  FROM tbl_reviews review
		LEFT JOIN tbl_language language ON review.`language_id`= language.`id` 
		WHERE review.`status`='1' ORDER BY review.`id` DESC LIMIT 4";

		$sql_all = mysqli_query($mysqli,$query_latest)or die(mysqli_error());

		while($data_all = mysqli_fetch_assoc($sql_all))
		{
			$row2['id'] = $data_all['id'];
			$row2['genre_id'] = $data_all['genre_id'];
			$row2['movie_title'] = stripslashes($data_all['movie_title']);
			// $row2['movie_casts'] = $data_all['movie_casts'];
 		 		
 		 	$row2['movie_cover_b'] = $file_path.'images/'.$data_all['movie_cover'];
		    $row2['movie_cover_s'] = $file_path.'images/thumbs/'.$data_all['movie_cover'];

		    $row2['movie_thumbnail_b'] = $file_path.'images/'.$data_all['movie_poster'];
		    $row2['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data_all['movie_poster'];

			$row2['total_rate'] = $data_all['total_rate'];
			$row2['rate_avg'] = $data_all['rate_avg'];

			$row2['language_id'] = $data_all['language_id'];
			$row2['language_name'] = $data_all['language_name'];
			$row2['language_bg'] = '#'.$data_all['language_background'];

			array_push($jsonObj_2,$row2);
		
		}

		$row['latest_reviews']=$jsonObj_2; 

		$jsonObj_3= array();	

		$query_views="SELECT tbl_reviews.*, tbl_language.`id` AS language_id, tbl_language.`language_name`, tbl_language.`language_background` FROM tbl_reviews
		LEFT JOIN tbl_language ON tbl_reviews.`language_id`= tbl_language.`id` 
		WHERE tbl_reviews.`status`='1' ORDER BY tbl_reviews.`total_views` DESC LIMIT 4";

		$sql_views = mysqli_query($mysqli,$query_views)or die(mysqli_error());

		while($data_views = mysqli_fetch_assoc($sql_views))
		{
			$row3['id'] = $data_views['id'];
			$row3['genre_id'] = $data_views['genre_id'];
			$row3['movie_title'] = stripslashes($data_views['movie_title']);
			// $row3['movie_casts'] = $data_views['movie_casts'];
 		 	
		 	$row3['movie_cover_b'] = $file_path.'images/'.$data_views['movie_cover'];
		    $row3['movie_cover_s'] = $file_path.'images/thumbs/'.$data_views['movie_cover'];

		    $row3['movie_thumbnail_b'] = $file_path.'images/'.$data_views['movie_poster'];
		    $row3['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data_views['movie_poster'];
			  
			// $row3['movie_desc'] = stripslashes($data_views['movie_desc']);
			// $row3['movie_date'] = date('m-d-Y',$data_views['movie_date']);
			$row3['total_views'] = $data_views['total_views'];
			$row3['total_rate'] = $data_views['total_rate'];
			$row3['rate_avg'] = $data_views['rate_avg'];

			$row3['language_id'] = $data_all['language_id'];
			$row3['language_name'] = $data_all['language_name'];
			$row3['language_bg'] = '#'.$data_all['language_background']; 

			array_push($jsonObj_3,$row3);
		
		}

		//$row['most_views']=$jsonObj_3;

		// Language Wise Reviews
		$jsonObj_4= array();
		$jsonObj_5= array();	

		$query_views="SELECT language.`id`, language.`language_name`, language.`language_background` FROM tbl_language language WHERE `status`='1' AND `is_on_home`='on'";

		$sql_views = mysqli_query($mysqli,$query_views)or die(mysqli_error());

		$post_order_by=API_CAT_POST_ORDER_BY;

		while($data2 = mysqli_fetch_assoc($sql_views))
		{
			$row4['language_id'] = $data2['id'];
			$row4['language_name'] = $data2['language_name'];

			$query="SELECT reviews.* FROM tbl_reviews reviews WHERE reviews.`language_id`='".$data2['id']."' AND reviews.`status`='1' ORDER BY reviews.`id` ".$post_order_by." LIMIT 4";

			$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

			while($data_review = mysqli_fetch_assoc($sql))
			{
				$row5['id'] = $data_review['id'];
				$row5['genre_id'] = $data_review['genre_id'];
				$row5['movie_title'] = stripslashes($data_review['movie_title']);
	 		 	
	 		 	$row5['movie_cover_b'] = $file_path.'images/'.$data_review['movie_cover'];
			    $row5['movie_cover_s'] = $file_path.'images/thumbs/'.$data_review['movie_cover'];

			    $row5['movie_thumbnail_b'] = $file_path.'images/'.$data_review['movie_poster'];
			    $row5['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data_review['movie_poster'];

				$row5['total_views'] = $data_review['total_views'];
				$row5['total_rate'] = $data_review['total_rate'];
				$row5['rate_avg'] = $data_review['rate_avg'];

				$row5['language_id'] = $data2['id'];
				$row5['language_name'] = $data2['language_name'];
				$row5['language_bg'] = '#'.$data2['language_background']; 
				
				$row4['language_movies'][]= $row5;
			
			}

			array_push($jsonObj_4,$row4);
			unset($row4['language_movies']);
		
		}

		$row['language_wise_movies']=$jsonObj_4;

		
		$set['MOVIE_REVIEWS_APP'] = $row;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	elseif ($get_method['method_name']=="get_latest") {

		$jsonObj= array();

		$page_limit=API_LATEST_LIMIT;

		$limit=($get_method['page']-1) * $page_limit;	

		$query_rec = "SELECT COUNT(*) as num FROM tbl_reviews
				LEFT JOIN tbl_language ON tbl_reviews.`language_id`= tbl_language.`id` 
				ORDER BY tbl_reviews.`id`";

		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));

		$query_latest="SELECT review.*, language.`id` AS language_id, language.`language_name`, language.`language_background`  FROM tbl_reviews review
		LEFT JOIN tbl_language language ON review.`language_id`= language.`id` 
		WHERE review.`status`='1' ORDER BY review.`id` DESC LIMIT $limit,$page_limit";

		$sql_all = mysqli_query($mysqli,$query_latest)or die(mysqli_error());


		while($data_all = mysqli_fetch_assoc($sql_all))
		{
			$row2['num'] = $total_pages['num'];
			$row2['id'] = $data_all['id'];
			$row2['genre_id'] = $data_all['genre_id'];
			$row2['movie_title'] = stripslashes($data_all['movie_title']);
			// $row2['movie_casts'] = $data_all['movie_casts'];
 		 		
 		 	$row2['movie_cover_b'] = $file_path.'images/'.$data_all['movie_cover'];
		    $row2['movie_cover_s'] = $file_path.'images/thumbs/'.$data_all['movie_cover'];

		    $row2['movie_thumbnail_b'] = $file_path.'images/'.$data_all['movie_poster'];
		    $row2['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data_all['movie_poster'];

			$row2['total_rate'] = $data_all['total_rate'];
			$row2['rate_avg'] = $data_all['rate_avg'];

			$row2['language_id'] = $data_all['language_id'];
			$row2['language_name'] = $data_all['language_name'];
			$row2['language_bg'] = '#'.$data_all['language_background'];

			array_push($jsonObj,$row2);
		
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
		
	}
	elseif ($get_method['method_name']=="get_language") {

		$jsonObj= array();	
 
		$cat_order=API_CAT_ORDER_BY;

		$query="SELECT id,language_name,language_background FROM tbl_language ORDER BY ".$cat_order."";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row1['language_id'] = $data['id'];
			$row1['language_name'] = $data['language_name'];
			$row1['language_bg'] = '#'.$data['language_background']; 

			array_push($jsonObj,$row1);
		
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
		
	}
	elseif ($get_method['method_name']=="get_genres") {
		
		$jsonObj= array();	
 
		$genre_order=API_GENRE_ORDER_BY;

		$query="SELECT gid,genre_name,genre_image FROM tbl_genres ORDER BY tbl_genres.".$genre_order."";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['gid'] = $data['gid'];
			$row['genre_name'] = $data['genre_name'];
			$row['genre_image'] = $file_path.'images/'.$data['genre_image'];
			$row['genre_image_thumb'] = $file_path.'images/thumbs/'.$data['genre_image'];

			array_push($jsonObj,$row);
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
		
	}
	elseif ($get_method['method_name']=="get_review_by_lang") {

		$post_order_by=API_CAT_POST_ORDER_BY;

		$language_id=$get_method['language_id'];	

		$page_limit=API_REVIEW_LIMIT;

		$limit=($get_method['page']-1) * $page_limit;

		$jsonObj= array();	
	
	    $query="SELECT reviews.*, language.`id` AS language_id, language.`language_name`, language.`language_background` FROM tbl_reviews reviews
		LEFT JOIN tbl_language language ON reviews.`language_id`= language.`id` 
		WHERE reviews.`language_id`='".$language_id."' AND reviews.`status`='1' ORDER BY reviews.`id` ".$post_order_by." LIMIT $limit,$page_limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = stripslashes($data['movie_title']);
			// $row['movie_casts'] = $data['movie_casts'];
 		 	
 		 	$row['movie_cover_b'] = $file_path.'images/'.$data['movie_cover'];
		    $row['movie_cover_s'] = $file_path.'images/thumbs/'.$data['movie_cover'];

		    $row['movie_thumbnail_b'] = $file_path.'images/'.$data['movie_poster'];
		    $row['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data['movie_poster'];
			  
			// $row['movie_desc'] = stripslashes($data['movie_desc']);
			// $row['movie_date'] = date('m-d-Y',$data['movie_date']);
			// $row['total_views'] = $data['total_views'];
			$row['total_rate'] = $data['total_rate'];
			$row['rate_avg'] = $data['rate_avg'];

			$row['language_id'] = $data['language_id'];
			$row['language_name'] = $data['language_name'];
			$row['language_bg'] = '#'.$data['language_background']; 
			 
			array_push($jsonObj,$row);
		
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	elseif ($get_method['method_name']=="get_review_by_genres") {

		$post_order_by=API_CAT_POST_ORDER_BY;

		$genre_id=$get_method['genre_id'];

		$page_limit=API_REVIEW_LIMIT;

		$limit=($get_method['page']-1) * $page_limit;	

		$jsonObj= array();	
	
	    $query="SELECT reviews.*,genre.*, language.`id` AS language_id, language.`language_name`, language.`language_background` FROM tbl_reviews reviews
		LEFT JOIN tbl_genres genre ON reviews.`genre_id`= genre.`gid` 
		LEFT JOIN tbl_language language ON reviews.`language_id`= language.`id` 
		WHERE reviews.genre_id='".$genre_id."' AND reviews.`status`='1' ORDER BY reviews.`id` ".$post_order_by." LIMIT $limit,$page_limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = stripslashes($data['movie_title']);
			// $row['movie_casts'] = $data['movie_casts'];
 		 	
 		 	$row['movie_cover_b'] = $file_path.'images/'.$data['movie_cover'];
		    $row['movie_cover_s'] = $file_path.'images/thumbs/'.$data['movie_cover'];

		    $row['movie_thumbnail_b'] = $file_path.'images/'.$data['movie_poster'];
		    $row['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data['movie_poster'];
			  
			// $row['movie_desc'] = stripslashes($data['movie_desc']);
			// $row['movie_date'] = date('m-d-Y',$data['movie_date']);
			// $row['total_views'] = $data['total_views'];
			$row['total_rate'] = $data['total_rate'];
			$row['rate_avg'] = $data['rate_avg'];

			$row['language_id'] = $data['language_id'];
			$row['language_name'] = $data['language_name'];
			$row['language_bg'] = '#'.$data['language_background']; 

			array_push($jsonObj,$row);
		
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	elseif ($get_method['method_name']=="get_single_review") {

		$jsonObj= array();	

		$review_id=$get_method['review_id'];	

		$query="SELECT reviews.*, language.`id` AS language_id, language.`language_name`, language.`language_background` FROM tbl_reviews reviews
		LEFT JOIN tbl_language language ON reviews.`language_id`= language.`id` 
		WHERE reviews.`id`='$review_id'";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			if($get_method['user_id']!=0){
				$res=mysqli_query($mysqli,"SELECT * FROM tbl_rating WHERE `user_id`='$get_method[user_id]' AND `post_id`='$review_id'");

				$usr_rate=mysqli_fetch_assoc($res);
				$row['user_rate']=$usr_rate['rate'];

			}else{
				$row['user_rate']=0;
			}
			$row['id'] = $data['id'];
			$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = stripslashes($data['movie_title']);
			$row['movie_casts'] = $data['movie_casts'];
			if($data['video_url']!=NULL OR !empty($data['video_url'])){
				$row['is_trailer'] = 'true';
				$row['video_url'] = $data['video_url'];
				$row['video_id'] = $data['video_id'];	
			}else{
				$row['is_trailer'] = 'false';
				$row['video_url'] = '';
				$row['video_id'] = '';	
			}
			

			$row['movie_cover_b'] = $file_path.'images/'.$data['movie_cover'];
		    $row['movie_cover_s'] = $file_path.'images/thumbs/'.$data['movie_cover'];

		    $row['movie_thumbnail_b'] = $file_path.'images/'.$data['movie_poster'];
		    $row['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data['movie_poster'];
 		 	
			$row['movie_desc'] = stripslashes($data['movie_desc']);
			$row['movie_date'] = date('d M Y',strtotime($data['movie_date']));
			$row['total_views'] = $data['total_views'];
			$row['admin_rating'] = $data['admin_rate'];
			$row['total_rate'] = $data['total_rate'];
			$row['rate_avg'] = $data['rate_avg'];

			$row['language_id'] = $data['language_id'];
			$row['language_name'] = $data['language_name'];
			$row['language_bg'] = '#'.$data['language_background']; 

			// photo gallery
			$wall_query="SELECT * FROM tbl_photo_gallery WHERE parent_id='$review_id'";

			$wall_sql = mysqli_query($mysqli,$wall_query);

			if($wall_sql->num_rows > 0)
			{	
				while($wall_data = mysqli_fetch_assoc($wall_sql))
				{
					$row1['image_name'] = $file_path.'images/gallery/'.$wall_data['image_name'];
					 
					$row['gallery'][]=$row1;
				}
			}
			else
			{
				$row['gallery']=array();
			}


			//Related Videos
			$query_2="SELECT tbl_reviews.*, tbl_language.`id` AS language_id, tbl_language.`language_name`, tbl_language.`language_background` FROM tbl_reviews
			LEFT JOIN tbl_language ON tbl_reviews.language_id= tbl_language.id
			WHERE tbl_reviews.language_id='".$data['language_id']."' AND tbl_reviews.status='1' AND tbl_reviews.id!='".$data['id']."'";

			$sql2 = mysqli_query($mysqli,$query_2)or die(mysqli_error());
 			
 			while($data_2 = mysqli_fetch_assoc($sql2))
			{
				$row2['id'] = $data_2['id'];
				$row2['genre_id'] = $data_2['genre_id'];
				$row2['movie_title'] = stripslashes($data_2['movie_title']);
				$row2['movie_casts'] = $data_2['movie_casts'];
	 				
	 			$row2['movie_cover_b'] = $file_path.'images/'.$data_2['movie_cover'];
			    $row2['movie_cover_s'] = $file_path.'images/thumbs/'.$data_2['movie_cover'];

			    $row2['movie_thumbnail_b'] = $file_path.'images/'.$data_2['movie_poster'];
			    $row2['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data_2['movie_poster'];
				  
				// $row2['movie_desc'] = stripslashes($data_2['movie_desc']);
				// $row2['movie_date'] = date('m-d-Y',$data_2['movie_date']);
				$row2['total_rate'] = $data_2['total_rate'];
				$row2['rate_avg'] = $data_2['rate_avg'];

			    $row2['language_id'] = $data_2['language_id'];
				$row2['language_name'] = $data_2['language_name'];
				$row2['language_bg'] = '#'.$data_2['language_background']; 

 
				$related_data[]=$row2;

			}
			
			if(isset($related_data)!='')
			{
				$row['related']=$related_data;
			}
			else
			{
				$row['related']=[];
			}

			//Related Videos
			$query_2="SELECT comment.*, user.`id` AS user_id, user.`name`, user.`photo` FROM tbl_comment comment, tbl_users user
			WHERE comment.`user_id`=user.`id` AND comment.`movie_id`='$review_id'";

			$sql2 = mysqli_query($mysqli,$query_2)or die(mysqli_error($mysqli));
 			
 			while($data_3 = mysqli_fetch_assoc($sql2))
			{
				$row3['id'] = $data_3['id'];
				$row3['movie_id'] = $data_3['movie_id'];
				$row3['user_id'] = $data_3['user_id'];
	 			$row3['user_name'] = $data_3['user_name'];	
	 			$row3['comment_text'] = stripslashes($data_3['comment']);

			    $row3['comment_date'] = date('d M, Y',strtotime($data_3['date']));

			    if($data_3['photo']!=NULL){
					$row3['user_image'] = $file_path.'uploads/'.$data_3['photo'];	
				}else{
					$row3['user_image'] = '';
				}


				$comment_data[]=$row3;

			}
			
			if(isset($comment_data)!='')
			{
				$row['comments']=$comment_data;
			}
			else
			{
				$row['comments']=[];
			}
			

			array_push($jsonObj,$row);
		
		}
 
		$view_qry=mysqli_query($mysqli,"UPDATE tbl_reviews SET total_views = total_views + 1 WHERE id = '".$get_method['review_id']."'");
		
		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	elseif ($get_method['method_name']=="search_review") {

		$jsonObj= array();	 

		$page_limit=API_SEARCH_LIMIT;

		$limit=($get_method['page']-1) * $page_limit;
		 
		$query="SELECT reviews.*, language.`id` AS language_id, language.`language_name`, language.`language_background`  FROM tbl_reviews reviews
		LEFT JOIN tbl_language language ON reviews.`language_id`= language.`id` 
		WHERE reviews.`movie_title` LIKE '%".$get_method['search_text']."%' AND reviews.`status`='1' ORDER BY reviews.`movie_title` LIMIT $limit,$page_limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = stripslashes($data['movie_title']);
			$row['movie_casts'] = $data['movie_casts'];
 		 	
		 	$row['movie_cover_b'] = $file_path.'images/'.$data['movie_cover'];
		    $row['movie_cover_s'] = $file_path.'images/thumbs/'.$data['movie_cover'];

		    $row['movie_thumbnail_b'] = $file_path.'images/'.$data['movie_poster'];
		    $row['movie_thumbnail_s'] = $file_path.'images/thumbs/'.$data['movie_poster'];
			  
			$row['movie_desc'] = stripslashes($data['movie_desc']);
			$row['movie_date'] = date('m-d-Y',$data['movie_date']);
			$row['total_views'] = $data['total_views'];
			$row['total_rate'] = $data['total_rate'];
			$row['rate_avg'] = $data['rate_avg'];

			$row['language_id'] = $data['language_id'];
			$row['language_name'] = $data['language_name'];
			$row['language_bg'] = '#'.$data['language_background'];

			array_push($jsonObj,$row);
		
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	elseif ($get_method['method_name']=="get_commnet") {

		$jsonObj= array();	

		$review_id=$get_method['review_id'];	

		$query="SELECT * FROM tbl_comment WHERE tbl_comment.movie_id='$review_id' ORDER BY tbl_comment.id DESC";

	    $sql = mysqli_query($mysqli,$query)or die(mysqli_error());

	    while($data = mysqli_fetch_assoc($sql))
	    { 
	        $row['id'] = $data['id'];
	        $row['movie_id'] = $data['movie_id'];
	        $row['user_id'] = $data['user_id'];
	        $row['user_name'] = $data['user_name'];
	        $row['comment'] = stripslashes($data['comment']);
	       
	      	array_push($jsonObj,$row);    
	    }
	 
	     
	    $set['MOVIE_REVIEWS_APP'] = $jsonObj;
	    
	    header( 'Content-Type: application/json; charset=utf-8' );
	      echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	    die();  
	}
	elseif ($get_method['method_name']=="add_comment") {

		$jsonObj= array();		

		$user_id = $get_method['user_id'];

		$user_qry="SELECT * FROM tbl_users where id='$user_id'";
		$user_result=mysqli_query($mysqli,$user_qry);
		$user_row=mysqli_fetch_assoc($user_result);

	  	$user_name = $user_row['name'];

		$movie_id = $get_method['movie_id'];
	  	$comment_text = $get_method['comment_text'];
	   
	  	$data = array(            
	           'user_id'  =>$user_id,
	           'user_name'  =>$user_name,
	           'movie_id'  =>  $movie_id,
	           'comment'  => $comment_text
	           );  

		$qry = Insert('tbl_comment',$data); 

		$info['success']='1';
		$info['msg']='Comment added successfully...';
		array_push($jsonObj,$info);

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
	    
	    header( 'Content-Type: application/json; charset=utf-8' );
	      echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	    die();  
	}
	elseif ($get_method['method_name']=="my_rating") {

		$jsonObj= array();		

		$post_id = $get_method['post_id'];
	  	$user_id = $get_method['user_id'];
	   	
	   	$res=mysqli_query($mysqli,"SELECT * FROM tbl_rating WHERE `user_id`='$get_method[user_id]' AND `post_id`='$post_id'");

	   	if(mysqli_num_rows($res) > 0){

	   		$usr_rate=mysqli_fetch_assoc($res);
			$jsonObj = array( 'user_rate' => $usr_rate['rate'],'success'=>"1");	
			
	   	}else{

			$jsonObj = array( 'user_rate' => "0",'success'=>"1");
	   	}

		

		$set['MOVIE_REVIEWS_APP'][] = $jsonObj;
	    
	    header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	    die();  
	}
	elseif ($get_method['method_name']=="rating") {

		$jsonObj= array();		

		// $user_id = $get_method['user_id'];
		$post_id = $get_method['post_id'];
	  	$rate = $get_method['rate'];
	  	$user_id = $get_method['user_id'];
	   	
	   	$sql="SELECT * FROM tbl_rating WHERE `post_id`='$post_id' AND user_id='$user_id'";
	   	$res=mysqli_query($mysqli,$sql);

	   	$data = array(            
	           'post_id' => $post_id,
	           'user_id' => $user_id,
	           'rate' => $rate
	           ); 

	   	if(mysqli_num_rows($res) > 0){

	   		$qry=Update('tbl_rating', $data, "WHERE post_id = '".$post_id."' AND user_id = '".$user_id."'");
	   		$query = mysqli_query($mysqli,"select * from tbl_rating where post_id  = '$post_id' ");
			               
			while($data = mysqli_fetch_assoc($query)){
		        $rate_db[] = $data;
		        $sum_rates[] = $data['rate'];
		    }

		    if(@count($rate_db)){
		        $rate_times = count($rate_db);
		        $sum_rates = array_sum($sum_rates);
		        $rate_value = $sum_rates/$rate_times;
		        $rate_bg = (($rate_value)/5)*100;
		    }else{
		        $rate_times = 0;
		        $rate_value = 0;
		        $rate_bg = 0;
		    }

			$rate_avg=round($rate_value); 

			$sql="update tbl_reviews set rate_avg='$rate_avg' where id='".$post_id."'";
			mysqli_query($mysqli,$sql);

	   	}else{
	   		 

			$qry = Insert('tbl_rating',$data);

			$query = mysqli_query($mysqli,"select * from tbl_rating where post_id  = '$post_id' ");
			               
			while($data = mysqli_fetch_assoc($query)){
		        $rate_db[] = $data;
		        $sum_rates[] = $data['rate'];
		    }

		    if(@count($rate_db)){
		        $rate_times = count($rate_db);
		        $sum_rates = array_sum($sum_rates);
		        $rate_value = $sum_rates/$rate_times;
		        $rate_bg = (($rate_value)/5)*100;
		    }else{
		        $rate_times = 0;
		        $rate_value = 0;
		        $rate_bg = 0;
		    }

			$rate_avg=round($rate_value); 

			$sql="update tbl_reviews set total_rate=total_rate + 1,rate_avg='$rate_avg' where id='".$post_id."'";
			mysqli_query($mysqli,$sql);

	   	}

	   	
	  	
		$total_rat_sql="SELECT * FROM tbl_reviews WHERE id='".$post_id."'";
		$total_rat_res=mysqli_query($mysqli,$total_rat_sql);
		$total_rat_row=mysqli_fetch_assoc($total_rat_res);

		$jsonObj = array( 'total_rate' => $total_rat_row['total_rate'],'rate_avg' =>$total_rat_row['rate_avg'],'success'=>"1",'msg'=>"You have successfully rated");

		$set['MOVIE_REVIEWS_APP'][] = $jsonObj;
	    
	    header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	    die();  
	}
	else if($get_method['method_name']=="get_app_details")
	{
		  
		$jsonObj= array();	

		$query="SELECT * FROM tbl_settings WHERE id='1'";
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 
			$row['app_name'] = $data['app_name'];
			$row['app_logo'] = $file_path.'images/'.$data['app_logo'];
			$row['package_name']=$data['package_name'];
			$row['app_version'] = $data['app_version'];
			$row['app_author'] = $data['app_author'];
			$row['app_contact'] = $data['app_contact'];
			$row['app_email'] = $data['app_email'];
			$row['app_website'] = $data['app_website'];
			$row['app_description'] = stripslashes($data['app_description']);
 			$row['app_developed_by'] = $data['app_developed_by'];
			$row['app_privacy_policy'] = stripslashes($data['app_privacy_policy']);
			
			$row['publisher_id'] = $data['publisher_id'];
			$row['interstital_ad'] = $data['interstital_ad'];
			$row['interstital_ad_id'] = $data['interstital_ad_id'];
			$row['interstital_ad_click'] = $data['interstital_ad_click'];
 			$row['banner_ad'] = $data['banner_ad'];
 			$row['banner_ad_id'] = $data['banner_ad_id'];
	

			array_push($jsonObj,$row);
		
		}

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
	
	}
	else if($get_method['method_name']=="user_login")
	{
		$jsonObj= array();	
		
		$email=$get_method['email'];
		$password=$get_method['password'];

		$qry = "SELECT * FROM tbl_users WHERE email = '$email'"; 

		$result = mysqli_query($mysqli,$qry);
		
		
		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);	

			if($row['status']==1){			
				if($row['password']==$password){
					$data['success']="1";
					$data['msg']="Login successfully.. !";
					$data['user_id'] = $row['id'];
		 			$data['name'] = $row['name'];

					array_push($jsonObj,$data);

					$set['MOVIE_REVIEWS_APP'] = $jsonObj;
				}else{
					$info['success']="0";	
					$info['msg']="Password is invalid !";
					array_push($jsonObj,$info);
					$set['MOVIE_REVIEWS_APP'] = $jsonObj;
				}
			}else{
				$info['success']="0";	
				$info['msg']="Sorry ! Your account is deacticated";
				array_push($jsonObj,$info);
				$set['MOVIE_REVIEWS_APP'] = $jsonObj;
			}

		}
		else
		{ 
 			$info['success']="0";	
			$info['msg']="Email not found !";
			array_push($jsonObj,$info);
			$set['MOVIE_REVIEWS_APP'] = $jsonObj;
					
		}
				 
		header( 'Content-Type: application/json; charset=utf-8' );
		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
		die();
	}
	else if($get_method['method_name']=="user_register")
	{
		$jsonObj= array();	
	
		$qry = "SELECT * FROM tbl_users WHERE email = '".$get_method['email']."'"; 

		$result = mysqli_query($mysqli,$qry);
		
		if(mysqli_num_rows($result) > 0)
		{	
			$data['msg']="Email is already registered !";
			$data['success']="0";

			array_push($jsonObj,$data);

			$set['MOVIE_REVIEWS_APP'] = $jsonObj;
		}
		else
		{ 
 				$data = array(
 					'user_type'  => 'Normal',				    
				    'name'  => $get_method['name'],				    
					'email'  =>  $get_method['email'],
					'password'  =>  $get_method['password'],
					'phone'  =>  $get_method['phone']
					);		
 			 

			$qry = Insert('tbl_users',$data);									 
				
			$last_id=LastID('tbl_users');	 
				
			$info['msg']="Register successflly...!";
			$info['success'] = '1';

			array_push($jsonObj,$info);

			$set['MOVIE_REVIEWS_APP'] = $jsonObj;
					
		}
				 
		header( 'Content-Type: application/json; charset=utf-8' );
		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
		die();
	}
	else if($get_method['method_name']=="user_profile")
	{
		$jsonObj= array();	
		
		$user_id=$get_method['user_id'];

		$qry = "SELECT * FROM tbl_users WHERE id = '$user_id'"; 

		$result = mysqli_query($mysqli,$qry);
		
		$row = mysqli_fetch_assoc($result);	

		$data['success']="1";
		$data['user_id'] = $row['id'];
		$data['name'] = $row['name'];
		$data['email'] = $row['email'];
		$data['phone'] = $row['phone'];

		if($row['photo']!=NULL){
			$data['photo_b'] = $file_path.'uploads/'.$row['photo'];
			$data['photo_s'] = $file_path.'uploads/thumbs'.$row['photo'];	
		}else{
			$data['photo_b'] = '';
			$data['photo_s'] = '';
		}

		

		array_push($jsonObj,$data);

		$set['MOVIE_REVIEWS_APP'] = $jsonObj;
				 
		header( 'Content-Type: application/json; charset=utf-8' );
		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
		die();
	}
	else if($get_method['method_name']=="edit_profile")
	{
		$jsonObj= array();	
		
		$qry = "SELECT * FROM tbl_users WHERE email = '".$get_method['email']."'"; 
		$result = mysqli_query($mysqli,$qry);
		$row = mysqli_fetch_assoc($result);
 	 
 	 	if (!filter_var($get_method['email'], FILTER_VALIDATE_EMAIL)) 
		{
			$set['MOVIE_REVIEWS_APP'][]=array('msg' => "Invalid email format!",'success'=>'0');

			header( 'Content-Type: application/json; charset=utf-8' );
			$json = json_encode($set);
			echo $json;
			 exit;
		}
		else if($row['email']==$get_method['email'] AND $row['id']!=$get_method['user_id'])
		{
			$set['MOVIE_REVIEWS_APP'][]=array('msg' => "Email address already used!",'success'=>'0');

			header( 'Content-Type: application/json; charset=utf-8' );
			$json = json_encode($set);
			echo $json;
			 exit;
		}
 	 	else if($get_method['password']!="")
		{
			$data = array(
			'name'  =>  $get_method['name'],
			'email'  =>  $get_method['email'],
			'password'  =>  $get_method['password'],
			'phone'  =>  $get_method['phone'] 
			);
		}
		else
		{
			$data = array(
			'name'  =>  $get_method['name'],
			'email'  =>  $get_method['email'],			 
			'phone'  =>  $get_method['phone'] 
			);
		}

		if($_FILES['photo']['name']!="")
		{
			$path = "uploads/"; //set your folder path
			$photo=rand(0,99999)."_".$_FILES['photo']['name'];
	        //Main Image
	        $tpath1=$path.$photo;        
	        $pic1=compress_image($_FILES["photo"]["tmp_name"], $tpath1, 80);

	        //Thumb Image 
	        $thumbpath='uploads/thumbs/'.$photo;   
	        $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'200','200');

			$data = array(
				'photo'  =>  $photo 
			);
		}

 
		$user_edit=Update('tbl_users', $data, "WHERE id = '".$get_method['user_id']."'");
	 		 
		$set['MOVIE_REVIEWS_APP'][]=array('msg'=>'Updated successfully... !','success'=>'1');

		header( 'Content-Type: application/json; charset=utf-8' );
		$json = json_encode($set);
		echo $json;
		exit;
	}
	else if($get_method['method_name']=="forgot_pass")
  	{
  		$host = $_SERVER['HTTP_HOST'];
		preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
        $domain_name=$matches[0];
         
	 	 
		$qry = "SELECT * FROM tbl_users WHERE email = '".$get_method['email']."'"; 
		$result = mysqli_query($mysqli,$qry);
		$row = mysqli_fetch_assoc($result);
		
		if($row['email']!="")
		{
 
			$to = $row['email'];
			$recipient_name=$row['name'];
			// subject
			$subject = '[IMPORTANT] '.APP_NAME.' Forgot Password Information';
 			
			$message='<div style="background-color: #f9f9f9;" align="center"><br />
					  <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
					    <tbody>
					      <tr>
					        <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.APP_LOGO.'" alt="header" /></td>
					      </tr>
					      <tr>
					        <td width="600" valign="top" bgcolor="#FFFFFF"><br>
					          <table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
					            <tbody>
					              <tr>
					                <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
					                    <tbody>
					                      <tr>
					                        <td><p style="color: #262626; font-size: 28px; margin-top:0px;"><strong>Dear '.$row['name'].'</strong></p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;">Thank you for using '.APP_NAME.',<br>
					                            Your password is: '.$row['password'].'</p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;margin-bottom:30px;">Thanks you,<br />
					                            '.APP_NAME.'.</p></td>
					                      </tr>
					                    </tbody>
					                  </table></td>
					              </tr>
					               
					            </tbody>
					          </table></td>
					      </tr>
					      <tr>
					        <td style="color: #262626; padding: 20px 0; font-size: 20px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">Copyright © '.APP_NAME.'.</td>
					      </tr>
					    </tbody>
					  </table>
					</div>';

			send_email($to,$recipient_name,$subject,$message);

			 	  
			$set['MOVIE_REVIEWS_APP'][]=array('msg' => "Password has been sent on your mail!",'success'=>'1');
		}
		else
		{  	 
				
			$set['MOVIE_REVIEWS_APP'][]=array('msg' => "Email not found in our database!",'success'=>'0');
					
		}

		header( 'Content-Type: application/json; charset=utf-8' );
		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
		die();

	}
	else
	{
		$get_method = checkSignSalt($_POST['data']);
	}
		 
?>