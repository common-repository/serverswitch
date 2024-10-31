=== Plugin Name ===
Contributors: dmontgomery
Donate link: No thanks
Tags: server, switch, prepare, change
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 0.5

Set of easy transitional switches for launch day.

== Description ==

Based on the onextrapixel.com article "13 Useful WordPress SQL Queries You Wish You Knew Earlier," located at http://www.onextrapixel.com/2010/01/30/13-useful-wordpress-sql-queries-you-wish-you-knew-earlier/, several of the queries mentioned sounded like a possible plugin. Not all queries are included, as the queries within that article are rather varied in purpose. I've decided to see how people like this iteration, then possibly develop it further.

I do not claim intellectual property of the idea, and I've received permission from the folks at onextrapixel.com to adapt the article into this plugin.

This plugin's intention is to have a couple handy switches for launch day. For anyone that would like to suggest any additions to this plugin, or modifications, please feel free to contact me at montgomerygraphics[at]gmail[dot]com.

== Installation ==

1. Upload the `serverswitch` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Change ServerSwitch preferences under Settings

== Frequently Asked Questions ==

= Is this your idea? =

No. I had a coworker point me to the article http://www.onextrapixel.com/2010/01/30/13-useful-wordpress-sql-queries-you-wish-you-knew-earlier/ and asked if I could build it into a plugin.

= Can I give you some money? Please? =

No. Neither the idea nor the request came from me--I simply sat down and coded it to save us some time here. I'd feel bad about stealing IP.

= Help! I killed my database! =

Restore it.

= But I didn't back it up (like you told me to)! =

That's on you then, isn't it? There was a very clear warning that this plugin interacted with and wrote over your database. Go in and try and run a query through phpMyAdmin. I based it on the article listed above, so maybe that can dig you out of the hole. Alternatively, if your clicky finger slipped, just click the revert button, which essentially runs the query in reverse to undo whatever you just did.

= You should do X with this/your next plugin. =
Email me your ideas to montgomerygraphics[at]gmail[dot]com.

== Upgrade Notice ==

No upgrades yet.

== Screenshots ==

None available yet.

== Changelog ==

= 0.5 =
* Released with the capability to change default admin name, guid, url in content, and post meta 