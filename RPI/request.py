#!/user/bin/python3
import requests
import json
import threading
import os

value=0;

def getserial():
  # Extract serial from cpuinfo file
  cpuserial = "0000000000000000"
  try:
    f = open('/proc/cpuinfo','r')
    for line in f:
      if line[0:6]=='Serial':
        cpuserial = line[10:26]
    f.close()
  except:
    cpuserial = "ERROR000000000"

  return cpuserial


def request():
    threading.Timer(20.0, request).start() # called every minute
    headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}
    URL="http://irasai.com/ElectricEye/api/serialCheck_1.php"
    SERIAL=getserial();
    data={"serial":SERIAL}
    r = requests.post(URL, data=json.dumps(data), headers=headers)
    
    data=r.json();
    print(data)
    #mydirOrigin="/home/pi/Desktop/Eye"
    #os.chdir(mydirOrigin)
    with open('conf.json', 'r') as jsonFile:
        conf=json.load(jsonFile)
    if(data['registered']=='true'):
        conf['user_gmail_password']=data['user_gmail_password']
        conf['user_gmail_address']=data['user_gmail_address']
        conf['user_pic_folder']=data['user_pic_folder']
        conf['device_mode_pic']=int(data['device_mode_pic'])
        conf['device_mode_email']=int(data['device_mode_email'])
        conf['use_email']==int(data['device_mode_email'])
        conf['registered']=1
        conf['device_status']=1
        conf['device_name']=data['device_name']
        with open("conf.json","w") as jsonFile:
            json.dump(conf,jsonFile)
    else:
        conf['registered']=0
        conf['device_status']=0
        print("not registered")
        with open("conf.json","w") as jsonFile:
            json.dump(conf,jsonFile)
            
        if(conf['registered']==1):
            value=1;
        
       
        return value
        





    




              

