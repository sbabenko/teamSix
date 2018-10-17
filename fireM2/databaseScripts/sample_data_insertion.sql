#This script adds some data to the database to verify functionality.
    
#create a new mission
insert into mission (missionID, missionName)
	values (1, "Operation Ocean City");

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude)
	values (1, 'Tree fell down, blocking road', 38.3365, -75.0849);
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (1, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(1, now(), 'The tree is 100 ft tall.');
    
#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude)
	values (2, 'Power outage', 38.2765, -75.3849);
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (2, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(2, now(), '50 houses affected.');
    
#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude)
	values (3, 'Dog stuck on roof', 38.3365, -75.7849);
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (3, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(3, now(), 'Dog is a golden retriever.');

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude)
	values (4, 'House on fire!', 38.6365, -75.2849);
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (4, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(4, now(), 'Near the big building.');

#assign above events to mission
update mmEvent
	set missionID = 1;
    
    
#create a new mission
insert into mission (missionID, missionName)
	values (2, "Rescue Cat");

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude)
	values (5, 'Cat stuck on tree', 28.6520, 77.2315);
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (5, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(5, now(), 'There is a problem.');
    
#assign event to mission
update mmEvent
	set missionID = 2
    where eventID = 5;

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (5, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(5, now(), 'The problem is now worse.');