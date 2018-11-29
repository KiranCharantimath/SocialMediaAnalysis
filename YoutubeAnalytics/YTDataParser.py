from YTComments_video import *
from sentimentAnalysis import *
from YTvideoStatistics import *
import io
import random
import json
f = open('Youtube_id_title_date.txt', 'r+')
lines = [line for line in f.readlines()]
f.close()
new_line=[0]
for line in lines:
	new_line.append(line)
count=1
YT_Json={}
YT_Json["title"]=[]
YT_Json["id"]=[]
YT_Json["comments"]=[]
YT_Json["published_date"]=[]
YT_Json["singers"]=[]
YT_Json["views"]=[]
YT_Json["likes"]=[]
YT_Json["dislikes"]=[]
YT_Json["favourites"]=[]
YT_Json["channel"]=[]
YT_Json["url"]=[]
video_title = new_line[1::5]
video_id = new_line[2::5]
date = new_line[3::5]
channel = new_line[4::5]
url = new_line[5::5]

whitelist = set('abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789')
for i in url:
	YT_Json["url"].append(i.replace("\n",""))
for i in channel:
	YT_Json["channel"].append(i.replace("\n",""))
for i in video_title:
	YT_Json["title"].append(i.replace("\n","").split("|")[0])
	YT_Json["singers"].append(i.replace("\n","").split("|")[1:])
for i in video_id:
	YT_Json["id"].append(i.replace("\n",""))
	v,l,d,f=getVideoStatistics(i.replace("\n",""))
	YT_Json["views"].append(int(v))
	YT_Json["likes"].append(int(l))
	YT_Json["dislikes"].append(int(d))
	YT_Json["favourites"].append(int(f))
	comment_list=getVideoComments(i.replace("\n",""))
	print(comment_list)
	Positive=0
	negative=0
	neutral=0
	for comment in comment_list:
		answer=''.join(filter(whitelist.__contains__, comment))
		#x=sentiment_analyse(answer)
		x=random.randint(-1,2)
		if x == -1:
			negative+=1
		if x == 1:
			Positive+=1
		else:
			neutral+=1
	YT_Json["comments"].append([int(Positive),int(neutral),int(negative)])

for i in date:
	YT_Json["published_date"].append(i.replace("\n",""))	

for i in YT_Json["id"]:
	print(i+"\n")

with open('YoutubeAllData.json', 'w') as outfile:  
    json.dump(YT_Json, outfile)
