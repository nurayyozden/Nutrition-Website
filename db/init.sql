CREATE TABLE posts (
 	id INTEGER NOT NULL UNIQUE,
 	name TEXT NOT NULL,
    time INTEGER,
    difficulty INTEGER NOT NULL,
    ingredients TEXT,
    social_media TEXT,
    file_name TEXT NOT NULL,
    file_ext TEXT NOT NULL,
    source TEXT,
    PRIMARY KEY(id AUTOINCREMENT)
 );

 -- Source: https://www.acouplecooks.com/salmon-and-asparagus/
INSERT INTO
posts (name, time, difficulty, ingredients, social_media, file_name, file_ext, source)
VALUES ('Salmon and Asparagus', 20, 4, '1 pound thin asparagus, 1 pound salmon, wild caught if possible, 2 tablespoons olive oil, Kosher salt and fresh ground black pepper, Lemon, Minced fresh herbs (like chives, mint or thyme), for garnish', 'acouplecooks', 'salmonasparagus.jpeg','jpeg', 'https://www.acouplecooks.com/salmon-and-asparagus/');


-- Image Source: https://fitfoodiefinds.com/the-best-eggplant-parmesan/ --
INSERT INTO posts (name, time, difficulty, file_name, file_ext, source)
VALUES ('Eggplant Parmesean', 60, 3, 'eggplantparmesean.jpeg',
    'jpeg',
    'https://www.tablefortwoblog.com/eggplant-parmesan/' );

-- Image Source: https://www.eatwell101.com/easy-fish-taco-recipe --
INSERT INTO posts (name, time, difficulty, social_media, file_name, file_ext, source)
VALUES ('Fish Tacos', 45, 4, 'nurayyozden', 'fishtacos.jpeg',
    'jpeg',
    'https://www.eatwell101.com/easy-fish-taco-recipe' );

-- Image Source: https://www.simplejoy.com/mediterranean-salad/ --
INSERT INTO posts (name, time, difficulty, ingredients, file_name, file_ext, source)
VALUES ('Mediterranean Salad', 20, 1, 'tomatoes, cucmber, red onions, lettuce, olives, feta, olive oil, red wine vinegar, orgenao, salt, pepper', 'medsalad.jpeg',
    'jpeg',
    'https://www.simplejoy.com/mediterranean-salad/');

-- Image Source: https://www.eatingbirdfood.com/turkey-burger/ --
INSERT INTO posts (name, time, difficulty, file_name, file_ext, source)
VALUES ('Turkey Burgers', 30, 2, 'turkeyburger.jpeg',
    'jpeg',
    'https://www.eatingbirdfood.com/turkey-burger/');

-- Source: https://www.howsweeteats.com/2021/01/bolognese-stuffed-peppers/
INSERT INTO posts (name, time, difficulty, ingredients, file_name, file_ext, source)
VALUES ('Bolognese Stuffed Peppers', 40, 5, '4 bell peppers, sliced in half lengthwise, seeds removed
2 tablespoons olive oil
kosher salt and pepper
1 sweet onion diced
4 garlic cloves minced
8 ounces cremini mushrooms chopped
1 pound lean ground turkey, I like 94% lean
2 tablespoons tomato paste
1/2 teaspoon dried basil
1/2 teaspoon dried oregano
1/4 teaspoon crushed red pepper flakes
1 tablespoon brown sugar
1/2 cup dry red wine
1 14 ounce can fire roasted tomatoes
1 28 ounce can crushed tomatoes
1/2 cup freshly grated parmesan cheese, plus more for serving
1 cup freshly grated mozzarella or provolone cheese', 'stuffedpeppers.jpeg',
    'jpeg',
    'https://www.howsweeteats.com/2021/01/bolognese-stuffed-peppers/');

-- Image Source: https://www.mygorgeousrecipes.com/world-best-vegetarian-omelette/ --
INSERT INTO posts (name, time, difficulty, social_media, file_name, file_ext, source)
VALUES ('Veggie Omelette', 10, 1, 'barack_obama', 'veggieomelette.jpeg',
    'jpeg',
    'https://www.mygorgeousrecipes.com/world-best-vegetarian-omelette/');


-- Source: https://www.loveandlemons.com/vegan-pasta/
INSERT INTO posts (name, time, difficulty, ingredients, file_name, file_ext, source)
VALUES ('Creamy Broccoli Pasta', 30, 3,  'White beans are the secret ingredient that make this sauce thick, smooth, and creamy! They also add a good amount of plant-based protein. Use canned beans, or cook your own. Lemon juice brightens it up. Olive oil adds richness. Nutritional yeast fills this vegan pasta with yummy cheese-like flavor. Onion powder & garlic amp up the savory, umami flavors in this recipe.
Vegetable broth (and pasta cooking water, if you like) loosens the sauce as needed.
Pasta. I used small shell pasta, but use what you have on hand. Orecchiette, bow ties, or rigatoni would all be great. Read the label on your pasta to make sure it is vegan, most dried pastas are.
Broccoli and chopped up broccoli stems. This recipe is a great way to use up the whole vegetable. If your broccoli still has leaves attached, toss those in too!And pine nuts add a delicious crunch!', 'broccolipasta.jpeg',
    'jpeg',
    'https://www.loveandlemons.com/vegan-pasta/');

-- Image Source: https://naturallieplantbased.com/15-minute-miso-dumpling-soup/ --
INSERT INTO posts (name, time, difficulty, social_media, file_name, file_ext, source)
VALUES ('Miso Dumpling Soup', 15, 1, 'nurayyozden', 'misosoup.jpeg',
    'jpeg',
    'https://naturallieplantbased.com/15-minute-miso-dumpling-soup/' );

-- Image Source: https://bellyfull.net/tuna-melt/ --
INSERT INTO posts (name, time, difficulty, file_name, file_ext, source)
VALUES ('Tuna Melt Sandwich', 20, 2, 'tunamelt.jpeg',
    'jpeg',
    'https://bellyfull.net/tuna-melt/');

-- Image Source: https://thenoshery.com/asian-chicken-and-toasted-coconut-rice-bowls/ --
INSERT INTO posts (name, time, difficulty, social_media, file_name, file_ext, source)
VALUES ('Asian Chicken Rice Bowl', 30, 4, 'selenagomez', 'asianbowl.jpeg',
    'jpeg',
    'https://thenoshery.com/asian-chicken-and-toasted-coconut-rice-bowls/' );

-- Image Source: https://www.cookingclassy.com/zucchini-noodles/ --
INSERT INTO posts (name, time, difficulty, social_media, file_name, file_ext, source)
VALUES ('Zoodles', 30, 4,'kylieharms', 'zoodles.jpeg',
    'jpeg',
    'https://www.cookingclassy.com/zucchini-noodles/');



CREATE TABLE types (
    id INTEGER NOT NULL UNIQUE,
    name TEXT NOT NULL,
    text_name TEXT NOT NULL,
    PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO types (name, text_name)
VALUES ("glutenfree", "Gluten Free");

INSERT INTO types (name, text_name)
VALUES ("vegetarian", "Vegetarian");

INSERT INTO types (name, text_name)
VALUES ("vegan", "Vegan");

INSERT INTO types (name, text_name)
VALUES ("pesketarian", "Pesketarian");

INSERT INTO types (name, text_name)
VALUES ("keto", "Keto");

INSERT INTO types (name, text_name)
VALUES ("lowcarb", "Low Carb");

INSERT INTO types (name, text_name)
VALUES ("dairyfree", "Dairy Free");

INSERT INTO types (name, text_name)
VALUES ("sweet", "Sweet");

INSERT INTO types (name, text_name)
VALUES ("hasmeat", "Has Meat");


CREATE TABLE post_tags (
    id INTEGER NOT NULL UNIQUE,
    post_id INTEGER NOT NULL,
    type_id INTEGER NOT NULL,
    PRIMARY KEY(id AUTOINCREMENT)
	FOREIGN KEY(post_id)
		REFERENCES posts(id),
    FOREIGN KEY(type_id)
		REFERENCES types(id)
);

INSERT INTO post_tags (post_id, type_id)
VALUES (1, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (1, 7);

INSERT INTO post_tags (post_id, type_id)
VALUES (2, 2);

INSERT INTO post_tags (post_id, type_id)
VALUES (2, 6);

INSERT INTO post_tags (post_id, type_id)
VALUES (2, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (3, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (3, 7);

INSERT INTO post_tags (post_id, type_id)
VALUES (4, 2);

INSERT INTO post_tags (post_id, type_id)
VALUES (4, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (4, 5);

INSERT INTO post_tags (post_id, type_id)
VALUES (4, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (5, 9);

INSERT INTO post_tags (post_id, type_id)
VALUES (5, 7);

INSERT INTO post_tags (post_id, type_id)
VALUES (6, 9);

INSERT INTO post_tags (post_id, type_id)
VALUES (6, 5);

INSERT INTO post_tags (post_id, type_id)
VALUES (6, 6);

INSERT INTO post_tags (post_id, type_id)
VALUES (6, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (7, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (7, 2);

INSERT INTO post_tags (post_id, type_id)
VALUES (7, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (7, 5);

INSERT INTO post_tags (post_id, type_id)
VALUES (7, 6);

INSERT INTO post_tags (post_id, type_id)
VALUES (8, 2);

INSERT INTO post_tags (post_id, type_id)
VALUES (8, 3);

INSERT INTO post_tags (post_id, type_id)
VALUES (8, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (9, 2);

INSERT INTO post_tags (post_id, type_id)
VALUES (9, 3);

INSERT INTO post_tags (post_id, type_id)
VALUES (9, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (9, 7);

INSERT INTO post_tags (post_id, type_id)
VALUES (10, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (10, 9);

INSERT INTO post_tags (post_id, type_id)
VALUES (11, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (11, 9);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 1);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 2);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 3);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 4);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 5);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 6);

INSERT INTO post_tags (post_id, type_id)
VALUES (12, 7);

CREATE TABLE users (
	id INTEGER NOT NULL UNIQUE,
	username TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO users (username, password)
VALUES ('nurayozden', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.');

CREATE TABLE sessions (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(user_id) REFERENCES users(id)
);
