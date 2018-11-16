#References:
#https://stackoverflow.com/questions/31291317/php-is-not-recognized-as-an-
#     internal-or-external-command-in-command-prompt
#https://stackoverflow.com/questions/48159538/passing-post-variable-with-
#     subprocess-popen
#https://stackoverflow.com/questions/12605498/how-to-use-subprocess-popen-python

import subprocess
import mysql.connector

#display header for program
print("Create New User Account")

#get email
email = ""
while(len(email) == 0):
    #get email input
    email = raw_input("Enter email: ")

    #validate that email of correct form is entered
    if(len(email) == 0 or email[-1] == "." or email.find("@") == -1 or
       email.find(".") == -1 or email.find("@") >= email.find(".")):
        email = ""

#get password
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

#get first name
firstName = ""
while(len(firstName) == 0):
    #get first name input
    firstName = raw_input("Enter first name: ")

    #validate that nonempty first name is entered
    if(len(firstName) == 0):
        firstName = ""

#get last name
lastName = raw_input("Enter last name: ")

#get account type
accountType = ""
while(len(accountType) == 0):
    #get account type input
    accountType = raw_input("Enter account type (OC, MM): ")

    #validate that account type is valid
    if(not(accountType.startswith("OC") or accountType.startswith("MM"))):
        accountType = ""

#connect to database
fireM2db = mysql.connector.connect(
    host="mysql-instance1.crdymdfwdzej.us-east-1.rds.amazonaws.com",
    user="root",
    passwd="GucciSwag420",
    database="FIREM2")

#create cursor to perform queries
mycursor = fireM2db.cursor()

#create query to insert account into database
sql = """insert into userAccount (email, firstName, lastName, loginPass, role)
            values (%s, %s, %s, %s, %s)"""
val = (email, firstName, lastName, passHash, accountType)

#execute query
mycursor.execute(sql, val)

#commit changes to database
fireM2db.commit()

#display success message
print("User has successfully been created.")
