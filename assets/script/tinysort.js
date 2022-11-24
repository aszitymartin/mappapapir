/**
 * TinySort is a small script that sorts HTML elements. It sorts by text- or attribute value, or by that of one of it's children.
 * @summary A nodeElement sorting script.
 * @version 2.3.0
 * @license MIT
 * @author Ron Valstar <ron@ronvalstar.nl>
 * @copyright Ron Valstar <ron@ronvalstar.nl>
 * @namespace tinysort
 */
 !function(a,b){"use strict";function c(){return b}"function"==typeof define&&define.amd?define("tinysort",c):a.tinysort=b}(this,function(){"use strict";/**
 * TinySort is a small and simple script that will sort any nodeElment by it's text- or attribute value, or by that of one of it's children.
 * @memberof tinysort
 * @public
 * @param {NodeList|HTMLElement[]|String} nodeList The nodelist or array of elements to be sorted. If a string is passed it should be a valid CSS selector.
 * @param {Object} [options] A list of options.
 * @param {String} [options.selector] A CSS selector to select the element to sort to.
 * @param {String} [options.order='asc'] The order of the sorting method. Possible values are 'asc', 'desc' and 'rand'.
 * @param {String} [options.attr=null] Order by attribute value (ie title, href, class)
 * @param {String} [options.data=null] Use the data attribute for sorting.
 * @param {String} [options.place='org'] Determines the placement of the ordered elements in respect to the unordered elements. Possible values 'start', 'end', 'first', 'last' or 'org'.
 * @param {Boolean} [options.useVal=false] Use element value instead of text.
 * @param {Boolean} [options.cases=false] A case sensitive sort (orders [aB,aa,ab,bb])
 * @param {Boolean} [options.natural=false] Use natural sort order.
 * @param {Boolean} [options.forceStrings=false] If false the string '2' will sort with the value 2, not the string '2'.
 * @param {Boolean} [options.ignoreDashes=false] Ignores dashes when looking for numerals.
 * @param {Function} [options.sortFunction=null] Override the default sort function. The parameters are of a type {elementObject}.
 * @param {Boolean} [options.useFlex=true] If one parent and display flex, ordering is done by CSS (instead of DOM)
 * @param {Boolean} [options.emptyEnd=true] Sort empty values to the end instead of the start
 * @returns {HTMLElement[]}
 */
function a(a,d){/**
     * Create criteria list
     */
function h(){0===arguments.length?q({}):b(arguments,function(a){q(B(a)?{selector:a}:a)}),n=I.length}/**
     * A criterium is a combination of the selector, the options and the default options
     * @typedef {Object} criterium
     * @property {String} selector - a valid CSS selector
     * @property {String} order - order: asc, desc or rand
     * @property {String} attr - order by attribute value
     * @property {String} data - use the data attribute for sorting
     * @property {Boolean} useVal - use element value instead of text
     * @property {String} place - place ordered elements at position: start, end, org (original position), first
     * @property {Boolean} returns - return all elements or only the sorted ones (true/false)
     * @property {Boolean} cases - a case sensitive sort orders [aB,aa,ab,bb]
     * @property {Boolean} natural - use natural sort order
     * @property {Boolean} forceStrings - if false the string '2' will sort with the value 2, not the string '2'
     * @property {Boolean} ignoreDashes - ignores dashes when looking for numerals
     * @property {Function} sortFunction - override the default sort function
     * @property {boolean} hasSelector - options has a selector
     * @property {boolean} hasFilter - options has a filter
     * @property {boolean} hasAttr - options has an attribute selector
     * @property {boolean} hasData - options has a data selector
     * @property {number} sortReturnNumber - the sort function return number determined by options.order
     */
/**
     * Adds a criterium
     * @memberof tinysort
     * @private
     * @param {Object} [options]
     */
function q(a){var b=!!a.selector,d=b&&":"===a.selector[0],e=c(a||{},p);I.push(c({
// has find, attr or data
hasSelector:b,hasAttr:!(e.attr===g||""===e.attr),hasData:e.data!==g,hasFilter:d,sortReturnNumber:"asc"===e.order?1:-1},e))}/**
     * The element object.
     * @typedef {Object} elementObject
     * @property {HTMLElement} elm - The element
     * @property {number} pos - original position
     * @property {number} posn - original position on the partial list
     */
/**
     * Creates an elementObject and adds to lists.
     * Also checks if has one or more parents.
     * @memberof tinysort
     * @private
     */
function r(){b(a,function(a,b){D?D!==a.parentNode&&(J=!1):D=a.parentNode;var c=I[0],d=c.hasFilter,e=c.selector,f=!e||d&&a.matchesSelector(e)||e&&a.querySelector(e),g=f?G:H,h={elm:a,pos:b,posn:g.length};F.push(h),g.push(h)}),C=G.slice(0)}/**
     * Sorts the sortList
     */
function s(){G.sort(v)}/**
     * Compare strings using natural sort order
     * http://web.archive.org/web/20130826203933/http://my.opera.com/GreyWyvern/blog/show.dml/1671288
     */
function t(a,b,c){for(var d=c(a.toString()),e=c(b.toString()),f=0;d[f]&&e[f];f++)if(d[f]!==e[f]){var g=Number(d[f]),h=Number(e[f]);return g==d[f]&&h==e[f]?g-h:d[f]>e[f]?1:-1}return d.length-e.length}/**
     * Split a string into an array by type: numeral or string
     * @memberof tinysort
     * @private
     * @param {string} t
     * @returns {Array}
     */
function u(a){for(var b,c,d=[],e=0,f=-1,g=0;b=(c=a.charAt(e++)).charCodeAt(0);){var h=46==b||b>=48&&57>=b;h!==g&&(d[++f]="",g=h),d[f]+=c}return d}/**
     * Sort all the things
     * @memberof tinysort
     * @private
     * @param {elementObject} a
     * @param {elementObject} b
     * @returns {number}
     */
function v(a,c){var d=0;for(0!==o&&(o=0);0===d&&n>o;){/** @type {criterium} */
var g=I[o],h=g.ignoreDashes?l:k;
//
if(
//
b(m,function(a){var b=a.prepare;b&&b(g)}),g.sortFunction)// custom sort
d=g.sortFunction(a,c);else if("rand"==g.order)// random sort
d=Math.random()<.5?1:-1;else{// regular sort
var i=f,p=A(a,g),q=A(c,g),r=""===p||p===e,s=""===q||q===e;if(p===q)d=0;else if(g.emptyEnd&&(r||s))d=r&&s?0:r?1:-1;else{if(!g.forceStrings){
// cast to float if both strings are numeral (or end numeral)
var v=B(p)?p&&p.match(h):f,w=B(q)?q&&q.match(h):f;if(v&&w){var x=p.substr(0,p.length-v[0].length),y=q.substr(0,q.length-w[0].length);x==y&&(i=!f,p=j(v[0]),q=j(w[0]))}}d=p===e||q===e?0:
// todo: check here
g.natural&&(isNaN(p)||isNaN(q))?t(p,q,u):q>p?-1:p>q?1:0}}b(m,function(a){var b=a.sort;b&&(d=b(g,i,p,q,d))}),d*=g.sortReturnNumber,// lastly assign asc/desc
0===d&&o++}return 0===d&&(d=a.pos>c.pos?1:-1),d}/**
     * Applies the sorted list to the DOM
     * @memberof tinysort
     * @private
     */
function w(){var a=G.length===F.length;if(J&&a)M?G.forEach(function(a,b){a.elm.style.order=b}):D?D.appendChild(x()):console.warn("parentNode has been removed");else{var b=I[0],c=b.place,d="org"===c,e="start"===c,f="end"===c,g="first"===c,h="last"===c;if(d)G.forEach(y),G.forEach(function(a,b){z(C[b],a.elm)});else if(e||f){var i=C[e?0:C.length-1],j=i&&i.elm.parentNode,k=j&&(e&&j.firstChild||j.lastChild);k&&(k!==i.elm&&(i={elm:k}),y(i),f&&j.appendChild(i.ghost),z(i,x()))}else if(g||h){var l=C[g?0:C.length-1];z(y(l),x())}}}/**
     * Adds all sorted elements to the document fragment and returns it.
     * @memberof tinysort
     * @private
     * @returns {DocumentFragment}
     */
function x(){return G.forEach(function(a){E.appendChild(a.elm)}),E}/**
     * Adds a temporary element before an element before reordering.
     * @memberof tinysort
     * @private
     * @param {elementObject} elmObj
     * @returns {elementObject}
     */
function y(a){var b=a.elm,c=i.createElement("div");return a.ghost=c,b.parentNode.insertBefore(c,b),a}/**
     * Inserts an element before a ghost element and removes the ghost.
     * @memberof tinysort
     * @private
     * @param {elementObject} elmObjGhost
     * @param {HTMLElement} elm
     */
function z(a,b){var c=a.ghost,d=c.parentNode;d.insertBefore(b,c),d.removeChild(c),delete a.ghost}/**
     * Get the string/number to be sorted by checking the elementObject with the criterium.
     * @memberof tinysort
     * @private
     * @param {elementObject} elementObject
     * @param {criterium} criterium
     * @returns {String}
     * @todo memoize
     */
function A(a,b){var c,d=a.elm;
// element
// value
// strings should be ordered in lowercase (unless specified)
return b.selector&&(b.hasFilter?d.matchesSelector(b.selector)||(d=g):d=d.querySelector(b.selector)),b.hasAttr?c=d.getAttribute(b.attr):b.useVal?c=d.value||d.getAttribute("value"):b.hasData?c=d.getAttribute("data-"+b.data):d&&(c=d.textContent),B(c)&&(b.cases||(c=c.toLowerCase()),c=c.replace(/\s+/g," ")),c}/*function memoize(fnc) {
        var oCache = {}
            , sKeySuffix = 0;
        return function () {
            var sKey = sKeySuffix + JSON.stringify(arguments); // todo: circular dependency on Nodes
            return (sKey in oCache)?oCache[sKey]:oCache[sKey] = fnc.apply(fnc,arguments);
        };
    }*/
/**
     * Test if an object is a string
     * @memberOf tinysort
     * @method
     * @private
     * @param o
     * @returns {boolean}
     */
function B(a){return"string"==typeof a}B(a)&&(a=i.querySelectorAll(a)),0===a.length&&console.warn("No elements to sort");var C,D,E=i.createDocumentFragment(),F=[],G=[],H=[],I=[],J=!0,K=a.length&&a[0].parentNode,L=K.rootNode!==document,M=a.length&&(d===e||d.useFlex!==!1)&&!L&&-1!==getComputedStyle(K,null).display.indexOf("flex");return h.apply(g,Array.prototype.slice.call(arguments,1)),r(),s(),w(),G.map(function(a){return a.elm})}/**
 * Traverse an array, or array-like object
 * @memberOf tinysort
 * @method
 * @private
 * @param {Array} array The object or array
 * @param {Function} func Callback function with the parameters value and key.
 */
function b(a,b){for(var c,d=a.length,e=d;e--;)c=d-e-1,b(a[c],c)}/**
 * Extend an object
 * @memberOf tinysort
 * @method
 * @private
 * @param {Object} obj Subject.
 * @param {Object} fns Property object.
 * @param {boolean} [overwrite=false]  Overwrite properties.
 * @returns {Object} Subject.
 */
function c(a,b,c){for(var d in b)(c||a[d]===e)&&(a[d]=b[d]);return a}function d(a,b,c){m.push({prepare:a,sort:b,sortBy:c})}var e,f=!1,g=null,h=window,i=h.document,j=parseFloat,k=/(-?\d+\.?\d*)\s*$/g,l=/(\d+\.?\d*)\s*$/g,m=[],n=0,o=0,p={// default settings
selector:g,order:"asc",attr:g,data:g,useVal:f,place:"org",returns:f,cases:f,natural:f,forceStrings:f,ignoreDashes:f,sortFunction:g,useFlex:f,emptyEnd:f};
// matchesSelector shim
// extend the plugin to expose stuff
return h.Element&&function(a){a.matchesSelector=a.matchesSelector||a.mozMatchesSelector||a.msMatchesSelector||a.oMatchesSelector||a.webkitMatchesSelector||function(a){
//jscs:disable requireCurlyBraces
for(var b=this,c=(b.parentNode||b.document).querySelectorAll(a),d=-1;c[++d]&&c[d]!=b;);
//jscs:enable requireCurlyBraces
return!!c[d]}}(Element.prototype),c(d,{loop:b}),c(a,{plugin:d,defaults:p})}());