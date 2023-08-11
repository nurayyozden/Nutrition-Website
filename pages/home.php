<?php

// tags by ids in the types table
$tag_ids = exec_sql_query(
  $db,
  "SELECT types.id AS 'types.id' FROM types;")->fetchAll();


$filter_param = $_GET['filter'] ?? NULL; // untrusted

// original SQL query with no filters
$sql_select_clause = "SELECT posts.id AS 'posts.id', posts.name AS 'posts.name', posts.file_ext as 'posts.file_ext'
FROM posts";
$sql_where_clause = ''; // No order by default


// sort if query string param is new, old, high, or low
if (!is_null($filter_param)) {
  $sql_where_clause = ' INNER JOIN post_tags ON posts.id = post_tags.post_id WHERE post_tags.type_id = ' . $filter_param . ';';
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="public/styles/site.css" />
  <title>Meal Questionnaire</title>
</head>

<body>

<header>
    <h1>Meal Questionnaire</h1>
</header>

<div class='top'>
  <!-- <div class="intro">
  <h2>Welcome!</h2>

    <p>Are you someone looking for inspiration for dinnertime meals? Finding yourself overwhelmed and wanting to make a lifestyle change? Look no further! Dinner for All is a social-media-esque site where knowledgeable people share the dinner they cook themselves to inspire people like you! Color coded by the dietary type, you can easily find a meal you can make yourself to get you one step closer to a healthier, happier version of yourself! </p>

    <p> If you are interested in becoming a Meal Sharer, where you post the meals you eat for others to see, sign up here!</p>
  </div> -->



  <div class="login">
  <?php if (!is_user_logged_in()) { ?>
    <h3> Login </h3>
    <?php echo login_form('/', $session_messages); ?>
    <?php } ?>
    <?php if (is_user_logged_in()) { ?>
        <p><a class="button" href="<?php echo logout_url(); ?>">Sign Out</a></p>
        <p><a class="button" href="/dinner-form">Post Dinner</a></p>
      <?php } ?>



  </div>

</div>


<!-- <div class="content">


  <div class="posts">
    <?php
    // final query with filters
    $sql_select_query = $sql_select_clause . $sql_where_clause;

    // where SQL query was
    $result = exec_sql_query(
      $db,
      $sql_select_query);


    $records = $result->fetchAll();

    foreach ($records as $record) { ?>
            <div class="box">
                <h4 class="title"><?php echo htmlspecialchars($record["posts.name"]); ?></h4>
                <a href="/meal?<?php echo http_build_query(array(
                    'id' => $record['posts.id'])); ?>">
                <?php $file_location = '/public/uploads/meal-images/' . $record['posts.id'] . '.' . $record['posts.file_ext'];?>
                <img class="meal-image" src="<?php echo htmlspecialchars($file_location); ?>"
                alt=<?php echo htmlspecialchars($record["posts.name"]); ?>>

                </a>
            </div>
          <?php } ?>
  </div>
</div> -->
</body>
</html>
