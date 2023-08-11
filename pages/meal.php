
<?php
$id = $_GET['id'];

// get the meal data from posts table

$entry = exec_sql_query(
    $db,
    "SELECT posts.id AS 'posts.id', posts.name AS 'posts.name', posts.time AS 'posts.time', posts.difficulty AS 'posts.difficulty', posts.ingredients AS 'posts.ingredients', posts.social_media AS 'posts.social_media', posts.file_ext as 'posts.file_ext'
    FROM posts
    WHERE posts.id = :post_id",
    array(
        ':post_id' => $id, // tainted
      )
);

$entries = $entry->fetchAll();


// get the tags

$tags_list = exec_sql_query(
    $db,
    "SELECT types.name AS 'types.name', types.text_name AS 'types.text_name'
    FROM post_tags INNER JOIN types
    ON (post_tags.type_id = types.id)
    WHERE post_tags.post_id = :post_id",
    array(
        ':post_id' => $id, // tainted
      )
);

$tags = $tags_list->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="public/styles/site.css" />
  <title>Dinner for All!</title>
</head>

<body>

<?php



foreach ($entries as $record) { ?>

    <h1><?php echo htmlspecialchars($record["posts.name"]); ?></h1>
    <?php $file_location = '/public/uploads/meal-images/' . $record['posts.id'] . '.' . $record['posts.file_ext']; // file location ?>
    <img class="meal-image2" src="<?php echo htmlspecialchars($file_location); ?>" alt=<?php echo htmlspecialchars($record["posts.name"]); ?>>
    <p>Time it takes to prepare (in minutes): <?php echo htmlspecialchars($record["posts.time"]); ?></p>
    <p>Difficulty level: <?php echo htmlspecialchars($record["posts.difficulty"]); ?> / 5</p>
    <?php if ($record['posts.ingredients'] != '') { ?>
        <p>Ingredients: <?php echo htmlspecialchars($record['posts.ingredients']); ?></p>
    <?php } ?>
    <?php if ($record['posts.social_media'] != '') { ?>
        <p>Author's social media: <?php echo htmlspecialchars($record["posts.social_media"]); ?></p>
        <?php } ?>
    <?php } ?>

<p>Diet type(s):</p>

<?php
foreach ($tags as $tag) { ?>

    <p><?php echo htmlspecialchars($tag["types.text_name"]); ?></p>

<?php } ?>

<a href="/">Navigate home</a>


</body>


</html>
