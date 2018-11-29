import requests,json
#UCn4rEMqKtwBQ6-oEwbd4PcA for south
#UC3MLnJtqc_phABBriLRhtgQ for bollywood
r = requests.get("https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCn4rEMqKtwBQ6-oEwbd4PcA&order=date&publishedAfter=2018-4-26T21:50:00Z&key=AIzaSyBZGs_NULQpduDZlaseKfLwSBpS5RInsow&maxResults=50")
file = open('YTjson.json','w') 
file.write(str(json.dumps(r.json(), indent=4)))
file.close() 
data = r.json()
video_id=[]
published_date=[]
video_title=[]
channel_title=[]
i=0
nextToken="something"
YTfile = open('Youtube_id_title_date.txt','w')
while(i<6):
	for ele in data["items"]:
		try:
			ele["id"]["videoId"]
		except:
			continue
		print(ele["id"]["videoId"])
		print(ele["snippet"]["publishedAt"])
		print(ele["snippet"]["title"])
		print(ele["snippet"]["channelTitle"])
		YTfile.write(ele["snippet"]["title"])
		YTfile.write("\n")
		YTfile.write(ele["id"]["videoId"])
		YTfile.write("\n")
		YTfile.write(ele["snippet"]["publishedAt"])
		YTfile.write("\n")
		YTfile.write(ele["snippet"]["channelTitle"])
		YTfile.write("\n")
		YTfile.write(ele["snippet"]["thumbnails"]["medium"]["url"])
		YTfile.write("\n")
		video_id.append(ele["id"]["videoId"])
		published_date.append(ele["snippet"]["publishedAt"])
		video_title.append(ele["snippet"]["title"])
		channel_title.append(ele["snippet"]["channelTitle"])
	nextToken=data["nextPageToken"]
	r = requests.get("https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCn4rEMqKtwBQ6-oEwbd4PcA&order=date&publishedAfter=2018-4-26T21:50:00Z&key=AIzaSyBZGs_NULQpduDZlaseKfLwSBpS5RInsow&maxResults=50"+"&pageToken="+str(nextToken))
	file = open('YTjson.json','a')
	file.write(str(json.dumps(r.json(), indent=4)))
	file.close() 
	data=r.json()
	i=i+1
print(video_id)
print(video_title)
