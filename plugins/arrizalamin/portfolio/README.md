# october-portfolio
This plugin allows you to show off your past projects. It also can be used for provides services, company values, etc.

## Portfolio component
The fields included for each showcase item are:

**Field**               | **Description**
------------------------|--------------------
Title                   | Name of the Item
Category                | Category of the Item
Slug                    | Slug for the item
URL (Optional)          | Project/Item URL
Tags (Optional)         | Tags for the Item
Description (Optional)  | Description of the Item with rich editor area
Images (Optional)       | Multiple images related to the item

### Usage
#### Copy the template
Copy /plugins/arrizalamin/portfolio/components/portfolio/default.htm to your themes partials/portfolio folder. Here is the default template, you can format it any way you like.
~~~
<div class="container">
    <div class="row">
        {% for item in __SELF__.portfolio %}
        <div class="col-lg-4">
            {% if item.images|length > 0 %}
            <div>
                {% set image = item.images.first %}
                <a href="{{ item.pageUrl }}">
                    <img src="{{ image.path }}" class="img-responsive" alt="{{ image.title }}">
                </a>
            </div>
            {% endif %}
            <a href="{{ item.pageUrl }}"><h2>{{ item.title }}</h2></a>
            <small>posted {{ item.created_at|date('j m Y') }} in <a href="{{ item.category.pageUrl }}">{{ item.category.name }}</a></small>
            {% if item.tags|length > 0 %}
            <div>
                {% for tag in item.tags %}
                <a href="{{ tag.pageUrl }}"><span class="label label-primary">{{ tag.name }}</span></a>
                {% endfor %}
            </div>
            {% endif %}
            {% if item.description %}
            <p>
                {{ item.description|raw }}
            </p>
            {% endif %}
        </div>
        {% endfor %}
    </div>

    {% if __SELF__.portfolio.lastPage > 1 %}
    <div class="row">
        <div class="col-sm-12">
            <ul class="pagination">
                {% if __SELF__.portfolio.currentPage > 1 %}
                <li><a href="{{ this.page.baseFileName|page({ page: (__SELF__.portfolio.currentPage - 1) }) }}">&larr; Prev</a></li>
                {% endif %}

                {% for page in 1..__SELF__.portfolio.lastPage %}
                <li class="{{ __SELF__.portfolio.currentPage == page ? 'active' : null }}">
                    <a href="{{ this.page.baseFileName|page({ page: page }) }}">{{ page }}</a>
                </li>
                {% endfor %}

                {% if __SELF__.portfolio.lastPage > __SELF__.portfolio.currentPage %}
                <li><a href="{{ this.page.baseFileName|page({ page: (__SELF__.portfolio.currentPage + 1) }) }}">Next &rarr;</a></li>
                {% endif %}
            </ul>
        </div>
    </div>
    {% endif %}
</div>
~~~

#### add the component
Now you can embed portfolio in your pages. Just use the portfolio component in your page, select category of your portfolio and place `{% component 'portfolio' %}` anywhere you like.

Simple use case:
~~~
title = "Portfolio"
url = "/portfolio/:page?"

[portfolio]
category = "0"
itemsPerPage = "5"
pageNumber = {{ :page }}
==
{% component 'portfolio' %}
~~~

#### Categories
The categories of an item of a portfolio are highlighted as hyperlink by default. To use this functionality you'll need to add a page which can show all items of the selected category.
The basic code needed is:
~~~
title = "Portfolio category item list"
url = "/portfolio/category/:selected_cat/:page?"

[portfolio]
category = 1
itemsPerPage = 6
order = "asc"
pageNumber = "{{ :page }}"
selectedCat = "{{ :selected_cat }}"
==
{% component 'portfolio' %}
~~~


#### Tags
Like for the categories you'll also need to add a page for the tags. Tags can be clicked when the portfolio is viewed. When clicked this page will be opened and an overview of all items with the selected tag will be displayed.
In the CMS the following page needs to be created to get this working:
~~~
title = "Portfolio items by tag"
url = "/portfolio/tags/:selected_tag/:page?"

[portfolio]
itemsPerPage = 6
order = "asc"
pageNumber = "{{ :page }}"
selectedTag = "{{ :selected_tag }}"
==
{% component 'portfolio' %}
~~~

## Item component
The item component is to show off single items from the portfolio.
It is also used to show your items when clicking the items displayed by the portfolio component.

### Usage
#### Copy the template
Copy /plugins/arrizalamin/portfolio/components/item/default.htm to your themes partials/item folder. Here is the default template, you can format it any way you like.
~~~
{% set item = __SELF__.item %}
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            {% for image in item.images %}
            <div class="col-sm-6">
                <img src="{{ image.path }}" class="img-responsive" alt="{{ image.title }}">
            </div>
            {% endfor %}
        </div>
        <div class="col-lg-6">
            <h1>Portfolio Item {{ item.id }}</h1>
            <h2>{{ item.title }}</h2>
            <small>posted {{ item.created_at|date('j m Y') }} in <a href="{{ item.category.pageUrl }}">{{ item.category.name }}</a></small>
            <div>
                {% for tag in item.tags %}
                <a href="{{ tag.pageUrl }}"><span class="label label-default">{{ tag.name }}</span></a>
                {% endfor %}
            </div>
            <p>{{ item.description|raw }}</p>
            {% if item.url %}
                <a href="{{ item.url }}" class="btn btn-default" target="_blank">view project</a>
            {% endif %}
        </div>
    </div>
</div>
~~~

### Add the component
To be able to click and follow the headers of an item in the portfolio overview created by the portfolio component you'll need to add a page with the item component.
A simple example:
~~~
title = "Portfolio Item"
url = "/portfolio/item/:item_slug"

[item]
itemSlug = "{{ :item_slug }}"
==
{% component 'item' %}
~~~

Another way to use the item component is to show single portfolio items in any page. Just add the item component in your page, select the item from your portfolio and place `{% component 'item' %}` anywhere you like.
Use the same example as above with any URL you like to use and select from the item component the correct 'Item to show' and save the page.

## Component Links
Each of the components uses a links dropdown menu to select the landing pages for *categories*, *tags* and *items*.
These values need to be set to allow the components to create the correct hyperlinks for the heading item links, category links and tags links.
