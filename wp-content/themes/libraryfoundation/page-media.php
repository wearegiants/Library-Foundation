<?php Themewrangler::setup_page();get_header(); ?>

<?php 

  get_template_part('templates/page', 'header');

?>

<div class="row">
  <div class="desktop-12">
    <?php get_search_form(  ); ?>
    <div id="posts" class="row"></div>

    <script id="posts-list" type="text/template">
<<<<<<< Updated upstream
    {{#count}}<div class="desktop-12">{{count}} posts found.<br><br></div>{{/count}} 
=======
    {{#count}}<div class="desktop-12">{{count}} posts found. </div>{{/count}}
>>>>>>> Stashed changes
    {{#posts}}
        <div class="item desktop-4">
            {{#thumbnail}}
            <img src="{{medium}}" alt="{{title}}" class="img-responsive">
            {{/thumbnail}}
            {{^thumbnail}}
            {{/thumbnail}}
            
            <h3><a href="{{url}}">{{title}}</a></h3>
            {{{excerpt}}}
            <span><a href="{{url}}">read more</a></span>
        </div>
    {{/posts}}
    {{^posts}}
<<<<<<< Updated upstream
    <div class="desktop-12">Sorry, no posts match that search.<br><br></div>
=======
    <div class="desktop-12">Sorry, no posts.</div>
>>>>>>> Stashed changes
    {{/posts}}
</script>

    <script>

    $(function(){

      loadUrl = '/?json=1';

      $.ajax({

          url: loadUrl,
          dataType : "json",
          type: 'GET',
          beforeSend: function() {
          $('#posts').html('<div class="desktop-12">loading</div>');
          },
          complete: function(data) {
          
          },
          success: function(data) {
          
            var template = $('#posts-list').html();
            var html = Mustache.to_html(template, data);
            $('#posts').html(html);

            

          }

        });

      function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    var searchUrl = getParameterByName('search');

    console.log(searchUrl);

    if(window.location.href.indexOf(searchUrl) > -1) {

      loadUrl = '/search/'+searchUrl+'?json=1';
       
       $.ajax({

          url: loadUrl,
          dataType : "json",
          type: 'GET',
          beforeSend: function() {
          $('#posts').html('<div class="desktop-12">loading</div>');
          },
          complete: function(data) {
          
          },
          success: function(data) {
          
            var template = $('#posts-list').html();
            var html = Mustache.to_html(template, data);
            $('#posts').html(html);

            

          }

        });

    }


    });

    $('#searchform').submit(function( e ){ 

    // Stop the form from submitting
    e.preventDefault();

    // Get the search term
    var search = $('#s').val();
    var cleansearch = search.replace(/ /g, '+');
    var term = '/search/'+cleansearch+'?json=1';
    var mediasearch = '/archive?search='+cleansearch;
//    var term = '/search/'+search;


    // Make sure the user searched for something
    if ( term ){

      // $.getJSON(term, function(data){
      //       var template = $('#results-list').html();
      //       var html = Mustache.to_html(template, data);
      //       $('#results').html(html);
      //       });

        // $.getJSON(term, function(data){

        //   var template = $('#posts-list').html();
        //   var html = Mustache.to_html(template, data);
        //   $('#posts').html(html);

        // });


        $.ajax({

          url: term,
          dataType : "json",
          type: 'GET',
          beforeSend: function() {
          // TODO: show your spinner
          $('#posts').html('<div class="desktop-12">loading</div>');
          },
          complete: function(data) {
          // TODO: hide your spinner
          //$('#posts').html('loaded');
          //console.log(data);
          // var template = $('#posts-list').html();
          // var html = Mustache.to_html(template, data);
          // $('#posts').html(html);
          },
          success: function(data) {
          // This only works if we're getting results from the search page... not JSON. 
          //$('#results').html( $(data).find('#results') );
          //$('#results').html(data);

            // This is it.
            var template = $('#posts-list').html();
            var html = Mustache.to_html(template, data);
            $('#posts').html(html);
            History.pushState(null,null,mediasearch)
            // Need to add some animation, etc.

          }

        });

    }

});

</script>
  </div>
</div>

<?php get_footer(); ?>