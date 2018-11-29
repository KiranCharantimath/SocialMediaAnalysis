from os import path
from pydub import AudioSegment
import glob
import pandas as pd
import os
import numpy as np

path = '/home/kiran/Desktop/Songs'
for filename in glob.glob(os.path.join(path, '*.mp3')):
	src=filename
	song_name=filename.split("/")[5]
	song_title=song_name.split("-")[1]
	dst="/home/kiran/data/"+song_title+".wav"
	sound = AudioSegment.from_mp3(src)
	sound.export(dst, format="wav")

path = '/home/kiran/data'

OldRange = (1000 - 1)  
NewRange = (10 - 1)  
Y=[101,117,413,314,232,151,326,25,641,9,160,157]
Y=[round((((OldValue - 1) * NewRange) / OldRange) + 1,2) for OldValue in Y]
print(Y)

X=[]

for filename in sorted(glob.glob(os.path.join(path, '*.wav_st.csv'))):
	print(filename)
	df=pd.read_csv(filename,header=None)
	df=df[0:3689]
	a=df.as_matrix()
	a=a.flatten()
	numpy_array=np.array(a)
	X.append(numpy_array)

X=np.array(X)

from sklearn.linear_model import LinearRegression
reg = LinearRegression().fit(X, Y)
print(reg.score(X, Y))



