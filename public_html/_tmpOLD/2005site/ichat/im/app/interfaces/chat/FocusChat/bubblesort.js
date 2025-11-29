// Original JavaScript code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

function bubbleSort(parent, childName, colName)
{
  var parent = parent;			// 'parent' node
  var childName = childName;	// nodeName for 'children'
  var colName = colName;		// nodeName for 'columns'

  // build array of 'child' nodes
  var items = parent.getElementsByTagName(childName);
  var N = items.length;

  // define private methods
  var get = function(i, col, wrapper)
  {
    var retval = null;
    var node = null;
    var sort;

    if(colName) {
      // sort by col'th element of i'th child
      node = items[i].getElementsByTagName(colName)[col];
    } else {
      // sort by i'th child
      node = items[i];
    }

    if(null != (sort = node.getAttribute("sort"))) {
      // use 'sort' attribute if available
      retval = sort;
    } else if(node.childNodes.length > 0) {
      if(wrapper) {
        // sort by contents of first 'wrapper' element in 'child'
        retval = node.getElementsByTagName(wrapper)[0].firstChild.nodeValue;
      } else {
        // sort by 'child' contents
        retval = node.firstChild.nodeValue;
      }
    } else {
      return "";
    }

    if(parseFloat(retval) == retval) return parseFloat(retval);
    return retval;
  }

  var compare = function(val1, val2, desc)
  {
    return (desc) ? val1 > val2 : val1 < val2;
  }

  var exchange = function(i, j)
  {
    parent.insertBefore(items[i], items[j]);
  }

  // define public method
  this.sort = function(col, desc, wrapper)
  {
    for(var j=N-1; j > 0; j--) {
      for(var i=0; i < j; i++) {
        if(compare(get(i+1, col, wrapper), get(i, col, wrapper), desc)) {
          exchange(i+1, i);
        }
      }
    }
  }
}
