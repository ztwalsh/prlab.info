<?php
  require('lib/config.php');

  if (isset($_GET['merchant_group_id'])) {
    $merchant_group_id = $_GET['merchant_group_id'];
  } else {
    $merchant_group_id = NULL;
  }

  $query = 'SELECT * FROM images WHERE merchant_group_id = '.$merchant_group_id.'';
  $remove = ' AND merchant_user_email NOT IN ("ztwalsh@gmail.com","zach.walsh@powerreviews.com","sara.rossio@powerreviews.com","rachel.bentley@powerreviews.com")';
  $cap = ' AND (caption is null or caption = "")';
  $images = $mysqli->query($query.$remove);
  $captions = $mysqli->query($query.$remove.$cap);

  $image_count = mysqli_num_rows($images);
  $caption_count = mysqli_num_rows($captions);
  $caption_percentage = $caption_count/$image_count;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Review Collection</title>
		<?php require('lib/include.head.php'); ?>
	</head>

	<body>
    <!-- <section>
      <form action="results.php" method="post">
        <p>
          <input type="text" name="merchant_group_id" value="" />
          <input type="submit" name="submit" value="Get Images" />
        </p>
        <p><?php echo $query.$remove.$cap; ?></p>
      </form>
    </section> -->
    <section>
  		<?php
        echo '<p>Images: '.$image_count.'</p>';
        echo '<p>Captions: '.$caption_count.' ('.$caption_percentage.'%)</p>';
        while($image = $images->fetch_assoc()) {
          echo '<p>';
            echo '<img src="'.$image['file_name'].'" width="400" height="auto" /><br />';
            echo 'Caption: '.$image['caption'].'<br />';
          echo '</p>';
        }
      ?>
    </section>
	</body>
</html>
