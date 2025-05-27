# Pokedex tracker

Hi, this website was made out of boredom, kinda being an challenge with my school colleague (ruben), with the goal of being a pokedex tracker. This idea appeared when he did one pokedex tracker in C, and he wanted it to have an interface, so i decided to say - "why not make it an website?".

Well he liked the idea and then we started doing it, transforming it in a competition!

i'll write later the features of the website! >_<

## Database name
```sql
CREATE DATABASE pokedextracker;
```
This is the database name of the project.
## Table "users"
This is the table of the users (and yes 'roll' is a typo)
```sql
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(30) NOT NULL,
  `roll` varchar(30) NOT NULL DEFAULT 'peasent',
  `email` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `dob` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);
```