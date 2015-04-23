<?php
//file to create all the tables in the database
	function check($queryResult, $name) {
		if ($queryResult) {
			echo $name." works\r\n";
		}
		else {
			echo $name." didn't work\r\n";
		}
	}
	
	$dbconn = pg_connect("dbname=postgres user=postgres password=password");
	check($dbconn, "db connect");
	
	$stmt1 = 'CREATE SCHEMA suspref';
	$result = pg_query($dbconn, $stmt1);
	check($result, "create schema");
	
	$stmt2 = 'SET search_path TO suspref';
	$result = pg_query($dbconn, $stmt2);
	check($result, "set schema");
	
	$stmt3 = 'CREATE TABLE users (
		uid serial PRIMARY KEY,
		username varchar(64),
		email varchar(64),
		password varchar(64),
		first varchar(64),
		last varchar(64),
		birthdate date,
		gender char(1)
	)';
	
	$result = pg_query($dbconn, $stmt3);
	check($result, "users table");
	
	$stmt4 = 'CREATE TABLE restaurants (
		rid serial PRIMARY KEY,
		rname varchar(64),
		address varchar(128),
		longitude float,
		latitude float,
		description text
	)';
	
	$result = pg_query($dbconn, $stmt4);
	check($result, "restaurants table");
	
	$stmt5 = 'CREATE TABLE foods (
		rid integer NOT NULL,
		fid integer NOT NULL,
		fname varchar(64),
		fdesc text,
		PRIMARY KEY(rid, fid)
	)';
	
	$result = pg_query($dbconn, $stmt5);
	check($result, "foods table");
	
	$stmt6 = 'CREATE TABLE friends (
		sender integer NOT NULL,
		receiver integer NOT NULL,
		fadded date default now(),
		PRIMARY KEY(sender, receiver)
	)';
	
	$result = pg_query($dbconn, $stmt6);
	check($result, "friends table");
	
	$stmt7 = 'CREATE TABLE fooddiaries (
		uid integer,
		rid integer,
		fid integer,
		delish char(1),
		fdadded timestamp,
		PRIMARY KEY(uid, rid, fid)
	)';
	
	$result = pg_query($dbconn, $stmt7);
	check($result, "diaries table");
	
	$stmt8 = 'CREATE TABLE suggestions (
		uid integer,
		rid integer,
		fid integer,
		sadded timestamp,
		PRIMARY KEY(uid, rid, fid)
	)';
	
	$result = pg_query($dbconn, $stmt8);
	check($result, "suggestions table");
	
	
	$stmt9 = "INSERT INTO users (username, email, password, first, last, birthdate, gender) VALUES
('turducken','turducken@gmail.com','turducken','Tur','Ducken','2005-01-26','m'),
('giant2','giant2@gmail.com','147258369','Alan','Smith','2008-10-11','f'),
('digglet','digglet@gmail.com','741852963','Jack','Smith','2000-05-02','f'),
('mrpo','mrpo@gmail.com','123','John','Strauss','1999-05-04','f'),
('happyman','happyman@gmail.com','2134','Ken','Dickens','1994-01-08','m'),
('bike','bike@gmail.com','1','Sophie','Poland','1994-02-05','m'),
('apple','apple@gmail.com','2','Stirham','Chan','1992-05-08','f'),
('tiger','tiger@gmail.com','34','Michael','Wong','1991-04-07','f'),
('lion','lion@gmail.com','5','Monty','Li','1990-06-05','m'),
('bread','bread@gmail.com','67','Amy','Ching','1990-01-08','m'),
('sourdough','sourdough@gmail.com','8','Jessie','Chong','1992-04-03','f'),
('filament','filament@gmail.com','9','Carol','Top','1993-07-05','f'),
('keyboard','keyboard@gmail.com','4','Mississippi','White','1990-12-14','m'),
('pencil','pencil@gmail.com','10','Gertrude','Goldberg','1985-11-15','f'),
('plasticbag','plasticbag@gmail.com','22','Jason','Wu','1982-08-14','m'),
('waterbottle','waterbottle@gmail.com','33','Kissinger','Tupac','1981-07-18','f'),
('pencil','pencil@gmail.com','556','Portland','Konlo','2003-04-23','m'),
('napkin','napkin@gmail.com','22','Tyrone','Tobi','2000-07-05','f'),
('jabberwocky','jabberwocky@gmail.com','20','Ladeesha','MacArthur','2000-11-22','m'),
('ewok','ewok@gmail.com','15','Latoyna','Simpsons','1999-10-19','f');

INSERT INTO restaurants (rname, address, longitude, latitude, description) VALUES
('Shake Shack','409 Fulton St Brooklyn, NY 11201',-73.988605,40.692158,'Shake Shack is a fast casual restaurant chain based in New York City. It started out as a food cart inside Madison Square Park in 2000, and its popularity steadily grew. It eventually moved to a stand within the park, expanding its menu from New York-style hamburgers to one with hamburgers, hotdogs, fries and its namesake milkshakes. Despite initial growing problems with quality control and complaints regarding its french fries, it has been consistently well reviewed in the markets into which it has expanded.'),
('Panera Bread','345 Adams St Brooklyn, NY 11201',-73.9886,40.692622,'Panera Bread is a chain of bakery-café fast casual restaurants in the United States and Canada. Its headquarters are in Sunset Hills, Missouri, a suburb of St. Louis, and operates as Saint Louis Bread Company in the St. Louis metropolitan area. Offerings include soups, salads, pasta, sandwiches, and bakery items.'),
('Subway','391 Jay St Brooklyn, NY 11201',-73.98706,40.691926,'Subway (stylized as SUBWAY) is an American fast food restaurant franchise that primarily sells submarine sandwiches (subs) and salads. It is owned and operated by Doctor''s Associates. Subway is one of the fastest growing franchises in the world, with 43,035 restaurants in 108 countries and territories as of November 15, 2014. It is the largest single-brand restaurant chain and the largest restaurant operator globally.'),
('McDonald''s','420 Fulton St Brooklyn, NY 11201',-73.986223,40.690808,'The McDonald''s Corporation is the world''s largest chain of hamburger fast food restaurants, serving around 68 million customers daily in 119 countries across 35,000 outlets. Headquartered in the United States, the company began in 1940 as a barbecue restaurant operated by Richard and Maurice McDonald. In 1948, they reorganized their business as a hamburger stand using production line principles. Businessman Ray Kroc joined the company as a franchise agent in 1955. He subsequently purchased the chain from the McDonald brothers and oversaw its worldwide growth.'),
('Five Guys','2 Metrotech Roadway Brooklyn, NY 11201',-73.98571,40.693614,'Five Guys is a fast casual restaurant chain focused on hamburgers, hot dogs, and French fries, with its headquarters in the Lorton community in unincorporated Fairfax County, Virginia. The first Five Guys restaurant opened in 1986 in Arlington County, Virginia, and between 1986 and 2001, the chain expanded to five locations scattered through the Washington, D.C. metro area.'),
('Amarachi','189 Bridge St Brooklyn, NY 11201',-73.9856698,40.6975958,'Amarachi is a loungey, upscale locale for African-Caribbean fusion cuisine & distinctive cocktails.'),
('Tutt Café','47 Hicks St Brooklyn, NY 11201',-73.9932336,40.700276,'This modest Middle Eastern restaurant with outdoor seating offers entrees plus salads & sandwiches.'),
('Pedro''s','73 Jay St Brooklyn, NY 11201',-73.9870592,40.7024639,'Graffiti outside & no frills inside characterize this Dumbo option for Mexican food & margaritas. '),
('Au Bon Pain','One Metrotech LLC 70 Myrtle Avenue New York, NY 11201',-73.9843072,40.6927029,'Counter-service chain cafe serving soups, salads & sandwiches along with breads & other baked goods.'),
('2 Bro''s Pizza','395 Flatbush Ave Ext Brooklyn, NY 11201',-73.9822097,40.690234,'NYC-based chain dishing up pizza by the slice & whole pies in bare-bones environs.');

INSERT INTO foods VALUES
(1,1,'Single Shack Burger','Cheeseburger topped with lettuce, tomato and shack sauce'),
(1,2,'Double Shack Burger','Cheeseburger topped with lettuce, tomato and shack sauce'),
(1,3,'Hot Dog','Vienna all-beef dog'),
(1,4,'Bird Dog','Shake shack chicken, apple and sage sausage'),
(2,1,'Mediterranean Egg White On Ciabatta','Made with roasted tomatoes, spinach, vermont white cheddar & basil pesto.'),
(2,2,'Breakfast Power Sandwich On Whole Grain','Made with smoked ham, egg & vermont white cheddar'),
(2,3,'Chilled Shrimp & Soba Noodle Salad','Made with shrimp, napa cabbage blend, fresh baby spinach, sesame seeds, orange miso dressing & peanut sauce'),
(2,4,'Steak & White Cheddar On French Baguette','Made with seared top sirloin, caramelized onions, vermont white cheddar & horseradish spread'),
(2,5,'Roasted Turkey Artichoke On Asiago Cheese Focaccia','Made with all-natural, antibiotic-free roasted turkey, fresh baby spinach, roasted red peppers, carmelized onions & artichokeparmesan spread'),
(2,6,'Smokehouse Turkey On Three Cheese','Made with smoked turkey, applewood smoked bacon, smoked cheddar & sun-dried tomato ale mustard'),
(3,1,'BLT Sandwich',''),
(3,2,'Black Forest Ham Sandwich',''),
(3,3,'Buffalo Chicken Sandwich',''),
(3,4,'Italian BLT Sandwich',''),
(3,5,'Subway Melt Sandwich',''),
(3,6,'Tuna Sandwich',''),
(3,7,'Veggie Delite Sandwich',''),
(4,1,'Big Mac','Double layer of sear-sizzled 100% pure beef mingled with sauce and melty cheese, with onions and pickles'),
(4,2,'Quarter Pounder with Cheese',''),
(4,3,'Filet-o-fish','Made with white fish and tangy tartar sauce'),
(5,1,'Hamburger',''),
(5,2,'Cheeseburger',''),
(5,3,'Bacon Burger',''),
(5,4,'Bacon Cheeseburger',''),
(7,1,'Falafel Plate','Onions, lettuce, tomatos, olives & choice of hummus and babaghanou'),
(7,2,'Leg of Lamb','Roasted leg of lamb with onions, tomato, lettuce, olives & humus or babaghanou'),
(7,3,'Merguez Plate','Spicy lamb sausage with onions, lettuce, olives & humus or babaghanou'),
(8,1,'Chicken Sandwich','Tomato, lettuce, and mayo'),
(9,1,'Turkey Club Sandwich','Toasted country white antibiotic-free turkey, cheddar, applewood smoked bacon, tomatoes, mesclun & mayo'),
(9,2,'Caprese Sandwich','Ciabatta fresh mozzarella, tomatoes, arugula, mayo & basil pesto. caprese with all natural chicken'),
(10,1,'Pizza','');";

	$result = pg_query($dbconn, $stmt9);
	check($result, "add in data");
	
	
	?>
