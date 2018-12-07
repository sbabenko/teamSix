# Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
# Product Name: FIRE-M^2 (First Responder Mission Management)
# File Name: sample_data_insertion.sql
#
# Date Last Modified: November 16, 2018 (Aditya Kaliappan)
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
# This script adds some data to the database to verify functionality.
    
#create a new mission
insert into mission (missionID, missionName, isActive)
	values (1, "Operation Ocean City", true);

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (1, 'Tree fell down, blocking road', 38.3365, -75.0849, 'fire', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (1, now(), 'reported');

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (1, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(1, now(), 'The tree is 100 ft tall.');
    
#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (2, 'Power outage', 38.2765, -75.3849, 'fire', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (2, now(), 'reported');

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (2, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(2, now(), '50 houses affected.');
    
#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (3, 'Dog stuck on roof', 38.3365, -75.7849, 'fire', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (3, now(), 'reported');

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (3, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(3, now(), 'Dog is a golden retriever.');

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (4, 'House on fire!', 38.6365, -75.2849, 'fire', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (4, now(), 'reported');

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (4, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(4, now(), 'Near the big building.');

#assign above events to mission
update mmEvent
	set missionID = 1;
    
#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (5, 'House 2 on fire!', 38.6365, -75.7849, 'fire', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (5, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(5, now(), 'Near the small building.');
    
#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (6, 'House 3 on fire!', 38.7365, -75.7849, 'fire', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (6, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(6, now(), 'Near the restaurant.');
    
#create a new mission
insert into mission (missionID, missionName, isActive)
	values (2, "Rescue Cat", true);

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude, category, submitMethod)
	values (7, 'Cat stuck on tree', 28.6520, 77.2315, 'tsunami', 'phone');
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (7, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(7, now(), 'There is a problem.');
    
#assign event to mission
update mmEvent
	set missionID = 2
    where eventID = 7;

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (7, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(7, now(), 'The problem is now worse.');
    
#add resources
insert into resource (resourceName, quantity)
	values ("Ambulance", 10);
insert into resource (resourceName, quantity)
	values ("Police", 200);
insert into resource (resourceName, quantity)
	values ("Support Animal", 15);
insert into resource (resourceName, quantity)
	values ("Firetruck", 5);
    
#uncomment if mission manager account MM01@umbc.edu exists
#insert into missionAssignment (accountEmail, missionID)
#	values ("MM01@umbc.edu", 1);
#insert into missionAssignment (accountEmail, missionID)
#	values ("MM01@umbc.edu", 2);