var sources = 'jn,tdn,nnon'; // TODO: make this an input

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

Post.get_top = function () {
  $.getJSON('/sources/' + sources + '/top.json', function (posts) {
    Post.append_posts_from_json(posts);
    $('#posts').removeClass('loading');
  });
}

Post.get_older = function (callback) {
  var last_post_hash = $('.post:last').data('post').hash,
    json_path = '/sources/' + sources + '/before_' + last_post_hash + '.json';
  $.getJSON(json_path, function (posts) {
    Post.append_posts_from_json(posts);
    callback();
  });
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
});
