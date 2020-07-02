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

print(rawlink)
