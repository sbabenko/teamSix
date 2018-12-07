# Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
# Product Name: FIRE-M^2 (First Responder Mission Management)
# File Name: data_deletion.sql
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
# This script deletes only the database data for the FIRE-M2 application.

#delete all data in tables of database
delete from resourceMission;
delete from resource;
delete from eventState;
delete from eventNote;
delete from mmEvent;
delete from missionAssignment;
delete from mission;

#uncomment if account data must also be deleted
#delete from userAccount;