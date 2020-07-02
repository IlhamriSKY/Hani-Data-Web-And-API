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

ENDPOINT = "http://www.unika.ac.id/sscc/category/mid-career/"
url = urlreq.urlopen(urlreq.Request(ENDPOINT, headers={'User-Agent': "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)"}))
udict = url.read().decode('utf-8')
rawtitels = re.findall('<h4><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
rawimg = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE)

# Listing
link_list = []
title_list = []
tanggal_list = []
bulan_list = []
tahun_list = []
gambar_list = []

for i in range(0, 2):
    rawlinks = re.findall('<h4><a href="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
    rawimgs = re.findall('<img class="img-responsive" src="(.*?)"', udict, re.DOTALL | re.IGNORECASE)
    rawtitels = re.findall('<a href="'+rawlinks[i+1]+'">(.*?)</a>', udict, re.DOTALL | re.IGNORECASE)
    rawdate = rawlinks[i+1].replace("http://www.unika.ac.id/sscc/","").split("/")
    date = rawdate[2]+' '+rawdate[1]+' '+rawdate[0]

    link_list.append(rawlinks[i+1])
    title_list.append(rawtitels[0])
    tanggal_list.append(rawdate[2])
    bulan_list.append(rawdate[1])
    tahun_list.append(rawdate[0])
    gambar_list.append(rawimgs[i])

    # Json dumps
    var = {
    "url": link_list,
    "judul": title_list,
    "publishDate": {
        "tanggal": tanggal_list,
        "bulan": bulan_list,
        "tahun": tahun_list
    },
    "images": gambar_list
    }

print(json.dumps(var, sort_keys=False))
print(rawdate)
