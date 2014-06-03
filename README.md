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

### Using get_featured_posts($count, $args);

    // get the 3 most recent featured posts
    <?php $featured = WPP_Featured::get_featured_posts(3) ?>
    // get the 3 most recent featured posts from category 4
    <?php $featured = WPP_Featured::get_featured_posts(3, array('category'=>4)) ?>
    
    <?php foreach($featured as $post): ?>
      <?php setup_postdata($post); ?>
      <span style="color: red;"><?php the_title() ?></a>
    <?php endforeach; ?>

### Using the Featured List Widget

Add the widget to your widget area, and provided an optional Title.  You can also limit the featured list to only showing 
featured posts from a specific author by entering the authors 'slug' into the field.  You can limit the number of posts by 
entering the number of posts.

The featured lists has the following CSS classes, for theming.

    h3.widget-title /* the widget title */
    ul.wpp-featured-widget /* the widget list */
    li.item /* an item in the list */
    li.first /* the first item in the list */
    li.last /* the last item in the list */

All items have the 'item' class, but the first and last items have the 'first' and 'last' classes respectively.


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
