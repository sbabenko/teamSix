import argparse
from pprint import pprint
from time import sleep
from mpl_toolkits.basemap import Basemap
from random import uniform


def generate_data(event_type, number_of_events, radius, event_time):
    print("Event Type: ", event_type)
    print("Number of Events: ", number_of_events)
    print("Radius: ", radius)
    print("Time per Event: ", event_time)

    bm = Basemap()
    # print(bm.is_land(long, lat))

    # Predetermined long and lat of disaster:
    disaster_long = -80.883120
    disaster_lat = 37.621608

    i = 0
    count = 1
    coordinate_data = []

    while i < number_of_events:
        x, y = uniform(disaster_lat-radius, disaster_lat+radius), uniform(disaster_long-radius, disaster_long+radius)
        print("x", x)
        print("y", y)
        # Checking for radius to be within range:
        if disaster_lat + radius >= x >= disaster_lat - radius and disaster_long + radius >= y >= disaster_long - radius:
            if bm.is_land(y, x):
                print(count, x, y)
                coordinate_input = "new google.maps.LatLng(%f, %f)" % (x, y)
                print("Coordinate Data:", coordinate_input)
                coordinate_data.append(coordinate_input)

                i += 1
                count += 1

                # Sleep for next set of data to generate.
                sleep(event_time)

    seen = set()
    uniq = [x for x in coordinate_data if x not in seen and not seen.add(x)]

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
    event_type = args.type
    num_of_events = args.total_events
    radius = args.radius
    event_time = args.time

    # 1: Hurricane
    if event_type.startswith("Hurricane") and event_type.endswith("cane"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 2: Flood
    elif event_type.startswith("Flood") and event_type.endswith("lood"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 3: Tsunami
    elif event_type.startswith("Tsunami") and event_type.endswith("nami"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 4: Fire
    elif event_type.startswith("Fire") and event_type.endswith("ire"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 5: Earthquake
    elif event_type.startswith("Earthquake") and event_type.endswith("quake"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 6: Landslide
    elif event_type.startswith("Landslide") and event_type.endswith("slide"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 7: Sinkhole
    elif event_type.startswith("Sinkhole") and event_type.endswith("hole"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 8: Volcano
    elif event_type.startswith("Volcano") and event_type.endswith("cano"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 9: Tornado
    elif event_type.startswith("Tornado") and event_type.endswith("nado"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    # 10: NaturalGas
    elif event_type.startswith("NaturalGas") and event_type.endswith("uralGas"):
        if num_of_events > 0:
            print("Starting to generate", args.type, "data.")
            generate_data(event_type, num_of_events, radius, event_time)
        else:
            print("Please specify a number greater than 0.")
    else:
        print("Usage --type [type] --total_events [num]")
        print("Type was not passed (please note, case sensitive). Please see usage below:\n")
        print("create_events.py --type Hurricane --total_events [num]")
        print("create_events.py --type Flood --total_events [num]")
        print("create_events.py --type Tsunami --total_events [num]")
        print("create_events.py --type Fire --total_events [num]")
        print("create_events.py --type Earthquake --total_events [num]")
        print("create_events.py --type Landslide --total_events [num]")
        print("create_events.py --type Sinkhole --total_events [num]")
        print("create_events.py --type Volcano --total_events [num]")
        print("create_events.py --type Tornado --total_events [num]")
        print("create_events.py --type NaturalGas --total_events [num]\n")


if __name__ == '__main__':
    main()
