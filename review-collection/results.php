<?php
  require('lib/config.php');

  if (isset($_GET['merchant_group_id'])) {
    $merchant_group_id = $_GET['merchant_group_id'];
  } else {
    $merchant_group_id = NULL;
  }

  $image_query = 'SELECT * FROM images WHERE merchant_group_id = '.$merchant_group_id.'';
  $caption_query = ' AND (caption is null or caption = "")';
  $review_query = 'SELECT * FROM reviews WHERE merchant_group_id = '.$merchant_group_id.'';
  $remove = ' AND merchant_user_email NOT IN ("ztwalsh@gmail.com","zach.walsh@powerreviews.com","sara.rossio@powerreviews.com","rachel.bentley@powerreviews.com")';
  $images = $mysqli->query($image_query.$remove);
  $reviews = $mysqli->query($review_query.$remove);
  $captions = $mysqli->query($image_query.$remove.$caption_query);

  $image_count = mysqli_num_rows($images);
  $caption_count = mysqli_num_rows($images) - mysqli_num_rows($captions);
  $review_count = mysqli_num_rows($reviews);
  $caption_percentage = number_format(($caption_count/$image_count*100),2);
  $review_percentage = number_format(($review_count/$image_count*100),2);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Review Collection</title>
		<?php require('lib/include.head.php'); ?>
	</head>

	<body>
    <section>
  		<?php
        echo '<h2 class="heading-2">Summary</h2>';
        echo '<p>Images: '.$image_count.'<br />';
        echo 'Captions: '.$caption_count.' ('.$caption_percentage.'%)<br />';
        echo 'Reviews: '.$review_count.' ('.$review_percentage.'%)</p>';
        echo '<p>&nbsp;</p>';
        echo '<h2 class="heading-2">Images</h2>';
        while($image = $images->fetch_assoc()) {
          echo '<p>';
            echo '<img src="'.$image['file_name'].'" width="400" height="auto" /><br />';
            echo 'Caption: '.$image['caption'].'<br />';
            echo 'Test Group: '.$image['test_group'].'<br />';
          echo '</p>';
        }
      ?>
    </section>
	</body>
</html>
