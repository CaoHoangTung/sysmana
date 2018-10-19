#!/usr/bin/python
#-*- coding: utf-8 -*-

import requests, re, sys

f = open('C:/Users/DELL7470/Desktop/work/sub_proj/public/input.txt','r')
id = f.read()
url = id
idre = re.compile('"entity_id":"([0-9]+)"')
page = requests.get(url)
id_user =idre.findall(page.content)
f1 = open('C:/Users/DELL7470/Desktop/work/sub_proj/public/output.txt','w')
str1 = ''.join(str(e) for e in id_user)
f1.write(id_w)
f1.close()