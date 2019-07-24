import json
import smtplib
import uuid
import os
import ftplib
import glob

from os.path import basename
from email.mime.application import MIMEApplication
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.utils import COMMASPACE, formatdate


class TempImage:
	def __init__(self, basePath="./", ext=".jpg"):
		# construct the file path
		self.path = "{base_path}/{rand}{ext}".format(base_path=basePath,
			rand=str(uuid.uuid4()), ext=ext)

	def cleanup(self):
		# remove the file
		print(self.path)
		os.remove(self.path)


def send_email(conf):
    #fromaddr = "rouninlopez@gmail.com" 
    for email_address in conf['email_address']:
        toaddrs  = email_address
        
        username=email_address
    
    with open('conf.json') as json_file:
        conf = json.load(json_file)
        fromaddr=conf['device_name']
        
        print("[INFO] Emailing to {}".format(email_address))
        text = "Movement Detected"
        subject = fromaddr+": Motion Detected"
        message = 'Subject: {}\n\n{}'.format(subject, text)

        msg = MIMEMultipart()
        msg['From'] = fromaddr+"@electricEye"
        msg['To'] = toaddrs
        msg['Date'] = formatdate(localtime=True)
        msg['Subject'] = subject
        msg.attach(MIMEText(text))

        # set attachments
        files = glob.glob("eyeData/eye_*")
        print("[INFO] Number of images attached to email: {}".format(len(files)))
        for f in files:
            with open(f, "rb") as fil:
                part = MIMEApplication(
                    fil.read(),
                    Name=basename(f)
                )
                part['Content-Disposition'] = 'attachment; filename="%s"' % basename(f)
                msg.attach(part)
        with open('conf.json') as f:
            data=json.load(f)
            password=data["user_gmail_password"]
        
        print('HI FROM EMAIL EAMIL')
        #clean_up()
    
        # The actual mail send
        server = smtplib.SMTP('smtp.gmail.com:587')
        server.starttls()
        server.login(username,password)
        server.sendmail(fromaddr, toaddrs, msg.as_string())
        server.quit()
        



def send_mail(conf, files=None,
              ):
    assert isinstance(send_to, list)

    msg = MIMEMultipart()
    msg['From'] = send_from
    msg['To'] = COMMASPACE.join(send_to)
    msg['Date'] = formatdate(localtime=True)
    msg['Subject'] = subject

    msg.attach(MIMEText(text))



    smtp = smtplib.SMTP(server)
    smtp.sendmail(send_from, send_to, msg.as_string())
  
    smtp.close()
    
    
def clean_up():
    print("hi inside cleanup now")
    #mydir="eyeData/"
    #mydirOrigin="/home/pi/Desktop/Eye"
    #os.chdir(mydir)
    files=glob.glob('*.jpg')
    for filename in files:
        os.unlink(filename)
        
    #os.chdir(mydirOrigin)
        
def ftp_up():
    print("ftp up is in")
    #mydir="eyeData/"
    #mydirOrigin="/home/pi/Desktop/Eye"
    with open('conf.json') as f:
            data=json.load(f)
            ftpDir=data['user_pic_folder']
            
    
    ftp=ftplib.FTP('ftp.irasai.com')
    ftp.login("electricEye@irasai.com","Magicdragon777!")
    ftp.cwd(ftpDir)
    ftp.pwd()
    #os.chdir(mydir)
    files=glob.glob('*.jpg')
    for filename in files:
        print(filename)
        ftp.storbinary('STOR'+" "+filename, open(filename,'rb'))
    
    ftp.close()
    #os.chdir(mydirOrigin)

