import feedparser
import webbrowser

feed = feedparser.parse("http://www.unika.ac.id/metamorfosa/rss")

# feed_title = feed['feed']['title']  # NOT VALID
feed_entries = feed.entries
judul = feed_entries[0].title
url = feed_entries[0].links[0].href
date = feed_entries[0].published
desc = feed_entries[0].summary
isi = feed_entries[0].content[0].value
rawimage = feed_entries[0].content[0].value
rawimage_1 = rawimage.split('<img class="')
rawimage_2 = rawimage_1[0].split('<a href="')
image = rawimage_2[1].replace('">','')

for i in range(0,5):
    print(judul)
#print(url)
#print(desc[:150]+" ...")
#print()
