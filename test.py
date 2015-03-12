import os
import sys
import re


def _getSTID(UDID):
    STIDlist=[]
    srcdir="/home/TextMining/eGIFTResults/TermIndexing/%s.termindex" %(UDID)
    try:
      with open(srcdir) as f:
        for line in f:
            line=line.split("~@~")
            STID=line[1].replace("\n","").split(", ")
            
            for i in STID:
                if i!="":
                    if i not in STIDlist:
                        STIDlist.append(i)

        return STIDlist
    except IOError as e:
        print "I/O error({0}): {1}".format(e.errno, e.strerror)
        print "No result found. Please try another one."
def _getIntersect(UDID1,UDID2):

    STID1=_getSTID(UDID1)
    STID2=_getSTID(UDID2)
    if STID1 and STID2:
        intersection= list(set(STID1)&set(STID2))
        return intersection
    else:
        return

A=sys.argv[1]
B=sys.argv[2]
if (_getIntersect(A,B)):
    print ";".join(_getIntersect(A,B))
# result=";".join(_getIntersect(A,B))

