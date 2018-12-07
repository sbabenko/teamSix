# Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
# Product Name: FIRE-M^2 (First Responder Mission Management)
# File Name: update_password.py
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
# This program will allow an administrator to update the password of any user
# account in the system.
#
# References:
# https://stackoverflow.com/questions/31291317/php-is-not-recognized-as-an-
#     internal-or-external-command-in-command-prompt
# https://stackoverflow.com/questions/48159538/passing-post-variable-with-
#     subprocess-popen
# https://stackoverflow.com/questions/12605498/how-to-use-subprocess-popen-python

import subprocess
import mysql.connector

#display header for program
print("Update User Account Password")

#connect to database
fireM2db = mysql.connector.connect(
    host="mysql-instance1.crdymdfwdzej.us-east-1.rds.amazonaws.com",
    user="root",
    passwd="GucciSwag420",
    database="FIREM2")

#create cursor to perform queries
mycursor = fireM2db.cursor()

#create query to get all user emails in database
sql = "select email from userAccount"

#execute query
mycursor.execute(sql)

#get all email results
results = mycursor.fetchall()

#display all available emails
counter = 0
for element in results:
    #display email in list format
    print(str(counter + 1) + ". " + element[0])
    counter = counter + 1

#get email selection
if(counter > 0):
    #select one email
    email = ""
    while(True):
        #get email entry number
        emailID = int(raw_input("Select email number (ex. 1): "))

        #validate that entry is within range
        if(emailID > 0 and emailID <= counter):
            email = results[emailID - 1][0]
            break;

    #get new password
    password = ""
    while(len(password) == 0):
        #get password input
        password = raw_input("Enter password: ")

        #validate that nonempty password is entered
        if(len(password) == 0):
            password = ""

    #run PHP script to hash password
    proc = subprocess.Popen(['php', 'hashPassword.php', password],
                            stdout = subprocess.PIPE)

    #get password hash
    passHash = proc.stdout.readline()

    #create query to insert account into database
    sql = "update userAccount set loginPass = %s where email = %s"
    val = (passHash, email)

    #execute query
    mycursor.execute(sql, val)

    #commit changes to database
    fireM2db.commit()

    #display success message
    print("User password successfully updated.")
else:
    #display error message for no available accounts
    print("No accounts available.")
