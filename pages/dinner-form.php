<?php

$show_confirmation = False;

$image_too_big = False;

$image_fail = False;

$name_empty = False;

$diff_empty = False;
// vegan, vegetarian, ...
$all_tags = exec_sql_query(
    $db,
    "SELECT types.name AS 'types.name' FROM types;")->fetchAll();

$first_entry = exec_sql_query($db, "SELECT * FROM posts LIMIT 1;")->fetchAll();

$all_params = array();

// getting array of all params
foreach ($first_entry[0] as $key => $value) {
     if (!is_int($key)) {
        array_push($all_params, $key);
     }
}

// remove id field
$deleted = array_shift($all_params);

// insert values to table

$insert_values = array(); // what goes in table
$form_values = array(); // what is put in form by user

foreach ($all_params as $param) {
	// array_push($insert_values, $param);
    $insert_values[$param] = NULL;
    // array_push($form_values, $param);
    $form_values[$param] = '';
}

// tags for post_tags table from all_tags array
$insert_tags = array();
foreach ($all_tags as $tag) {
    $insert_tags[$tag['types.name']] = NULL;
}

$array_len = count($insert_tags);

// image stuff
$upload_feedback = array(
    'general_error' => False,
    'too_large' => False
);

$upload_file_name = NULL;
$upload_file_ext = NULL;
$upload_source = NULL;


if (isset($_POST["post-dinner"])) {

    $form_valid = True;


  // getting user data
  foreach ($all_params as $param) {
        if (!in_array($param, array('file_name', 'file_ext', 'source'))) {
            $form_values[$param] = $_POST[$param];
        }
    }


        if ($form_values['name'] == '') {
            $form_valid = False;
            $name_empty = True;
        }

        if ($form_values['difficulty'] == '') {
            $form_valid = False;
            $diff_empty = True;
        }

}

$upload = $_FILES['jpeg_file'];

if ($upload['error'] == UPLOAD_ERR_OK) {

        $upload_source = trim($_POST['source']); // unstrusted
        if (empty($upload_source)) {

            // $upload_source = NULL;

            $upload_file_name = basename($upload['name']);

            $upload_file_ext = strtolower(pathinfo($upload_file_name, PATHINFO_EXTENSION));

        if (!in_array($upload_file_ext, array('jpeg'))) {
        $form_valid = False;
        $upload_feedback['general_error'] = True; }

        } else if (($upload['error'] == UPLOAD_ERR_INI_SIZE) || ($upload['error'] == UPLOAD_ERR_FORM_SIZE)) {
            // file was too big
            $form_valid = False;
            $upload_feedback['too_large'] = True;
            $image_too_big = True;
        } else {
            // upload not successful
            $form_valid = False;
            $upload_feedback['general_error'] = True;
            $image_fail = True;
        }
    }

    if (isset($_POST["post-dinner"])) {

        $form_values['source'] = $upload_source;
        $form_values['file_name'] = $upload_file_name;
        $form_values['file_ext'] = $upload_file_ext;

        if ($form_values['file_name'] == NULL) {
            $form_valid = False;
            $image_fail = True;
        }

        if ($form_values['file_ext'] == NULL) {
            $form_valid = False;
            $image_fail = True;
        }
    }





if ($form_valid) {
    // putting everything in posts table
    $show_confirmation = True;

    foreach ($all_params as $param) {
        $insert_values[$param] = ($form_values[$param] == '' ? NULL : $form_values[$param]); // untrusted
    }


    $query_params1 = implode(", ", $all_params);
    $query_params2 = implode(", :", $all_params);

    $insert_query = "INSERT INTO posts (". $query_params1 . ") VALUES (:" . $query_params2 . ");";

    $query_array = array();
    foreach ($all_params as $param) {
        $mod = ':' . $param;
        array_push($query_array, $mod);
        $query_array[$param] = $insert_values[$param];
    }


    $result = exec_sql_query(
        $db,
        $insert_query,
        $query_array
    );

    // moving the image to correct meal-images
    if ($result) {
        $record_id = $db->lastInsertId('id');
        $upload_storage_path = 'public/uploads/meal-images/' . $record_id . '.' . $upload_file_ext;
        if (move_uploaded_file($upload["tmp_name"], $upload_storage_path) == False) {
        error_log("Failed to permanently store the uploaded file on the file server. Please check that the server folder exists.");
        }
    }

    //get post id
    $last_post_id = $db->lastInsertId('id');

    foreach ($insert_tags as $key => $value) {
        $insert_tags[$key] = ($_POST[$key] == '' ? NULL : (bool)$_POST[$key]); //untrusted
    }


    foreach ($insert_tags as $key => $value)
         // have to get id of the $tag using sql select from types table, call it $tag_id
        if ($value != NULL) {
            $tag_id = exec_sql_query($db, "SELECT types.id AS 'types.id' FROM types WHERE types.name = :key", array(':key' => $key))->fetchAll(); // tainted
            $result2 = exec_sql_query(
                $db,
                "INSERT INTO post_tags (post_id, type_id) VALUES (:post_id, :type_id);",
                array(
                ':post_id' => $last_post_id, // tainted
                ':type_id' => $tag_id[0][0] // tainted
                )
            );
        }
}

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
      // Access Controls - Interface: Only logged in users may upload
      if (is_user_logged_in()) { ?>

    <?php  if ($show_confirmation) { ?>

        <div class="confirmation" id="form-box">

        <h2>Post Confirmation</h2>

        <p>Thanks for posting your meal - you should see it on the <a href="/">home page</a></p>

        </div>

    <?php } else { ?>

    <header>
        <h1>Post Dinner</h1>
    </header>

    <form class="insert" action="/dinner-form" method="post" enctype="multipart/form-data">

    <input type="hidden" name ="MAX_FILE_SIZE" value="1000000" />

        <?php if ($name_empty) { ?>

            <p class="feedback">Please provide a meal name!</p>

        <?php } ?>

        <div class="form-question">
            <label for="request-name">Meal name:</label>
            <input type="text" name="name" id="request-name"/>
        </div>

        <?php if ($image_too_big) { ?>

            <p class="feedback">Image is too big - please upload smaller image!</p>

    <?php } ?>

    <?php if ($image_fail) { ?>

            <p class="feedback">Image upload failed - try again!</p>

        <?php } ?>

        <div class="form-question">
            <label for="upload-file">Meal image upload:</label>
            <input id="upload-file" type="file" accept=".jpeg,images/jpeg+xml" name="jpeg_file" >
        </div>


        <div class="label-input">
            <label for="upload-source" class="optional">Source URL (If you took the picture yourself, just leave this blank!):</label>
            <input id='upload-source' type="url" name="source">
            </div>

        <div class="form-question">
            <label for="request-time">How long does this dish take prepare (in minutes)?</label>
            <input type="number" name="time" id="request-time"/>
        </div>

        <?php if ($diff_empty) { ?>

        <p class="feedback">Please provide this meal's difficulty!</p>

        <?php } ?>

        <div class="form-question">
            <label for="request-difficulty">On a scale from 1 to 5, how difficult is this dish to prepare?</label>
            <input type="number" name="difficulty" id="request-difficulty"/>
        </div>
        <p>Select which dietary restriction applies to this meal: </p>

        <?php

        $tags_and_names = exec_sql_query(
            $db,
            "SELECT types.name AS 'types.name', types.text_name AS 'types.text_name' FROM types;")->fetchAll();

        foreach ($tags_and_names as $tags) { ?>

            <div class="form-question">
            <input type="checkbox" name="<?php echo $tags['types.name']; ?>" id="check-<?php echo $tags['types.name']; ?>"/>
            <label for="check-<?php echo $tags['types.name']; ?>"><?php echo $tags['types.text_name']; ?></label>
            </div>

            <?php } ?>




        <div class="form-question">
            <label for="request-ingredients">Ingredients/description: </label>
            <div>
            <textarea name="ingredients" cols="40" rows="5" id="request-ingredients"></textarea>
            </div>
        </div>
        <div class="form-question">
            <label for="request-social-media">What's your social media handle, if you'd like to include it?</label>
            <input type="text" name="social_media" id="request-social-media"/>
        </div>

        <div class="form-submit">
            <input id="post-dinner" name="post-dinner" type="submit" value="Post Dinner" />
        </div>
        <br>
        <a href="/">Navigate home</a>



    </form>

    <?php } } else { ?>

        <p>Please login to post meals:</p>

        <?php echo login_form('/dinner-form', $session_messages);


    } ?>

</body>
</html>
