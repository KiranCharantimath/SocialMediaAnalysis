import requests,json
def getVideoComments(videoId):
	r = requests.get("https://www.googleapis.com/youtube/v3/commentThreads?key=AIzaSyBZGs_NULQpduDZlaseKfLwSBpS5RInsow&textFormat=plainText&part=snippet&videoId="+str(videoId)+"&maxResults=50") 
	data = r.json()
	print(str(json.dumps(r.json(), indent=4)))
	comments=[]
	for ele in data["items"]:
		comments.append(ele["snippet"]["topLevelComment"]["snippet"]["textDisplay"])
	return comments


print(getVideoComments("lEod3-90p4s"))
