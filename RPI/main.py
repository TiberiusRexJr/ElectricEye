#!/user/bin/python3
from picamera.array import PiRGBArray
from picamera import PiCamera
from utils import send_email, TempImage, clean_up, ftp_up
from security1 import master
from request import request
import argparse
import warnings
import datetime
import json
import time
import cv2
import os
from time import sleep
import threading


    
def master():
    reg=request()
    if(reg==1):          
        exec(open("security1.py").read())
    if(reg==0):
        master()



sleep(15)
master()
