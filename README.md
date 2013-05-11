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
    Copyright (c) 2013, WP Poets and/or its affiliates <plugins@wppoets.com>
    Portions of this distribution are copyrighted by:
      Copyright (c) 2013 David Higgins <higginsd@zoulcreations.com>
    All rights reserved.
    
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA