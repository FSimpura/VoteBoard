-- Registered users
create table users (
	id serial primary key,
	name varchar(25) NOT NULL UNIQUE CHECK (length(name) > 1),
	password varchar NOT NULL CHECK (length(password) > 4)
);

-- Created votes
create table votes (
	id serial primary key,
	name varchar(50) NOT NULL UNIQUE CHECK (length(name) > 1),
	descr varchar(500) NOT NULL CHECK (length(descr) > 0),
	startdate timestamp DEFAULT NOW(),
	enddate timestamp NOT NULL,
	creator integer REFERENCES users(id),
	showvotes boolean DEFAULT false
	--CHECK (startdate < enddate)
);

-- Options for the votings
create table choices (
	id serial primary key,
	name varchar(50) NOT NULL CHECK (length(name) > 0), 
	descr varchar(300)  NOT NULL CHECK (length(descr) > 0),
	votes integer DEFAULT 0,
	voteid integer REFERENCES votes(id)
);

-- Users who already have voted
create table voted (
	voted integer REFERENCES votes(id),
	voter integer REFERENCES users(id),
	primary key (voted, voter)
);

-- Votings that are open
create view open_votes as
	select *
	from votes
	where enddate > now();

-- Votings that are closed; no longer voteable
create view closed_votes as
	select *
	from votes
	where enddate <= now(); 
