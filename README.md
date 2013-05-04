WPP Featured
============

Mark posts, pages, and custom content as "featured" and display using a Widget, Shortcode, or theme functions.

Install
-------
Upload the plugin to your WordPress site and activate it.

Usage
-----
To mark something as Featured, edit any post (supports any custom post content type - not hierarchal/pages) 
and selected 'Is Featured' in the Publish Meta Box.

To display your featured posts, you can use the *'Featured' widget*, the *[featured count=N]* shortcode, 
or the *get_featured_posts($count, $args)* theme function.

Example of using get_featured_posts($count, $args);

    // get the 3 most recent featured posts
    <?php $featured = WPP_Featured::get_featured_posts(3) ?>
    // get the 3 most recent featured posts from category 4
    <?php $featured = WPP_Featured::get_featured_posts(3, array('category'=>4)) ?>
    
    <?php foreach($featured as $post): ?>
      <?php setup_postdata($post); ?>
      <span style="color: red;"><?php the_title() ?></a>
    <?php endforeach; ?>

Todo
----
- [x] Add get_featured_posts
- [ ] Add shortcode
- [ ] Add Widget
- [ ] Add Support for Category in Widget

License
-------
A proper license for this work has yet to be selected, as such I reserve the right to select a 
license (MIT, GPL, LGPL, Apache, etc) at my discretion and all past, present and future variations
of this work will then fall under said license.
