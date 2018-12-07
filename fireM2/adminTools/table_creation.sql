# Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
# Product Name: FIRE-M^2 (First Responder Mission Management)
# File Name: table_creation.sql
#
# Date Last Modified: November 23, 2018 (Aditya Kaliappan)
#
# Copyright: (c) 2018 by FIRE^2
# and all corresponding participants which include:
# Aditya Kaliappan
# Lorenzo Neil
# Robert Duguay
# Stanislav Babenko
# Daniel Volinski
#
# File Description:
# This script creates all the necessary tables for the FIRE-M2 application.

#table to store mission information
create table mission
	(missionID int auto_increment,
	missionName varchar(80) not null,
	isActive bool not null,
    primary key (missionID));

#table to store general event information
create table mmEvent
	(eventID int auto_increment,
    eventName varchar(80) not null,
    latitude float(10, 6) not null,
    longitude float(10, 6) not null,
    category enum('hurricane', 'flood', 'tsunami', 'fire', 'earthquake',
				  'landslide', 'sinkhole', 'volcano', 'tornado', 'natural gas') not null,
	submitMethod enum('phone', 'sms', 'email', 'twitter', 'facebook') not null,
	missionID int default null,
    primary key (eventID),
    foreign key (missionID) references mission (missionID));

#table to store event state changes
create table eventState
	(eventID int,
    updateTime datetime,
    state enum('reported', 'assigned', 'in progress', 'on hold', 'completed') not null,
    primary key (eventID, updateTime),
    foreign key (eventID) references mmEvent (eventID));

#table to store written notes about events
create table eventNote
	(eventID int,
    createTime datetime,
	description varchar(120) not null,
    primary key (eventID, createTime),
    foreign key (eventID) references mmEvent (eventID));

#table to store resources not assigned to any mission
create table resource
	(resourceID int auto_increment,
    resourceName varchar(80) unique not null,
    quantity int not null,
    primary key (resourceID));
    
#table to store resources available to each mission
create table resourceMission
	(missionID int,
    resourceID int,
    quantity int not null,
    primary key (missionID, resourceID),
    foreign key (missionID) references mission (missionID),
    foreign key (resourceID) references resource (resourceID));

#table to store user account information
#uncomment if user account table needs to be created
#create table userAccount
#	(email varchar(80),
#    firstName varchar(80) not null,
#    lastName varchar(80),
#    loginPass varchar(100) not null,
#	role enum('OC', 'MM') not null,
#    isActive bool default true,
#    primary key (email));

#table to store mission assignments to accounts
create table missionAssignment
	(accountEmail varchar(80),
    missionID int,
    primary key (accountEmail, missionID),
    foreign key (accountEmail) references userAccount (email),
    foreign key (missionID) references mission (missionID));