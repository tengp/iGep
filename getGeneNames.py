import sqlite3
import sys
def _getGeneNames(UDID):
    names=[]

    db=sqlite3.connect('/home/annotation/htdocs/text_mining/doc/pan/path/Reactome.db')
    cursor=db.cursor()
    cursor.execute('''
        select * from UDGenes where UDID=?
        ''',(UDID,))
    user1=cursor.fetchone()
    if user1:
        shortName= str(user1[1])
        otherShortNames=str(user1[3])
        names.append(shortName)
        names.extend(otherShortNames.split(" | "))
        print ";".join(names)
            # all_rows=cursor.fetchall()
        # for row in all_rows:
        #     print ('{0} : {1}, {2}'.format(row[0], row[1], row[2]))
        #     print "hello"
    # else:
    #     print "No result found. please try another."
    db.commit()
    db.close()
A=sys.argv[1]
# B=sys.argv[2]
_getGeneNames(A)
# _getGeneNames(A)+";"+_getGeneNames(B)

# result=A_result.extend(_getGeneNames(B))
# print result