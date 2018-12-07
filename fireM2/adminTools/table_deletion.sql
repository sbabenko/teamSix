# Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
# Product Name: FIRE-M^2 (First Responder Mission Management)
# File Name: table_deletion.sql
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
# This script deletes all the necessary tables for the FIRE-M2 application.

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