import feedparser
import webbrowser

feed = feedparser.parse("http://news.unika.ac.id/category/video/rss")
feed_entries = feed.entries

judul = feed_entries[0].title
url = feed_entries[0].links[0].href
date = feed_entries[0].published
rawisi = feed_entries[0].content[0].value
rawisi_1 = rawisi.split('value="')
isi = rawisi_1[1].split('" />')

#print(judul)
#print(url)
#print(date)
print(isi[0])
