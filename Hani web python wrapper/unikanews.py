# -*- coding: utf-8 -*-

# Web based
import requests
import json
import os
import sys
import re

# UrlLib with versionrawimgs = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
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


ENDPOINT = "http://news.unika.ac.id/?s="
ENDPOINT_IKOM = "http://news.unika.ac.id/?s=ikom"

url = urlreq.urlopen(urlreq.Request(ENDPOINT, headers={
                    'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
udict = url.read().decode('utf-8')
rawlink = re.findall('<h6><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)

for i in range(0, 1):
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

    #print(rawlink[i])
    #print(rawtitels)
    #print(raw_publishdate[0])
    #print(linkimg)
    print(rawimg)
    #print(news[1].split('</a>')[1])
    #print(news[1].split('</a>')[1])
