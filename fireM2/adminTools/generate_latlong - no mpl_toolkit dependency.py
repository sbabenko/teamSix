import argparse
from pprint import pprint
from time import sleep
#from mpl_toolkits.basemap import Basemap
from random import uniform
import mysql.connector
import datetime
import random


# Inserts into database.
# 1. Creates connection.
# 2. Selects a random event method and random event name based on list given.
#    List can be modified (add or remove variable).
# 3. Execute MySQL queries.

def insert_to_database(x, y, eventType):
    fireM2db = mysql.connector.connect(
        host="mysql-instance1.crdymdfwdzej.us-east-1.rds.amazonaws.com",
        user="root",
        passwd="GucciSwag420",
        database="FIREM2"
    )

    print(fireM2db)

    eventCategory = str.lower(eventType)
    SUBMIT_EVENT_METHOD = ['phone', 'sms', 'email', 'twitter', 'facebook']
    submitMethod = random.choice(SUBMIT_EVENT_METHOD)
    SUBMIT_EVENT_NAME = ["The sky is falling.",
                         "There a cat on my roof.",
                         "I have fallen and I can't get up.",
                         "I feel heartburn coming.",
                         "Penguins are surrounding my house.",
                         "Birds are falling from the sky.",
                         "There's an alien in my backyard.",
                         "The duck has been spotted.",
                         "My dog started speaking to me in French.",
                         "We lost gravity."]
    submitName = random.choice(SUBMIT_EVENT_NAME)
    mycursor = fireM2db.cursor()

    # Insert the new event:
    sql = """INSERT INTO mmEvent (eventName, latitude, longitude, category, submitMethod) VALUES (%s, %s, %s, %s, %s)"""
    val = (submitName, x, y, eventCategory, submitMethod)
    mycursor.execute(sql, val)
    fireM2db.commit()

    # Get the event ID from the last insertion:
    sql2 = "SELECT LAST_INSERT_ID()"
    mycursor.execute(sql2)
    eventId = mycursor.fetchone()[0]
    fireM2db.commit()

    eventID = eventId

    # Generate the event state:
    sql3 = """INSERT INTO eventState (eventID, updateTime, state) VALUES (%s, %s, %s)"""
    val3 = (eventID, datetime.datetime.utcnow(), "reported")
    mycursor.execute(sql3, val3)
    fireM2db.commit()

    print(mycursor.rowcount, "record inserted.")


def generate_data(eventType, numberOfEvents, radius, eventTime):
    print("Event Type: %s" % eventType)
    print("Number of Events: %d" % numberOfEvents)
    print("Radius: %d" % radius)
    print("Time per Event: %f" % eventTime)

    #bm = Basemap()
    # For testing purposes: to check it coordinates are valid land coordinates.
    # print(bm.is_land(long, lat))

    # Predetermined long and lat of disaster:
    disasterLong = -80.883120
    disasterLat = 37.621608

    i = 0
    count = 1
    coordinateData = []

    while i < numberOfEvents:
        x, y = uniform(disasterLat-radius, disasterLat+radius), uniform(disasterLong-radius, disasterLong+radius)
        # Checking for radius to be within range:
        if disasterLat+radius >= x >= disasterLat-radius and disasterLong+radius >= y >= disasterLong-radius:
            if (1 == 1):
                print(count, x, y)
                coordinate_input = "new google.maps.LatLng(%f, %f)" % (x, y)
                coordinateData.append(coordinate_input)

                # Create call to MySQL Database to insert lat and long
                insert_to_database(x, y, eventType)

                i += 1
                count += 1

                # Sleep for next set of data to generate.
                sleep(eventTime)

    seen = set()
    uniq = [x for x in coordinateData if x not in seen and not seen.add(x)]

    pprint(uniq)
    item_count = len(uniq)
    print("Total items:", item_count)


def main():
    parser = argparse.ArgumentParser(formatter_class=argparse.ArgumentDefaultsHelpFormatter)
    parser.add_argument('--type', default=1, type=str, help='Type of event to occur: Hurricane, Flood, Tsunami, Fire, '
                                                            'Earthquake, Landslide, Sinkhole, Volcano, Tornado, NaturalGas.')
    parser.add_argument('--total_events', default=1, type=int, help='Total number of events to occur (i.e. 100).')
    parser.add_argument('--radius', default=1, type=float, help='Radius in which events occur based on where the disaster is located.')
    parser.add_argument('--time', default=1, type=float, help='How often an event is generated (in seconds).')

    args = parser.parse_args()

    # Parameters
    eventType = args.type
    numOfEvents = args.total_events
    radius = args.radius
    eventTime = args.time

    # 1: Hurricane
    if eventType.startswith("Hurricane") and eventType.endswith("cane"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 2: Flood
    elif eventType.startswith("Flood") and eventType.endswith("lood"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 3: Tsunami
    elif eventType.startswith("Tsunami") and eventType.endswith("nami"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 4: Fire
    elif eventType.startswith("Fire") and eventType.endswith("ire"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 5: Earthquake
    elif eventType.startswith("Earthquake") and eventType.endswith("quake"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 6: Landslide
    elif eventType.startswith("Landslide") and eventType.endswith("slide"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 7: Sinkhole
    elif eventType.startswith("Sinkhole") and eventType.endswith("hole"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 8: Volcano
    elif eventType.startswith("Volcano") and eventType.endswith("cano"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 9: Tornado
    elif eventType.startswith("Tornado") and eventType.endswith("nado"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    # 10: NaturalGas
    elif eventType.startswith("Natural Gas") and eventType.endswith("ural Gas"):
        if numOfEvents > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(eventType, numOfEvents, radius, eventTime)
        else:
            print("Please specify a number greater than 0.")
    else:
        print("Usage --type [type] --total_events [int] --radius [int] --time [float]")
        print("Type was not passed (please note, case sensitive). See usage below:\n")
        print("create_events.py --type Hurricane --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Flood --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Tsunami --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Fire --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Earthquake --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Landslide --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Sinkhole --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Volcano --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type Tornado --total_events [int] --radius [int] --time [float]")
        print("create_events.py --type NaturalGas --total_events [int] --radius [int] --time [float]\n")


if __name__ == '__main__':
    main()
