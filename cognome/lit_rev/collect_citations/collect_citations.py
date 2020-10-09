from scholarly import scholarly
import sys

title = sys.argv[1]

# collect citations
search_query = scholarly.search_pubs(title)
pub = next(search_query)
citations = pub.bib['cites']
year = pub.bib['year']
print("%s,%s" % (citations, year))
