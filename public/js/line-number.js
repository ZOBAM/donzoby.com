/*
	This plugins was created based on the Prism line-numbering plugin.
	This plugin aims to number all lines and is independent of highlighting.
*/
(function(){

  if(!window.Prism || !document.querySelectorAll) {
    return;
  }
  
  function $$(expr, con) {
    return Array.prototype.slice.call((con || document).querySelectorAll(expr));
  }
      
  function numberLines(pre) {
    var offset = +pre.getAttribute('data-line-offset') || 0;
    var lineHeight = parseFloat(getComputedStyle(pre).lineHeight);
    var code = pre.querySelector('code');
    var numLines = code.innerHTML.split('\n').length;
    pre.setAttribute('data-number', '');
  
    for (var i=1; i <= numLines; i++) {
      var line = document.createElement('div');
      line.className = 'line-number';
      line.setAttribute('data-start', i);
      line.style.top = (i - offset - 1) * lineHeight + 'px';
      
      (code || pre).appendChild(line);
    }
  }
  
  Prism.hooks.add('after-highlight', function(env) {
    var pre = env.element.parentNode;
    
    if (!pre || !/pre/i.test(pre.nodeName)) {
      return;
    }
  
    $$('.line-number', pre).forEach(function (line) {
      line.parentNode.removeChild(line);
    });
    
    numberLines(pre);
  });
  
  })();

  Prism.hooks.add('before-insert', function(env){
    var el = env.element;
    if (!(el.hasAttribute('data-linenumber'))) return;
    var startNumber = parseInt(el.getAttribute('data-linenumber'))||0;
    el.style.counterReset = getComputedStyle(el).counterReset.replace(/-?\d+/, startNumber-1);
    var line = '<span class=line >', endline = '</span>';
    // some highlighting puts newlines inside the span, which messes up the code below. Fix that. Newlines that are actually inside the span will still
    // cause problems.
    var code = env.highlightedCode.replace(/\n<\/span>/g, '</span>\n');
    env.highlightedCode = line + code.split('\n').join(endline+'\n'+line) + endline;
  });