import socket
import signal
import sys
import json
import datetime
import time
from threading import Thread

def sigint(signal, frame):
    sys.exit(0)

signal.signal(signal.SIGINT, sigint)

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM, 0)
port = 12345
sock.bind(("", port))

def get_time(unix_time):
    return datetime.datetime.fromtimestamp(unix_time).strftime("%Y-%m-%d %H:%M:%S")

def get_type(type):
    return {
        1: "Normal",
        2: "Error"
    }.get(type, 2)
    

def log_message(obj):
    print(get_time(obj["time"]), get_type(int(obj["type"])), obj["message"])



sock.listen(5)

def handle_connection(client):
    data = client.recv(1024)
    message = json.loads(data.decode("utf-8"))
    log_message(message)

    client.close()

while True:
    client, addr = sock.accept()
    print("New client joined", addr)

    thread = Thread(target = handle_connection, args = (client,))
    thread.start()
