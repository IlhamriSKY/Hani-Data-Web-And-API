# -*- coding: utf-8 -*-

from __future__ import unicode_literals

# Web based
import requests
import json
import os
import sys
import re
import feedparser

# Web Based
import requests
import json
from urllib.request import urlopen, Request
from bs4 import BeautifulSoup

""" Modules """
# System Based
import errno
import os
import sys
import tempfile
import math
import random
import datetime
import time
import re
from datetime import timedelta
from datetime import datetime
from xml.etree import ElementTree
from random import randint

# UrlLib with version
if sys.version_info[0] > 2:
	import urllib.request as urlreq
else:
	import urllib2 as urlreq

if sys.version_info[0] < 3:
	class urllib:
		parse = __import__("urllib")
		request = __import__("urllib2")
else:
	import urllib.request
	import urllib.parse

# Flask
from argparse import ArgumentParser
from flask import Flask, request, abort, send_from_directory
from werkzeug.middleware.proxy_fix import ProxyFix

app = Flask(__name__)

@app.route("/test", methods=['GET'])
def test():
		return ('ok')

# @app.route("/login/<username>/<raw_password>", methods=['GET'])
# def login(username,raw_password):
# 			SINTAKID_VALIDATE = "http://sintak.unika.ac.id/id/validate.php"
# 			password = raw_password.replace("-","/")
# 			LOGINDATA = {"user": username,"pass": password}	
# 			HEADERS = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36'}

# 			session = requests.Session()
# 			response = session.post(SINTAKID_VALIDATE, data=LOGINDATA, headers=HEADERS)
# 			soup = BeautifulSoup(response.content, 'lxml')
# 			alert = soup.text

# 			if ("ok" in alert):
# 					status = "True"
# 			else:
# 					status = "False"

# 			# Json dumps
# 			var = {
# 			"status": status,
# 			}
					
# 			return(json.dumps(var, sort_keys=False))

# Fatch data entery level
@app.route("/entrylevel", methods=['GET'])
def entrylevel():
			ENDPOINT = "http://www.unika.ac.id/sscc/category/pengumuman/"
			url = urlreq.urlopen(urlreq.Request(ENDPOINT, headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
			udict = url.read().decode('utf-8')
			rawtitels = re.findall('<h4><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
			rawimg = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE) 

			# Listing
			link_list = []
			title_list = []
			date_list = []
			gambar_list = []

			# Looping
			for i in range(0, 9):
						try:
							rawlinks = re.findall('<h4><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
						except Exception as identifier:
							rawlinks = "http://www.unika.ac.id/sscc/2017/10/18/info-lowongan-kerja"

						try:
							rawimgs = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
						except Exception as identifier:
							rawimgs = "https://vanika.tru.io/vanikabot/tandatanya.jpg"

						try:
							rawtitels = re.findall('<a href="'+rawlinks[i+1]+'">(.*?)</a>', udict, re.DOTALL | re.IGNORECASE)
						except Exception as identifier:
							rawtitels = "None"
						
						try:
							rawdate = rawlinks[i+1].replace("http://www.unika.ac.id/sscc/","").split("/")
						except Exception as identifier:
							rawdate = "['2017', '10', '11', 'management-trainee-program-oppo', '']"


						link_list.append(rawlinks[i+1])
						title_list.append(rawtitels[0])
						date_list.append(rawdate[2]+' - '+rawdate[1]+' - '+rawdate[0])
						gambar_list.append(rawimgs[i].replace("http","https"))

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": date_list,
			"images": gambar_list
			}
					
			return(json.dumps(var, sort_keys=False))

# Fatch data mid level
@app.route("/midlevel", methods=['GET'])
def midlevel():
			ENDPOINT = "http://www.unika.ac.id/sscc/category/mid-career/"
			url = urlreq.urlopen(urlreq.Request(ENDPOINT, headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
			udict = url.read().decode('utf-8')
			rawtitels = re.findall('<h4><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
			rawimg = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE)

			# Listing
			link_list = []
			title_list = []
			date_list = []
			gambar_list = []

			for i in range(0, 4):
						rawlinks = re.findall('<h4><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)

						try:
							rawimgs = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
						except Exception as identifier:
							rawimgs = ["https://vanika.tru.io/vanikabot/tandatanya.jpg"]

						try:
							rawtitels = re.findall('<a href="'+rawlinks[i+1]+'">(.*?)</a>', udict, re.DOTALL | re.IGNORECASE)
						except Exception as identifier:
							rawtitels = ["None"]

						try:
							rawdate = rawlinks[i+1].replace("http://www.unika.ac.id/sscc/","").split("/")
						except Exception as identifier:
							rawdate = ['2017', '10', '11', 'management-trainee-program-oppo', '']

						try:
							link_list.append(rawlinks[i+1])
						except Exception as identifier:
							link_list.append("http://www.unika.ac.id/sscc/2017/10/18/info-lowongan-kerja")

						try:
							gambar_list.append(rawimgs[i].replace("http","https"))
						except Exception as identifier:
							gambar_list.append("https://vanika.tru.io/vanikabot/tandatanya.jpg")

						
						title_list.append(rawtitels[0])
						date_list.append(rawdate[2]+' - '+rawdate[1]+' - '+rawdate[0])

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": date_list,
			"images": gambar_list
			}
					
			return(json.dumps(var, sort_keys=False))

# Fatch data campushiring
@app.route("/campushiring", methods=['GET'])
def campushiring():
			ENDPOINT = "http://news.unika.ac.id/category/liputan/campus-hiring-recruitment/"
			url = urlreq.urlopen(urlreq.Request(ENDPOINT, headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
			udict = url.read().decode('utf-8')
			rawlink = re.findall('<h6><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
				
			# Listing
			link_list=[]
			title_list=[]
			publish_list=[]
			gambar_list=[]
			desc_list=[]
			isi_list=[]

			# Upload path
			my_path = "/var/www/html/vanikabot/campushiring"

			# Looping
			for i in range(0, 6):
						url1 = urlreq.urlopen(urlreq.Request(rawlink[i], headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
						udict1 = url1.read().decode('utf-8')
						rawtitels = re.findall('<h6><a href="'+rawlink[i]+'" rel="bookmark" title="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
						rawpublikasi = re.findall('<div class="meta">(.*?)<a', udict, re.DOTALL | re.IGNORECASE)
						publishDate_raw = rawpublikasi[0].replace("Publikasi tanggal ","").replace(" di ","").split(" ")
						publishDate = publishDate_raw[1].replace(",","")+" "+publishDate_raw[0]+" "+publishDate_raw[2]
						rawdes = re.findall('<p>(.*?)<a', udict, re.DOTALL | re.IGNORECASE)
						rawimg = re.findall('src="http://news.unika.ac.id/wp-content/uploads/(.*?)"', udict1, re.DOTALL | re.IGNORECASE)
										
						# ISI BERITA
						raw_publishdate = re.findall('<div class="meta">(.*?)</div>', udict1, re.DOTALL | re.IGNORECASE)
						news = re.findall('<div class="meta">'+raw_publishdate[0]+'</div>(.*?)<div id="komen">', udict1, re.DOTALL | re.IGNORECASE)
						
						try:
							if ('.jpg' in rawimg[0]) or ('.jpeg' in rawimg[0])or ('.png' in rawimg[0]):
									linkimg = ["http://news.unika.ac.id/wp-content/uploads/"+rawimg[0]]
							else:
									linkimg = ["https://vanika.tru.io/vanikabot/tandatanya.jpg"]
						except:
							linkimg = ["https://vanika.tru.io/vanikabot/tandatanya.jpg"]


						# Upload	
						imagename = str(linkimg[0].replace("http://news.unika.ac.id/wp-content/uploads/","").replace("https://vanika.tru.io/vanikabot/imagenews/","").replace(".jpg","").replace(".png",""))
						urllib.request.urlretrieve(linkimg[0], os.path.join(my_path, os.path.basename(imagename+".png")))
										
						link_list.append(rawlink[i])
						title_list.append(rawtitels[0])
						publish_list.append(raw_publishdate[0])
						gambar_list.append("https://vanika.tru.io/vanikabot/campushiring/"+imagename+".png")
						desc_list.append(rawdes[i][:150]+" ...")
						isi_list.append(news[1].split('</a>')[1])

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": publish_list,
			"images": gambar_list,
			"desc": desc_list,
			"isi": isi_list
			}
					
			return(json.dumps(var, sort_keys=False))

# Fatch data unikanews
@app.route("/unikanews", methods=['GET'])
def unikanews():
			ENDPOINT = "http://news.unika.ac.id/?s="
			ENDPOINT_IKOM = "http://news.unika.ac.id/?s=ikom"
			url = urlreq.urlopen(urlreq.Request(ENDPOINT, headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
			udict = url.read().decode('utf-8')
			rawlink = re.findall('<h6><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
				
			# Listing
			link_list=[]
			title_list=[]
			publish_list=[]
			gambar_list=[]
			desc_list=[]
			isi_list=[]

			# Upload path
			my_path = "/var/www/html/vanikabot/imagenews"

			# Looping
			for i in range(0, 5):
						url1 = urlreq.urlopen(urlreq.Request(rawlink[i], headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
						udict1 = url1.read().decode('utf-8')
						rawtitels = re.findall('<h6><a href="'+rawlink[i]+'" rel="bookmark" title="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
						rawpublikasi = re.findall('<div class="meta">(.*?)<a', udict, re.DOTALL | re.IGNORECASE)
						publishDate_raw = rawpublikasi[0].replace("Publikasi tanggal ","").replace(" di ","").split(" ")
						publishDate = publishDate_raw[1].replace(",","")+" "+publishDate_raw[0]+" "+publishDate_raw[2]
						rawdes = re.findall('<p>(.*?)<a', udict, re.DOTALL | re.IGNORECASE)
						rawimg = re.findall('src="http://news.unika.ac.id/wp-content/uploads/(.*?)"', udict1, re.DOTALL | re.IGNORECASE)
										
						# ISI BERITA
						raw_publishdate = re.findall('<div class="meta">(.*?)</div>', udict1, re.DOTALL | re.IGNORECASE)
						news = re.findall('<div class="meta">'+raw_publishdate[0]+'</div>(.*?)<div id="komen">', udict1, re.DOTALL | re.IGNORECASE)
						
						try:
							if ('.jpg' in rawimg[0]) or ('.png' in rawimg[0]):
									linkimg = ["http://news.unika.ac.id/wp-content/uploads/"+rawimg[0]]
							else:
									linkimg = ["https://vanika.tru.io/vanikabot/imagenews/tandatanya.jpg"]
						except:
							linkimg = ["https://vanika.tru.io/vanikabot/imagenews/tandatanya.jpg"]

						
						# Upload				
						imagename = str(linkimg[0].replace("http://news.unika.ac.id/wp-content/uploads/","").replace("https://vanika.tru.io/vanikabot/imagenews/","").replace(".jpg","").replace(".png",""))
						urllib.request.urlretrieve(linkimg[0], os.path.join(my_path, os.path.basename(imagename+".png")))

						link_list.append(rawlink[i])
						title_list.append(rawtitels[0])
						publish_list.append(raw_publishdate[0])
						gambar_list.append("https://vanika.tru.io/vanikabot/imagenews/"+imagename+".png")
						desc_list.append(rawdes[i][:150]+" ...")
						isi_list.append(news[1].split('</a>')[1])

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": publish_list,
			"images": gambar_list,
			"desc": desc_list,
			"isi": isi_list
			}
					
			return(json.dumps(var, sort_keys=False))

# Fatch data ikasoepra
@app.route("/ikasopera", methods=['GET'])
def ikasopera():
			feed = feedparser.parse("http://ikasoepra.org/rss")
			feed_entries = feed.entries

			# Listing
			link_list=[]
			title_list=[]
			tag_list=[]
			publish_list=[]
			gambar_list=[]
			isi_list=[]

			# Looping
			for i in range(0, 5):
						judul = feed_entries[i].title
						url = feed_entries[i].links[0].href
						date = feed_entries[i].published
						tag = feed_entries[i].tags[0].term
						rawimage = feed_entries[i].content[0].value
						rawimage_1 = rawimage.split('alt=""')
						rawimage_2 = rawimage_1[0].split('src="')
						rawimage_3 = rawimage_2[1].replace('"','')
						isi = feed_entries[0].content[0].value
				
						try:
							image = rawimage_3.split("alt")
						except Exception as identifier:
							image = "https://vanika.tru.io/vanikabot/tandatanya.jpg"
										
						link_list.append(url)
						title_list.append(judul)
						publish_list.append(date.replace(" +0000",""))
						gambar_list.append(image.replace("http","https"))
						isi_list.append(isi)

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": publish_list,
			"images": gambar_list,
			"isi": isi_list
			}
					
			return(json.dumps(var, sort_keys=False))

# Fatch data metamorfosa
@app.route("/metamorfosa", methods=['GET'])
def metamorfosa():
			feed = feedparser.parse("http://www.unika.ac.id/metamorfosa/rss")
			feed_entries = feed.entries

			# Listing
			link_list=[]
			title_list=[]
			publish_list=[]
			gambar_list=[]
			desc_list=[]
			isi_list=[]

			# Looping
			for i in range(0, 3):
						try:
							judul = feed_entries[i].title
						except Exception as identifier:
							judul = "None"
						try:
							url = feed_entries[i].links[0].href
						except Exception as identifier:
							url = "www.unika.ac.id/metamorfosa"
						try:
							date = feed_entries[i].published
						except Exception as identifier:
							date = "None"
						try:
							desc = feed_entries[i].summary
						except Exception as identifier:
							desc = "None"
						try:
							isi = feed_entries[i].content[0].value
						except Exception as identifier:
							isi = "None"
						try:
							rawimage = feed_entries[i].content[0].value
						except Exception as identifier:
							pass
						try:
							rawimage_1 = rawimage.split('<img class="')
						except Exception as identifier:
							pass
						try:
							rawimage_2 = rawimage_1[0].split('<a href="')
						except Exception as identifier:
							pass
						try:
							image = rawimage_2[1].replace('">','')
						except Exception as identifier:
							image = "https://vanika.tru.io/vanikabot/tandatanya.jpg"
										
						link_list.append(url)
						title_list.append(judul)
						publish_list.append(date.replace(" +0000",""))
						gambar_list.append(image.replace("http","https"))
						desc_list.append(desc[:150]+" ...")
						isi_list.append(isi)

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": publish_list,
			"images": gambar_list,
			"desc": desc_list,
			"isi": isi_list
			}
					
			return(json.dumps(var, sort_keys=False))

# Fatch data Video News
@app.route("/video", methods=['GET'])
def video():
			feed = feedparser.parse("http://news.unika.ac.id/category/video/rss")
			feed_entries = feed.entries

			# Listing
			link_list=[]
			title_list=[]
			publish_list=[]
			isi_list=[]

			# Looping
			for i in range(0, 5):
						try:
							judul = feed_entries[i].title
						except Exception as identifier:
							judul = "None"
						try:
							url = feed_entries[i].links[0].href
						except Exception as identifier:
							url = "www.unika.ac.id/metamorfosa"
						try:
							date = feed_entries[i].published
						except Exception as identifier:
							date = "None"
						
						rawisi = feed_entries[i].content[0].value
						rawisi_1 = rawisi.split('value="')
						rawisi_2 = rawisi_1[1].split('" />')
						isi = rawisi_2[0].replace("https://www.youtube.com/v/","").replace("https://www.youtube.com/","").replace(';hl=en','')
										
						link_list.append(url)
						title_list.append(judul)
						publish_list.append(date.replace(" +0000",""))
						isi_list.append("http://www.youtube.com/embed/"+isi+"?autoplay=0")

			# Json dumps
			var = {
			"url": link_list,
			"judul": title_list,
			"date": publish_list,
			"isi": isi_list
			}
					
			return(json.dumps(var, sort_keys=False))	 

################
# UNIKA JOB FAIR
################

# Fatch data skpi
@app.route("/skpi/<nim>", methods=['GET'])
def skpi(nim):
			skpi_url_base = "http://sintak.unika.ac.id/krs_skpi_mhs/index_capkid-091118.php?nimidx23425a3234="
			skpi_url_pdf = "http://sintak.unika.ac.id/krs_skpi_mhs/php/pdf/laporan.php"
			HEADERS = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36'}
			my_path = "/var/www/html/vanikabot/skpi/"
			
			NIM = nim.upper()
			URL_BASE = skpi_url_base+NIM
			URL_PDF = skpi_url_pdf

			page = requests.get(URL_BASE)
			soup = BeautifulSoup(page.content, 'html.parser')

			#RAW_DATA
			response = requests.get(URL_PDF)   

			response = urllib.urlopen(URL_PDF)
			file = open(my_path + nim, 'wb')
			file.write(response.read())
			file.close()

			# Json dumps
			var = {
			"nim": NIM,
			"urlpdf": "https://vanika.unika.ac.id/vanikabot/skpi/"+NIM+".pdf",
			}

			return(json.dumps(var, sort_keys=False))
		

if __name__ == "__main__":
		arg_parser = ArgumentParser(
				usage='Usage: python ' + __file__ + ' [--port <port>] [--help]'
		)
		arg_parser.add_argument('-p', '--port', type=int, default=8888, help='port')
		arg_parser.add_argument('-d', '--debug', default=False, help='debug')
		options = arg_parser.parse_args()

		app.run(host='0.0.0.0', debug=options.debug, port=options.port)
