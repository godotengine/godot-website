# Blog RSS Feed Extension

__Blog RSS Feed extends and is therefore dependent on the [RainLab Blog](https://octobercms.com/plugin/rainlab-blog) plugin.__

This plugin creates and updates an rss.xml file for blog posts. It also comes with an RSS Link component. This is optional and was just included for convenience. You can link to the rss.xml file however you want. It is created at http://www.yoursite.com/rss.xml.


## Installation/Setup

1. Install the plugin itself by either adding it to your project, or going to System > Updates and searching for **SoBoRed.Rss**
2. Click System from the main menu of the backend.
3. In the Settings sub-menu, click on __Blog RSS Settings__ under the Blog section.
4. Fill out the information under the __Site Information__ and __Blog Information__ tabs.

The Site and Blog information is used during the creation of the RSS xml file:

```xml
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>[Title]</title>
        <link>[Link]</link>
        <description>[Description]</description>

        <item>
            <title>[Post Title]</title>
            <link>[Link][Post Page]/[Post Slug]</link>
            <guid>[Link][Post Page]/[Post Slug]</guid>
            <pubDate>[Published Date|Format M d, Y]</pubDate>
            <description>[Post Excerpt]</description>
        </item>
    </channel>
</rss>
```



## Usage

### 1. Using the optional link component:

+ There should now be a component under the component menu for Link to RSS Feed.
+ Add it to the page or layout just like any other component
+ There are 3 settings for this component:
  + Feed Burner Address - This is the address to the feedburner feed: http://feeds.feedburner.com/feed_address. If left blank, the link will just be to your RSS file: http://yourblog.com/rss.xml
  + Default Link Text - This is the default link text. It is used for the RSS link when Icon Class(es) is empty. For example: `<a>RSS</a>`.
  + Icon Class(es) - This is the icon class(es). It is used for the RSS link: `<a><i class="icon icon-rss"></i></a>`. If left blank, the link will just display the default link text.

```twig
<a href="{{ feedBurnerAddress ? feedBurnerLink : defaultRssLink }}" target="_blank">
    {% if iconClass %}
        <i class="{{ iconClass }}"></i>
    {% else %}
        {{ defaultText }}
    {% endif %}
</a>
```

### 2. Or just put whatever you want in your layout/pages :)

The included component is completely optional. It is only included for convenience. You can link to the generated RSS file in any fashion that you want.

## Note
> If you're using version control for your website, you may want to include the rss.xml file in your .gitignore to keep it separate from the production content.
