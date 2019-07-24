#!/user/bin/python3
from picamera.array import PiRGBArray
from picamera import PiCamera
from utils import send_email, TempImage, clean_up, ftp_up
from request import request
from timeit import default_timer as timer
import argparse
import warnings
import datetime
import json
import time
import cv2
import os
import sys
import threading
from time import sleep

request()
# load some config
with open('conf.json') as json_file:
    conf = json.load(json_file)


# initialize the camera
camera = PiCamera()
camera.resolution = tuple(conf["resolution"])
camera.framerate = conf["fps"]
rawCapture = PiRGBArray(camera, size=tuple(conf["resolution"]))
print("[INFO] warming up...")
time.sleep(conf["camera_warmup_time"])
avg = None
lastUploaded = datetime.datetime.now()
motionCounter = 0


# capture frames from the camera
for f in camera.capture_continuous(rawCapture, format="bgr", use_video_port=True):
    # grab the raw NumPy array representing the image and initialize
    # the timestamp and occupied/unoccupied text
    frame = f.array
    timestamp = datetime.datetime.now()
    text = "Unoccupied"
    rawCapture.truncate(0)
    #
    # COMPUTER VISION
    #
    # resize the frame, convert it to grayscale, and blur it
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    gray = cv2.GaussianBlur(gray, tuple(conf['blur_size']), 0)

    # if the average frame is None, initialize it
    if avg is None:
        print ("[INFO] starting background model...")
        avg = gray.copy().astype("float")
        rawCapture.truncate(0)
        continue

    # accumulate the weighted average between the current frame and
    # previous frames, then compute the difference between the current
    # frame and running average

    frameDelta = cv2.absdiff(gray, cv2.convertScaleAbs(avg))
    cv2.accumulateWeighted(gray, avg, 0.5)

# threshold the delta image, dilate the thresholded image to fill
    # in holes, then find contours on thresholded image
    thresh = cv2.threshold(frameDelta, conf["delta_thresh"], 255,
                           cv2.THRESH_BINARY)[1]
    thresh = cv2.dilate(thresh, None, iterations=2)
    im2, cnts, _ = cv2.findContours(thresh.copy(), cv2.RETR_EXTERNAL,
                                    cv2.CHAIN_APPROX_SIMPLE)

    # loop over the contours
    for c in cnts:
        # if the contour is too small, ignore it
        if cv2.contourArea(c) < conf["min_area"]:
            continue

        # compute the bounding box for the contour, draw it on the frame,
        # and update the text
        (x, y, w, h) = cv2.boundingRect(c)
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)
        text = "Occupied"

    #
    # LOGIC
    #

    # check to see if the room is occupied
    if text == "Occupied":
        # save occupied frame
        unix_epoch = time.time()
                               # the popular UNIX epoch time in seconds
        ts = datetime.datetime.fromtimestamp(unix_epoch)

        cv2.imwrite("eye_{}.jpg".format(ts), frame)
        
        # check to see if enough time has passed between uploads
        if (timestamp - lastUploaded).seconds >= conf["min_upload_seconds"]:

            # increment the motion counter
            motionCounter += 1
           
            # check to see if the number of frames with consistent motion is
            # high enough
            if motionCounter >= int(conf["min_motion_frames"]):

                with open('conf.json') as json_file:
                    conf2 = json.load(json_file)
                #ftp count
                    ftpCount=0
                # send an email if enabled
                if(conf2["device_mode_email"]==1):
                    
                    print("[INFO] Sending an alert email!!!")
                    send_email(conf)
                    if((conf2["device_mode_pic"]) == 1):
                        ftp_up()
                        ftpCount=1;
                        clean_up()
                    else:
                        clean_up()
                        
                if((conf2['device_mode_pic']==1) & (ftpCount==0)):
                    print("[ftping]....")
                    ftp_up()
                    clean_up()
                    
                    print("[INFO] waiting {} seconds...".format(
                        conf["camera_warmup_time"]))
                    time.sleep(conf["camera_warmup_time"])
                    print("[INFO] running")
                    
                    print(conf2['device_mode_pic'])
                    print(ftpCount)
                    
               
                # update the last uploaded timestamp and reset the motion
                # counter
                lastUploaded = timestamp
                motionCounter = 0
                clean_up()
                request()
                print("hi from reset")
    # otherwise, the room is not occupied
    else:
        motionCounter = 0
        
