'use strict';

angular.module('presentationsApp')
.controller('ThemingBasicCtrl', function () {

})
.directive('initreveal', function() {
  return {
    restrict: 'A',
    replace: true,
    template: '<script>\n  Reveal.initialize({\n\t\t\t\tcontrols: true,\n\t\t\t\tprogress: true,\n\t\t\t\tcenter: true,\n\t\t\t\ttransition: Reveal.getQueryHash().transition || \'default\', // default/cube/page/concave/zoom/linear/fade/none\n\n\t\t\t\t// Optional libraries used to extend on reveal.js\n\t\t\t\tdependencies: [\n\t\t\t\t\t{ src: \'components/reveal.js/lib/js/classList.js\', condition: function() { return !document.body.classList; } },\n\t\t\t\t\t{ src: \'components/reveal.js/plugin/markdown/showdown.js\', condition: function() { return !!document.querySelector( \'[data-markdown]\' ); } },\n\t\t\t\t\t{ src: \'components/reveal.js/plugin/markdown/markdown.js\', condition: function() { return !!document.querySelector( \'[data-markdown]\' ); } },\n\t\t\t\t\t{ src: \'components/reveal.js/plugin/highlight/highlight.js\', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },\n\t\t\t\t\t{ src: \'components/reveal.js/plugin/zoom-js/zoom.js\', async: true, condition: function() { return !!document.body.classList; } },\n\t\t\t\t\t{ src: \'components/reveal.js/plugin/notes/notes.js\', async: true, condition: function() { return !!document.body.classList; } }\n\t\t\t\t\t// { src: \'plugin/search/search.js\', async: true, condition: function() { return !!document.body.classList; } }\n\t\t\t\t\t// { src: \'plugin/remotes/remotes.js\', async: true, condition: function() { return !!document.body.classList; } }\n\t\t\t\t]\n\t\t\t});\n</script>'
  };
});
