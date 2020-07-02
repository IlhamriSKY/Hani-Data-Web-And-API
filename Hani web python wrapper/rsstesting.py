import feedparser
import webbrowser

feed = feedparser.parse("http://ikasoepra.org/rss")

# feed_title = feed['feed']['title']  # NOT VALID
feed_entries = feed.entries

judul = feed_entries[0].title
url = feed_entries[0].links[0].href
date = feed_entries[0].published
tag = feed_entries[0].tags[0].term
rawimage = feed_entries[0].content[0].value
rawimage_1 = rawimage.split('alt=""')
rawimage_2 = rawimage_1[0].split('src="')
image = rawimage_2[1].replace('"','')
isi = feed_entries[0].content[0].value


for i in range(0,5):
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


    print(image[0])

    
