# Pokedex tracker

Hi, this website was made out of boredom, kinda being an challenge with my school colleague (ruben), with the goal of being a pokedex tracker. This idea appeared when he did one pokedex tracker in C, and he wanted it to have an interface, so i decided to say - "why not make it an website?".

Well he liked the idea and then we started doing it, transforming it in a competition!

i'll write later the features of the website! >_<

## Creating the database
This is the database name of the project.
```sql
CREATE DATABASE pokedextracker;
```
## Creating the table "users" - 
This is the table of the users
```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'peasent',
  `email` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `dob` varchar(40) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'img/user-not-login.png',
  `description` VARCHAR(150) NOT NULL, 
  `favoritepokemon` VARCHAR(100),
  `background_image` VARCHAR(100), 
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` DATE
);
```
## Creating table for background images for favorite user pokemon
```sql
CREATE TABLE background_images_pokemons
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    background_image VARCHAR(100) NOT NULL
);
## Creating the table "pokedexs"
Table where the pokedexs are going to be stored
```sql
create table pokedexs
(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `generations` VARCHAR(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
);
```
## Creating the table "pokemons"
Table where the pokemons are going to be stored
```sql
create table pokemons
(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL,
    `generation` INT(11) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `pokedexEntry` VARCHAR(255) NOT NULL,
    `type1` VARCHAR(15) NOT NULL,
    `type2` VARCHAR(15) NOT NULL
);
```
## Inserting pokemons into database
The insert sql query code is in a txt file called "pokemons.text" as it is too much big to insert it here
## Admin account
To check out the admin features, you need an admin account, and of course new accounts dont come with the admin tag, so you are going to need to create one!

Username: 123
Password: 123

```sql
INSERT INTO `users` (`username`, `role`, `email`, `pwd`, `dob`) VALUES ('123', 'admin', '123@gmail.com', '$2y$12$rLO9nUCPqipum0OkeJyoJuHOqtJiB8RhvzOsyvPr0VQ9NH6XhNO3q', '2012-9-12');
```