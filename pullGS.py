#!/usr/bin/env python
import oauth2 as oauth
import simplejson as json
import urllib
#Set the credentials here
'''
consumer = oauth.Consumer(key='9c528f5ba470e0da2dcdc72ae12318f704d8d2da3',secret='97b58cafaff8335942ae5da08712c4ec')

client = oauth.Client(consumer)


url = 'http://qa.generalsentiment.com:8080/api/v1/getSentiment?entityName=USA&startDate=20100101&endDate=20100103'
method= 'GET'
response,content = client.request(url,method)
print content
'''
def pullGS(startTime, endTime, phrase):
	print startTime
	print phrase
	phrase2 = ''
	for c in phrase:
		if c.isalpha or c == ' ':
			phrase2 += c
			
	print phrase2
	consumer = oauth.Consumer(key='9c528f5ba470e0da2dcdc72ae12318f704d8d2da3',secret='97b58cafaff8335942ae5da08712c4ec')
	client = oauth.Client(consumer)
	url = 'http://qa.generalsentiment.com:8080/api/v1/getSentiment?entityName=' + phrase2 + '&startDate=' + startTime + '&endDate=' + endTime
	print url
	#url2 = 'http://qa.generalsentiment.com:8080/api/v1/getSentiment?entityName=USA&startDate=20100101&endDate=20100103'
	#print url2
	method= 'GET'
	response,content = client.request(url,method)
	content = json.loads(content);
	
	value = content['results']
	d = {}
	for i in value:
		d["word"] = phrase
		d["volume"] = i['references']
		d["sentiment"] = i['sentiment']
		
	#print value
	return d

#pullGS('20101010', '20101010', 'USA')


