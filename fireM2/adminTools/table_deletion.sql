#This script deletes all the necessary tables for the FIRE-M2 application.

#drop all tables in database
drop table resourceMission;
drop table resource;
drop table eventState;
drop table eventNote;
drop table mmEvent;
drop table missionAssignment;
drop table mission;

#uncomment if accounts must also be deleted
#drop table userAccount;