# -*- coding: utf-8 -*-
from __future__ import unicode_literals

#web based
import requests
import json
import os
import sys
import re
from bs4 import BeautifulSoup

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

HEADERS = {
        'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36'
}

SINTAKID_VALIDATE = 'http://sintak.unika.ac.id/id/validate.php'
SINTAK_URL_ESERTIFIKAT = 'http://sintak.unika.ac.id/esertifikat/'

LOGINDATA = {
    "user": "15.N1.0012",
    "pass": "21/10/1991"
}    

HEADERS = HEADERS
URL_BASE = SINTAKID_VALIDATE
session = requests.Session()
response = session.post(URL_BASE, data=LOGINDATA, headers=HEADERS)
soup = BeautifulSoup(response.content, 'lxml')
alert = soup.text

if ("ok" in alert):
    print("True")
else:
    print("False")
