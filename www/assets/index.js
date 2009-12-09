/*
  jQuery Cookie plugin: http://plugins.jquery.com/files/jquery.cookie.js.txt
*/

jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1}var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000))}else{date=options.expires}expires='; expires='+date.toUTCString()}var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('')}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break}}}return cookieValue}};

/*
  jGrowl plugin: http://stanlemon.net/projects/jgrowl.html
*/

(function($){$.jGrowl=function(m,o){if($('#jGrowl').size()==0)$('<div id="jGrowl"></div>').addClass($.jGrowl.defaults.position).appendTo('body');$('#jGrowl').jGrowl(m,o);};$.fn.jGrowl=function(m,o){if($.isFunction(this.each)){var args=arguments;return this.each(function(){var self=this;if($(this).data('jGrowl.instance')==undefined){$(this).data('jGrowl.instance',$.extend(new $.fn.jGrowl(),{notifications:[],element:null,interval:null}));$(this).data('jGrowl.instance').startup(this);}
if($.isFunction($(this).data('jGrowl.instance')[m])){$(this).data('jGrowl.instance')[m].apply($(this).data('jGrowl.instance'),$.makeArray(args).slice(1));}else{$(this).data('jGrowl.instance').create(m,o);}});};};$.extend($.fn.jGrowl.prototype,{defaults:{pool:0,header:'',group:'',sticky:false,position:'top-right',glue:'after',theme:'default',corners:'10px',check:250,life:3000,speed:'normal',easing:'swing',closer:true,closeTemplate:'&times;',closerTemplate:'<div>[ close all ]</div>',log:function(e,m,o){},beforeOpen:function(e,m,o){},open:function(e,m,o){},beforeClose:function(e,m,o){},close:function(e,m,o){},animateOpen:{opacity:'show'},animateClose:{opacity:'hide'}},notifications:[],element:null,interval:null,create:function(message,o){var o=$.extend({},this.defaults,o);this.notifications[this.notifications.length]={message:message,options:o};o.log.apply(this.element,[this.element,message,o]);},render:function(notification){var self=this;var message=notification.message;var o=notification.options;var notification=$('<div class="jGrowl-notification'+((o.group!=undefined&&o.group!='')?' '+o.group:'')+'"><div class="close">'+o.closeTemplate+'</div><div class="header">'+o.header+'</div><div class="message">'+message+'</div></div>').data("jGrowl",o).addClass(o.theme).children('div.close').bind("click.jGrowl",function(){$(this).parent().trigger('jGrowl.close');}).parent();(o.glue=='after')?$('div.jGrowl-notification:last',this.element).after(notification):$('div.jGrowl-notification:first',this.element).before(notification);$(notification).bind("mouseover.jGrowl",function(){$(this).data("jGrowl").pause=true;}).bind("mouseout.jGrowl",function(){$(this).data("jGrowl").pause=false;}).bind('jGrowl.beforeOpen',function(){o.beforeOpen.apply(self.element,[self.element,message,o]);}).bind('jGrowl.open',function(){o.open.apply(self.element,[self.element,message,o]);}).bind('jGrowl.beforeClose',function(){o.beforeClose.apply(self.element,[self.element,message,o]);}).bind('jGrowl.close',function(){$(this).data('jGrowl').pause=true;$(this).trigger('jGrowl.beforeClose').animate(o.animateClose,o.speed,o.easing,function(){$(this).remove();o.close.apply(self.element,[self.element,message,o]);});}).trigger('jGrowl.beforeOpen').animate(o.animateOpen,o.speed,o.easing,function(){$(this).data("jGrowl").created=new Date();}).trigger('jGrowl.open');if($.fn.corner!=undefined)$(notification).corner(o.corners);if($('div.jGrowl-notification:parent',this.element).size()>1&&$('div.jGrowl-closer',this.element).size()==0&&this.defaults.closer!=false){$(this.defaults.closerTemplate).addClass('jGrowl-closer').addClass(this.defaults.theme).appendTo(this.element).animate(this.defaults.animateOpen,this.defaults.speed,this.defaults.easing).bind("click.jGrowl",function(){$(this).siblings().children('div.close').trigger("click.jGrowl");if($.isFunction(self.defaults.closer))self.defaults.closer.apply($(this).parent()[0],[$(this).parent()[0]]);});};},update:function(){$(this.element).find('div.jGrowl-notification:parent').each(function(){if($(this).data("jGrowl")!=undefined&&$(this).data("jGrowl").created!=undefined&&($(this).data("jGrowl").created.getTime()+$(this).data("jGrowl").life)<(new Date()).getTime()&&$(this).data("jGrowl").sticky!=true&&($(this).data("jGrowl").pause==undefined||$(this).data("jGrowl").pause!=true)){$(this).trigger('jGrowl.close');}});if(this.notifications.length>0&&(this.defaults.pool==0||$(this.element).find('div.jGrowl-notification:parent').size()<this.defaults.pool)){this.render(this.notifications.shift());}
if($(this.element).find('div.jGrowl-notification:parent').size()<2){$(this.element).find('div.jGrowl-closer').animate(this.defaults.animateClose,this.defaults.speed,this.defaults.easing,function(){$(this).remove();});};},startup:function(e){this.element=$(e).addClass('jGrowl').append('<div class="jGrowl-notification"></div>');this.interval=setInterval(function(){$(e).data('jGrowl.instance').update();},this.defaults.check);if($.browser.msie&&parseInt($.browser.version)<7&&!window["XMLHttpRequest"])$(this.element).addClass('ie6');},shutdown:function(){$(this.element).removeClass('jGrowl').find('div.jGrowl-notification').remove();clearInterval(this.interval);}});$.jGrowl.defaults=$.fn.jGrowl.prototype.defaults;})(jQuery);

/*
  index.js main
*/

var disabled_sources = $.cookie('disabled_sources');
disabled_sources = disabled_sources ? disabled_sources.split(',') : [];

function Post(data) {
  this.hash = data.hash;
  this.time = data.time
  this.path = '/posts/' + this.hash + '.html?' + this.time;
  
  this.element = $('<div class="post loading"></div>')
    .load(this.path, function () {
      $(this).removeClass('loading');
    }).data('post', this);
}

Post.append_posts_from_json = function (posts) {
  $.each(posts, function () {
    var post = new Post(this);
    $('#posts').append(post.element);
  });
}

Post.clear = function () {
  $('#posts').html('').addClass('loading');
}

Post.get_top = function () {
  $.getJSON('/sources/' + Post.sources() + '/top.json', function (posts) {
    Post.append_posts_from_json(posts);
    $('#posts').removeClass('loading');
  });
}

Post.get_older = function (callback) {
  var last_post_hash = $('.post:last').data('post').hash,
    json_path = '/sources/' + Post.sources() + '/before_' + last_post_hash + '.json';
  $.getJSON(json_path, function (posts) {
    Post.append_posts_from_json(posts);
    callback();
  });
}

Post.sources = function () {
  var all_sources = $('#available-sources a').map(function () {
    return $(this).attr('data-source-id');
  }).get();
  return $.grep(all_sources, function (source) {
    return $.inArray(source, disabled_sources) == -1;
  });
}

function notify(message, klass, timeout) {
  var el = $('<div class="' + klass + '">' + message + '</div>')
    .fadeIn(250)
    .insertAfter('#header');
  setTimeout(function () {
    el.fadeOut(250);
  }, timeout || 2000);
}

$(function () {
  Post.get_top();
  $('#next-page').click(function (e) {
    var nextPageEl = $(this).addClass('loading');
    Post.get_older(function () {
      nextPageEl.removeClass('loading');
    });
    e.preventDefault();
  });
  $('#available-sources a').click(function (e) {
    e.preventDefault();
    var el = $(this), source_id = el.attr('data-source-id');
    if(el.hasClass('disabled-source')) {
      var source_index = disabled_sources.indexOf(source_id);
      disabled_sources.splice(source_index, 1);
    } else {
      // don't allow disabling of all sources
      if(Post.sources().length == 1) {
        $.jGrowl("Don't remove your last source!");
        return false;
      }
      disabled_sources.push(source_id);
    }
    $.cookie('disabled_sources', disabled_sources.join(','));
    Post.clear();
    Post.get_top();
    el.toggleClass('disabled-source');
  }).filter(function () {
    return $.inArray($(this).attr('data-source-id'), disabled_sources) != -1;
  }).addClass('disabled-source');
});
