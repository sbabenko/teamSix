#This script creates all the necessary tables for the FIRE-M2 application.

#table to store mission information
create table mission
	(missionID int auto_increment,
	missionName varchar(80) not null,
    primary key (missionID));

#table to store general event information
create table mmEvent
	(eventID int auto_increment,
    eventName varchar(80) not null,
    latitude float(10, 6) not null,
    longitude float(10, 6) not null,
	missionID int,
    primary key (eventID),
    foreign key (missionID) references mission (missionID));

#table to store event state changes
create table eventState
	(eventID int not null,
    updateTime datetime not null,
    state enum('reported', 'assigned', 'in progress', 'on hold', 'completed') not null,
    primary key (eventID, updateTime),
    foreign key (eventID) references mmEvent (eventID));

#table to store written notes about events
create table eventNote
	(noteID int auto_increment,
    eventID int not null,
    createTime datetime not null,
	description varchar(120) not null,
    primary key (noteID),
    foreign key (eventID) references mmEvent (eventID));
    
#table to store user account information
create table userAccount
	(accountID int auto_increment,
    firstName varchar(80) not null,
    lastName varchar(80),
	email varchar(80) not null,
	role enum('OC', 'MM'),
    isActive bool not null,
    primary key (accountID));
    