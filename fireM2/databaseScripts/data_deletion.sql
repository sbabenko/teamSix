#This script deletes only the database data for the FIRE-M2 application.

#delete all data in tables of database
delete from eventState;
delete from eventNote;
delete from mmEvent;
delete from mission;

#uncomment if account data must also be deleted
#delete from userAccount;