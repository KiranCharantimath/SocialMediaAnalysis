from YTvideoStatistics import *
from YTComments_video import *
from sentimentAnalysis import *
import io
import json
f = open('Youtube_id_title_date.txt', 'r+')
lines = [line for line in f.readlines()]
f.close()
new_line=[0]
for line in lines:
	new_line.append(line)
YT_Json={}
YT_Json["comments"]=[]
video_title = new_line[1::3]
video_id = new_line[2::3]
date = new_line[3::3]
whitelist = set('abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789')
for i in video_id:
	print(i.replace("\n",""))
	comment_list=getVideoComments(i.replace("\n",""))
	print(comment_list)
	Positive=0
	negative=0
	neutral=0
	for comment in comment_list:
		answer=''.join(filter(whitelist.__contains__, comment))
		x=sentiment_analyse(answer)
		if x == -1:
			negative+=1
		if x == 1:
			Positive+=1
		else:
			neutral+=1
	YT_Json["comments"].append([int(Positive),int(neutral),int(negative)])

for x in YT_Json["comments"]:
	print(x)
	print("\n")