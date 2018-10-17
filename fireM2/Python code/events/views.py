from django.shortcuts import render
from django.db import connection

# Create your views here.

def Test(request) :

    cursor = connection.cursor()
    cursor.execute('''SELECT * FROM events''')
    row = cursor.fetchone()

    print row

    context = {"row":row}
    return render(request, "index.html", context)