#This script creates all the necessary tables for the FIRE-M2 application.

#table to store mission information
create table mission
	(missionID bigint auto_increment,
	missionName varchar(80) not null,
    primary key (missionID));

#table to store general event information
create table mmEvent
	(eventID bigint auto_increment,
    eventName varchar(80) not null,
    latitude decimal(10, 6) not null,
    longitude decimal(10, 6) not null,
	missionID bigint,
    primary key (eventID),
    foreign key (missionID) references mission (missionID));

#table to store event state changes
create table eventState
	(eventID bigint not null,
    updateTime datetime not null,
    state enum('reported', 'assigned', 'in progress', 'on hold', 'completed') not null,
    primary key (eventID, updateTime),
    foreign key (eventID) references mmEvent (eventID));

#table to store written notes about events
create table eventNote
	(noteID bigint auto_increment,
    eventID bigint not null,
    createTime datetime not null,
	description varchar(120) not null,
    primary key (noteID),
    foreign key (eventID) references mmEvent (eventID));
    
#table to store user account information
create table userAccount
	(accountID bigint auto_increment,
    firstName varchar(80) not null,
    lastName varchar(80),
	email varchar(80) not null,
	role enum('OC', 'MM'),
    isActive bool not null,
    primary key (accountID));
    