#This script adds some data to the database to verify functionality.

#create a new mission
insert into mission (missionID, missionName)
	values (23, "Rescue Cat");

#create a new event
insert into mmEvent (eventID, eventName, latitude, longitude)
	values (1, 'Cat stuck on tree', 28.6520, 77.2315);
    
#set current event state to reported
insert into eventState (eventID, updateTime, state)
	values (1, now(), 'reported');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(1, now(), 'There is a problem.');
    
#assign event to mission
update mmEvent
	set missionID = 23
    where eventID = 1;

#wait for 2 seconds before adding more data
select sleep(2);

#modify current event state to assigned
insert into eventState (eventID, updateTime, state)
	values (1, now(), 'assigned');
    
#add a written note to the event
insert into eventNote (eventID, createTime, description)
	values(1, now(), 'The problem is now worse.');