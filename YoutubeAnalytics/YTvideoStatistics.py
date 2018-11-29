import requests,json
def getVideoStatistics(videoId):
	r = requests.get("https://www.googleapis.com/youtube/v3/videos?id="+str(videoId)+"&key=AIzaSyBZGs_NULQpduDZlaseKfLwSBpS5RInsow&part=statistics") 
	data = r.json()
	likes=0
	dislikes=0
	favourites=0
	views=0
	for ele in data["items"]:
		views=ele["statistics"]["viewCount"]
		likes=ele["statistics"]["likeCount"]
		dislikes=ele["statistics"]["dislikeCount"]
		favourites=ele["statistics"]["favoriteCount"]
	return [int(views),int(likes),int(dislikes),int(favourites)]



